<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="@if(Request::is('home/*')) active @endif">
                    <a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-home"></i>Dashboard </a>
                </li>
                <li class="@if(Request::is('home/*')) active @endif">
                    <a href="{{ route('produtos.index') }}"><i class="menu-icon fa fa-tags"></i>Produtos </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
