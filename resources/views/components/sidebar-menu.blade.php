<aside class="main-sidebar sidebar-dark-primary flex flex-col">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">GymApp</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
            <div class="info mb-2">
                <a href="#" class="d-block">Administrator</a>
            </div>

{{--        <!-- SidebarSearch Form -->--}}
{{--        <div class="form-inline">--}}
{{--            <div class="input-group" data-widget="sidebar-search">--}}
{{--                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-sidebar">--}}
{{--                        <i class="fas fa-search fa-fw"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Panel główny
{{--                    <i class="right fas fa-angle-left"></i>--}}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Wykresy
{{--                    <i class="right fas fa-angle-left"></i>--}}
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="pages/charts/chartjs.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>TBA</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/charts/flot.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>TBA</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/charts/inline.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>TBA</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Tabele
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('exercises.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ćwiczenia</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('exercises-group.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Grupy ćwiczeń</p>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a href="pages/tables/jsgrid.html" class="nav-link">--}}
{{--                        <i class="far fa-circle nav-icon"></i>--}}
{{--                        <p>jsGrid</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </li>
        <li class="nav-header">Komunikacja</li>
        <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                    Powiadomienia
                    <span class="badge badge-info right">15</span>
                </p>
            </a>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a href="pages/gallery.html" class="nav-link">--}}
{{--                <i class="nav-icon far fa-image"></i>--}}
{{--                <p>--}}
{{--                    Gallery--}}
{{--                </p>--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                    Mailbox
{{--                    <i class="fas fa-angle-left right"></i>--}}
                </p>
            </a>
{{--            <ul class="nav nav-treeview">--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="pages/mailbox/mailbox.html" class="nav-link">--}}
{{--                        <i class="far fa-circle nav-icon"></i>--}}
{{--                        <p>Inbox</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="pages/mailbox/compose.html" class="nav-link">--}}
{{--                        <i class="far fa-circle nav-icon"></i>--}}
{{--                        <p>Compose</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="pages/mailbox/read-mail.html" class="nav-link">--}}
{{--                        <i class="far fa-circle nav-icon"></i>--}}
{{--                        <p>Read</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
        </li>
    </ul>
</nav>
    </div>
</aside>
