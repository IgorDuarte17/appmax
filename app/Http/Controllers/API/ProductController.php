<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Helpers\SkuHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


class ProductController extends Controller
{
    protected $skuHelper;

    public function __construct(SkuHelper $skuHelper)
    {
        $this->skuHelper = $skuHelper;
    }

    public function index()
    {
        $products = Product::all();

        if( $products->isEmpty() )
        {
            return response()->json([
                'code' => 200,
                'message' => 'Não existem produtos cadastrados.'
            ]);
        }

        return response()->json($products, 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'amount'        => 'required'
        ]);

        try
        {
            $data = $request->request->all();

            $data['active'] = true;
            $data['insert_in'] = 2;
            $data['sku'] = $this->skuHelper->generate();

            $product = Product::create($data);

            return response()->json($product, 201);
        } catch(Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Ocorreu um erro ao cadastrar o produto'
            ]);
        }
    }

    public function decrement(Request $request, $id)
    {
        $this->validate($request, [
            'amount'        => 'required'
        ]);

        try
        {
            $data = $request->request->all();
            $product = Product::findOrFail($id);

            // Valida se existe a quantia solicitada em estoque
            if($request->amount > $product->amount)
            {
                return response()->json([
                    'code' => 200,
                    'message' => 'Voce tentou dar baixa em mais produtos do que existem em estoque.'
                ]);
            }

            // Decrementa o valor requisitado do valor total
            $data['amount'] = $product->amount - $request->amount;

            $product->update($data);

            return response()->json([
                'code' => 200,
                'message' => 'Baixa do estoque realizada com sucesso!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Ocorreu um erro ao tentar efetuar a baixa do produto.'
            ]);
        }
    }
}
