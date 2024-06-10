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
                <li class="nav-item
                @if(
    Request::segment(2)=='muser' or
    Request::segment(2)=='category' or
    Request::segment(2)=='mvezife'
     ) menu-open @endif
">
                    <a href="#" class="nav-link
                @if(
    Request::segment(2)=='muser' or
    Request::segment(2)=='category' or
    Request::segment(2)=='mvezife'
     ) active @endif
                        ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Mhm login
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('muser.index')}}" class="nav-link @if (Request::segment(2)=='muser') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>İstifadəçilər</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('category.index')}}" class="nav-link @if (Request::segment(2)=='category') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kateqoriyalar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('mvezife.index')}}" class="nav-link @if (Request::segment(2)=='mvezife') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vəzifələr</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item
                @if(
    Request::segment(2)=='navbar' or
    Request::segment(2)=='about'
     ) menu-open @endif
">
                    <a href="#" class="nav-link

                                    @if (
    Request::segment(2)=='navbar' or
    Request::segment(2)=='about'
     ) active @endif
                    ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Site
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('navbar.index')}}" class="nav-link @if (Request::segment(2)=='navbar') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Navbar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('about.index')}}" class="nav-link @if (Request::segment(2)=='about') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About</p>
                            </a>
                        </li>


                    </ul>
                </li>






                <li class="nav-item
                @if (
    Request::segment(2)=='Data_monthly' or
    Request::segment(2)=='aciqlama' or
    Request::segment(2)=='data_naz'  or
    Request::segment(2)=='data_cari'  or
    Request::segment(2)=='hes_siyahi'  or
    Request::segment(2)=='siyahi'  or
    Request::segment(2)=='sen_edv'  or
    Request::segment(2)=='senedlesme'  or
    Request::segment(2)=='hesablanma'  or
    Request::segment(2)=='gelir'
     ) menu-open @endif

                ">
                    <a href="#" class="nav-link
@if (
    Request::segment(2)=='Data_monthly' or
    Request::segment(2)=='aciqlama' or
    Request::segment(2)=='data_naz'  or
    Request::segment(2)=='data_cari'  or
    Request::segment(2)=='hes_siyahi'  or
    Request::segment(2)=='siyahi'  or
    Request::segment(2)=='sen_edv'  or
    Request::segment(2)=='senedlesme'  or
    Request::segment(2)=='hesablanma'  or
    Request::segment(2)=='gelir'
     ) active @endif
">
                        <i class="nav-icon fas fa-chart-bar" ></i>
                        <p>
                            Hesabat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('Data_monthly')}}" class="nav-link @if (Request::segment(2)=='Data_monthly') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Data monthly</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('aciqlama')}}" class="nav-link @if (Request::segment(2)=='aciqlama') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Data_M Açıqlama</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('data_naz')}}" class="nav-link @if (Request::segment(2)=='data_naz') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Data  nazirlik</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('data_cari')}}" class="nav-link @if (Request::segment(2)=='data_cari') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Data_cari</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('hes_siyahi')}}" class="nav-link @if (Request::segment(2)=='hes_siyahi') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Hesablanan mebleg</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('siyahi')}}" class="nav-link @if (Request::segment(2)=='siyahi') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Siyahı(Ədv-siz)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('sen_edv')}}" class="nav-link @if (Request::segment(2)=='sen_edv') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sənədləşmə(Ədv-siz)</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('senedlesme')}}" class="nav-link @if (Request::segment(2)=='senedlesme') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sənədləşmə</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('hesablanma')}}" class="nav-link @if (Request::segment(2)=='hesablanma') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hesablanma</p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="{{route('gelir')}}" class="nav-link @if (Request::segment(2)=='gelir') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gəlir</p>
                            </a>
                        </li>


                    </ul>
                </li>




                <li class="nav-item
                 @if (
    Request::segment(2)=='kod_tarif' or
    Request::segment(2)=='telyoxla'  or
    Request::segment(2)=='xidmet'  or
    Request::segment(2)=='tarif'  or
    Request::segment(2)=='texXid'  or
    Request::segment(2)=='hes_yoxla'  or
    Request::segment(2)=='hes_yoxla5'  or
/*    Request::segment(2)=='ourserv'  or*/
    Request::segment(2)=='texniki'
     ) menu-open @endif

                 ">

                    <a href="#" class="nav-link
@if (
    Request::segment(2)=='kod_tarif' or
    Request::segment(2)=='telyoxla'  or
    Request::segment(2)=='xidmet'  or
    Request::segment(2)=='tarif'  or
    Request::segment(2)=='texXid'  or
    Request::segment(2)=='hes_yoxla'  or
    Request::segment(2)=='hes_yoxla5'  or
/*    Request::segment(2)=='ourserv'  or*/
    Request::segment(2)=='texniki'
     ) active @endif
                        ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Analiz
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('kod_tarif')}}" class="nav-link @if (Request::segment(2)=='kod_tarif') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kad tarif</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('hes_yoxla')}}" class="nav-link @if (Request::segment(2)=='hes_yoxla') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hesablanma yoxla</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('hes_yoxla5')}}" class="nav-link @if (Request::segment(2)=='hes_yoxla5') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>hes_yoxla5</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('telyoxla')}}" class="nav-link @if (Request::segment(2)=='telyoxla') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Xidmet yoxla</p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="{{route('xidmet')}}" class="nav-link @if (Request::segment(2)=='xidmet') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Xidmet analizi</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('tarif.index')}}" class="nav-link @if (Request::segment(2)=='tarif') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tariflər</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('texXid')}}" class="nav-link @if (Request::segment(2)=='texXid') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tex xid(289)</p>
                            </a>
                        </li>

{{--                        <li class="nav-item">
                            <a href="{{route('ourserv')}}" class="nav-link @if (Request::segment(2)=='ourserv') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Our Serv</p>
                            </a>
                        </li>--}}

                        <li class="nav-item">
                            <a href="{{route('texniki')}}" class="nav-link @if (Request::segment(2)=='texniki') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Texniki verilənlər</p>
                            </a>
                        </li>


                    </ul>
                </li>



                <li class="nav-item
                       @if (
                     Request::segment(2)=='mus' or
                     Request::segment(2)=='analyst' or
                     Request::segment(2)=='data_montly_analiz' or
                     Request::segment(2)=='data_montly_ourserv' or
                     Request::segment(2)=='edv_sened_ourserv' or
                     Request::segment(2)=='edv_siyahi_ourserv' or
                     Request::segment(2)=='data_naz_ourserv'
                         ) menu-open
                     @endif
                     ">
                    <a href="#" class="nav-link
                      @if (
                     Request::segment(2)=='data_montly_analiz' or
                     Request::segment(2)=='mus' or
                     Request::segment(2)=='analyst' or
                     Request::segment(2)=='data_montly_ourserv' or
                     Request::segment(2)=='edv_sened_ourserv' or
                     Request::segment(2)=='edv_siyahi_ourserv' or
                     Request::segment(2)=='data_naz_ourserv'
                         ) active
                     @endif"
                    >
                        <i class="nav-icon fas fa-chart-pie"></i>

                        <p>
                            Ourserv
                            <i class="right fas fa-angle-left"></i>
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" >
                            <a href="{{route('mus')}}" class="nav-link @if ( Request::segment(2)=='mus' ) active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Muhasibatliq</p>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{route('analyst')}}" class="nav-link @if ( Request::segment(2)=='analyst' ) active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Yoxla </p>
                            </a>
                        </li>
{{--                        <li class="nav-item" >
                            <a href="{{route('data_montly_analiz')}}" class="nav-link @if ( Request::segment(2)=='data_montly_analiz' ) active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data montly analiz</p>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{route('data_montly_ourserv')}}" class="nav-link @if ( Request::segment(2)=='data_montly_ourserv' ) active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data montly</p>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{route('data_naz_ourserv')}}" class="nav-link @if ( Request::segment(2)=='data_naz_ourserv' ) active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data nazirlik</p>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{route('edv_sened_ourserv')}}" class="nav-link @if ( Request::segment(2)=='edv_sened_ourserv' ) active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ədv-siz sənədləşmələr</p>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{route('edv_siyahi_ourserv')}}" class="nav-link @if ( Request::segment(2)=='edv_siyahi_ourserv' ) active @endif ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ədv-siz siyahi</p>
                            </a>
                        </li>
                        --}}
                    </ul>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Numuneler
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('saxeli')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>İstifadəçilər (saxeli)</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('vurma')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vurma cedveli</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('api')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Api</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('test1')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>test1</p>
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
                    <a href="{{route('import')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-import " style="color: red"></i>
                        <p>
                            Import
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



