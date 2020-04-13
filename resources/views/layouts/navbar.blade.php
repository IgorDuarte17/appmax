<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="@if(Request::is('dashboard/*')) active @endif">
                    <a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-home"></i>Dashboard </a>
                </li>
                <li class="@if(Request::is('produtos/*')) active @endif">
                    <a href="{{ route('produtos.index') }}"><i class="menu-icon fa fa-tags"></i>Produtos </a>
                </li>
                <li class="menu-item-has-children dropdown @if(Request::is('relatorios/*')) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon menu-icon fa fa-list"></i>Relatórios</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-calendar"></i><a href="{{ route('daily_report') }}">Diário</a></li>
                        <li><i class="fa fa-list-alt"></i><a href="{{ route('stock_report') }}">Estoque</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</aside>
