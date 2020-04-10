<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="@if(Request::is('home/*')) active @endif">
                    <a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-title">UI elements</li><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown @if(Request::is('components/*')) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Components</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-puzzle-piece"></i><a href="{{ route('ui_buttons') }}">Buttons</a></li>
                        <li><i class="fa fa-id-badge"></i><a href="{{ route('ui_badges') }}">Badges</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{ route('ui_tabs') }}">Tabs</a></li>
                        <li><i class="fa fa-id-card-o"></i><a href="{{ route('ui_cards') }}">Cards</a></li>
                        <li><i class="fa fa-exclamation-triangle"></i><a href="{{ route('ui_alerts') }}">Alerts</a></li>
                        <li><i class="fa fa-spinner"></i><a href="{{ route('ui_progressbar') }}">Progress Bars</a></li>
                        <li><i class="fa fa-fire"></i><a href="{{ route('ui_modals') }}">Modals</a></li>
                        <li><i class="fa fa-book"></i><a href="{{ route('ui_switches') }}">Switches</a></li>
                        <li><i class="fa fa-th"></i><a href="{{ route('ui_grids') }}">Grids</a></li>
                        <li><i class="fa fa-file-word-o"></i><a href="{{ route('ui_typgraphy') }}">Typography</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown @if(Request::is('tables/*')) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Tables</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="{{ route('basic_table') }}">Basic Table</a></li>
                        <li><i class="fa fa-table"></i><a href="{{ route('data_table') }}">Data Table</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown @if(Request::is('forms/*')) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Forms</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-th"></i><a href="{{ route('basic_form') }}">Basic Form</a></li>
                        <li><i class="menu-icon fa fa-th"></i><a href="{{ route('advanced_form') }}">Advanced Form</a></li>
                    </ul>
                </li>

                <li class="menu-title">Icons</li><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown @if(Request::is('icons/*')) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Icons</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="{{ route('fontawesome') }}">Font Awesome</a></li>
                        <li><i class="menu-icon ti-themify-logo"></i><a href="{{ route('themify') }}">Themefy Icons</a></li>
                    </ul>
                </li>
                <li class="@if(Request::is('widgets/*')) active @endif">
                    <a href="{{ route('widgets') }}"> <i class="menu-icon ti-email"></i>Widgets</a>
                </li>
                <li class="menu-item-has-children dropdown @if(Request::is('charts/*')) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Charts</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-line-chart"></i><a href="{{ route('chartjs') }}">Chart JS</a></li>
                        <li><i class="menu-icon fa fa-area-chart"></i><a href="{{ route('flot') }}">Flot Chart</a></li>
                        <li><i class="menu-icon fa fa-pie-chart"></i><a href="{{ route('peity') }}">Peity Chart</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown  @if(Request::is('maps/*')) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-area-chart"></i>Maps</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-map-o"></i><a href="{{ route('gmap') }}">Google Maps</a></li>
                        <li><i class="menu-icon fa fa-street-view"></i><a href="{{ route('vector') }}">Vector Maps</a></li>
                    </ul>
                </li>
                <li class="menu-title">Extras</li><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown  @if(Request::is('pages/*')) active @endif">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-glass"></i>Pages</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="{{ route('login') }}">Login</a></li>
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="{{ route('register') }}">Register</a></li>
                        <li><i class="menu-icon fa fa-paper-plane"></i><a href="{{ route('forget') }}">Forget Pass</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
