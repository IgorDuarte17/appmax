<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Helpers\SkuHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $skuHelper;

    public function __construct(SkuHelper $skuHelper)
    {
        $this->skuHelper = $skuHelper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'amount'        => 'required'
        ];

        $messages = [
            'name.required'         => 'Informe o Nome!',
            'description.required'  => 'Informe a Descrição!',
            'price.required'        => 'Informe o Valor!',
            'amount.required'       => 'Informe a Quantidade!',
        ];

        $nicenames = [
            'name'          => 'Nome',
            'description'   => 'Descrição',
            'price'         => 'Valor',
            'amount'        => 'Quantidade'
        ];

        $this->validate($request, $rules, $messages, $nicenames);

        try
        {
            $data = $request->request->all();

            $data['active'] = isset($data['active']);
            $data['insert_in'] = 1;
            $data['sku'] = $this->skuHelper->generate();

            $product = Product::create($data);

            // Imagem
            if($request->hasfile('image'))
            {
                $name = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->store('products');

                \App\Models\Product\Imagem::create([
                    'product_id' => $product->id,
                    'link' => $path,
                    'name' => $name,
                ]);
            }

            flash('Produto cadastrado com sucesso.')->success()->important();
            return redirect()->route('produtos.index');

         } catch (\Exception $e) {
            flash('Ocorreu um erro ao cadastrar o produto.')->error()->important();
            return redirect()->route('produtos.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'amount'        => 'required'
        ];

        $messages = [
            'name.required'         => 'Informe o Nome!',
            'description.required'  => 'Informe a Descrição!',
            'price.required'        => 'Informe o Valor!',
            'amount.required'       => 'Informe a Quantidade!',
        ];

        $nicenames = [
            'name'          => 'Nome',
            'description'   => 'Descrição',
            'price'         => 'Valor',
            'amount'        => 'Quantidade'
        ];

        try
        {
            $this->validate($request, $rules, $messages, $nicenames);

            $data = $request->request->all();

            $data['active'] = isset($data['active']);

            $product = Product::findOrFail($id);

            $product->update($data);

            // Imagem
            if($request->hasfile('image'))
            {
                if($product->image) {

                    if(Storage::exists($product->image->link)) {
                        Storage::delete($product->image->link);
                    }

                    $product->image->delete();
                }

                $name = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->store('products');

                \App\Models\Product\Imagem::create([
                    'product_id' => $product->id,
                    'link' => $path,
                    'name' => $name,
                ]);
            }

            flash('Produto atualizado com sucesso.')->success()->important();
            return redirect()->route('produtos.index');

        } catch (\Exception $e) {
            flash('Ocorreu um erro ao atualizar o produto.')->error()->important();
            return redirect()->route('produtos.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Produto removido com sucesso!'
            ]);

        } catch(Exception $e) {
            return response()->json([
                'code' => 501,
                'message' => 'Ocorreu um erro ao remover o produto!'
            ]);
        }
    }

    /**
     * Remove the specified image from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteImage($id)
    {
        try {
            $image = \App\Models\Product\Imagem::findOrFail($id);

            if(Storage::exists($image->link)) {
                Storage::delete($image->link);
            }

            $image->delete();

            return response()->json([
              'code' => 200,
              'message' => 'Removido com sucesso!'
            ]);

        } catch(Exception $e) {
            return response()->json([
              'code' => 501,
              'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the amount value.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function decrement(Request $request, $id)
    {
        try
        {
            $data = $request->request->all();
            $product = Product::findOrFail($id);

            // Valida se existe a quantia solicitada em estoque
            if($request->amount > $product->amount)
            {
                return response()->json([
                    'code' => 501,
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
                'code' => 501,
                'message' => 'Ocorreu um erro ao tentar efetuar a baixa do produto.'
            ]);
        }
    }
}
