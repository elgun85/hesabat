<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('back/')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{auth()->user()->profile_photo_url}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" data-toggle="modal" data-target="#modal-default">{{Auth::user()->name}}
                    -{{Auth::user()->type}} </a>
            </div>
        </div>


    {{--                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">--}}
    {{--                  Launch Default Modal--}}
    {{--                </button>--}}


    <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Mhm login
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('muser.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>İstifadəçilər</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('category.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kateqoriyalar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('mvezife.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vəzifələr</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Hesabat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('tarif.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tariflər</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('analiz')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tarif analizi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('telyoxla')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Telefon yoxla</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('gelir')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gəlir</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('senedlesme')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sənədləşmə</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('texniki')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Texniki verilənlər</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{route('table')}}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Table
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('test')}}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Test
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->


</aside>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            {{--            <div class="modal-header">--}}
            {{--              <h4 class="modal-title">Default Modal</h4>--}}
            {{--              <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
            {{--                <span aria-hidden="true">&times;</span>--}}
            {{--              </button>--}}
            {{--            </div>--}}
            <div class="modal-body">

                {{--    <a class="dropdown-item" href="{{route('admin.profile')}}" >Ayarlar</a>--}}
                {{--    <a class="dropdown-item" href="#">Another action</a>--}}
                {{--    <a class="dropdown-item" href="#">Something else here</a>--}}
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Ləğv et</button>
                {{--   <li><a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log out</a></li>--}}
                <div>
                    <a href="{{route('logout')}}" class="btn btn-outline-danger"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Çıxış</a>
                    <form action="{{route('logout')}}" id="logout-form" method="POST">
                        @csrf
                    </form>

                </div>


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



