@extends('back.layouts.master')
@section('title','Əsas və əlavə xidmet üzrə analiz')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>

                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Ana səhifə</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        @yield('title')
                    </div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="card">
            <form method="GET" action="{{route('internet_xidmeti_analizi')}}">
                @csrf
                <div class="card-header">
                    <div class="form-group"> Texnologiya Seçin</div>
                </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1"> </label>
                                <select class="form-control" name="category" aria-label="Default select example" >
                                    <option value="" selected>Texnologiya seçin  </option>
                                    <option @if (request()->get('category')=='Adsl') selected  @endif value="Adsl">Adsl</option>
                                    <option @if (request()->get('category')=='Gpon') selected  @endif value="Gpon">Gpon</option>
                                    <option @if (request()->get('category')=='Gpon Kampaniya') selected  @endif value="Gpon Kampaniya">Gpon Kampaniya</option>
                                    <option @if (request()->get('category')=='Ip Tv') selected  @endif value="Ip Tv">Ip Tv</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kateqoriya seçin {{old('novu')}} </label>
                                <select class="form-control" name="novu" aria-label="Default select example" >
                                    <option  value="" selected>Sec</option>
                                    <option  @if(request()->get('novu')=='Hamısı') selected @endif value="Hamısı" >Hamısı</option>
                                    <option @if(request()->get('novu')=='Mənzil') selected @endif value="Mənzil">Əhali</option>
                                    <option @if(request()->get('novu')=='Qeyri Əhali') selected @endif value="Qeyri Əhali">Qeyri Əhali</option>
                                </select>
                                @error('novu') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="form-group">
                            @if(request()->get('category')||request()->get('novu'))
                                <a href="{{route('internet_xidmeti_analizi')}}" class="btn btn-outline-secondary"><i class="fas fa-sync-alt"></i></a>
                            @endif
                            <button type="submit" class="btn btn-primary float-right">Gonder</button>
                                </div>
                        </div>
            </form>
                            </div>
                        </div>

        <div class="col-sm-7">
            <div class="card">
                <form name="xidmet_sec"  method="GET" action="{{route('internet_xidmeti_analizi')}}">
                    @csrf
                    <div class="card-header">
                        <a href="{{route('internet_xidmeti_analizi')}}" class="btn btn-outline-secondary float-left"><i class="fas fa-sync-alt"></i></a>

                        <button type="submit" class="btn btn-primary float-right"> Axtar</button>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="esas" class="">Əsas xidmət</label>
                            <input id="esas" type="text" name="esas" class="form-control" placeholder="Əsas xidmət axtarışı üçün tarif kodu yazin">
                        </div>
                        <div class="form-group">
                            <label for="elave" class="">Əlavə xidmət</label>
                            <input id="elave" type="text" name="elave" class="form-control" placeholder="Tarifin axtarışı üçün kodunu yazin...">
                        </div>

                        <div class="form-group">
                            <label for="abon1">Abonent {{old('abonent')}} </label>
                            <select id="abon1" class="form-control" name="abonent" aria-label="Default select example" >
                                <option  value="" selected >Seçin</option>
                                <option  value="1">1 </option>
                                <option  value="2">2 </option>
                                <option  value="8">8 </option>
                            </select>
                            @error('abonent') <p class="text-danger">{{$message}}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label  for="abon2">Abonent2 {{old('abonent2')}} </label>
                            <select id="abon2" class="form-control" name="abonent2" aria-label="Default select example" >
                                <option value="" selected >Seçin</option>
                                <option  value="0">0 </option>
                                <option  value="2">2 </option>
                            </select>
                            @error('abonent2') <p class="text-danger">{{$message}}</p> @enderror
                        </div>

                        @if(request()->get('category')||request()->get('novu'))

                        <div class="card-header">
                            <h3 class="card-title">{{$category}}</h3>
                        </div>

                        <table class="table table-hover ">
                            <thead>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="col"> <input type="checkbox" id="checkAll">  Seç kod</th>

                                <th>Ad</th>
                                <th>Mənzil</th>
                                <th>Qurum</th>
                                <th>Status</th>
                            </tr>
                            @foreach($inter_tarif as $internet)
                                <tr>
                                    <td>
                                        <input name='internet[]' type="checkbox" id="checkItem"  value="{{$internet->kod}}">
                                        {{$internet->kod}}
                                    </td>
                                    <td>{{substr($internet->name,0,40)}} </td>
                                    <td>{{$internet->mebleg}} </td>
                                    <td>{{$internet->mebleg_q}} </td>
                                    <td> {{$internet->novu}}</td>
                                    <td> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                       @endif
                    </div>
                    <div class="card-footer">
                        @if(request()->get('category')||request()->get('abonent')||request()->get('abonent2')||request()->get('esas')||request()->get('internet[]')
)
                            <a href="{{route('internet_xidmeti_analizi')}}" class="btn btn-outline-secondary">Sıfırla</a>
                        @endif

                        <button type="submit" class="btn btn-primary float-right">Gonder</button>
                    </div>
                </form>
            </div>
        </div>

@if(request()->get('esas')||request()->get('elave')||request()->get('abonent')||request()->get('abonent2')||request()->get('internet'))
                        {{--                cedvel evvel --}}
                        <table id="example1" class="table table-bordered table-striped ">
                            <thead class="text-center text-bold">
                            <tr >
                                <td class="text-left"> {{request()->get('ay')}}-{{ request()->get('il')}}</td>
                                <td colspan="6" class="text-center">Cəmi</td>
                            </tr>
                            <tr >
                                <td class="text-left" >#</td>
                                <td class="text-left" >Telefon</td>
                                <td>Əsas Xid</td>
                                <td>Abon</td>

                                <td>Əlavə xid</td>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $bul = ['Ў','?','ў','Ё','ё','·','√','№','¤', 'Ї','ї', '°','∙','Є','є'];
                                $dey=  ['Ə','Ə','ə','Ö','ö','I','ı','Ü','ü', 'Ş','ş', 'Ğ','ğ','Ç','ç'];
                           {{-- {{str_replace( $bul,$dey,$item->ADQURUM)}}--}}
                                ?>
                            @foreach($search as $item)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->notel}}</td>
                                    <td>{{$item->main_tarif}}

                                      {{--  {{substr(str_replace( $bul,$dey,$item->adtarif),0,40)}}--}}
                                    </td>
                                    <td>
                                        @if($item->ABONENT == 1 and $item->ABONENT2 == 0)
                                            Mənzil
                                        @endif
                                        @if($item->ABONENT==1 and $item->ABONENT2 == 2)
                                            Mənzidə qurum

                                        @endif
                                        @if($item->ABONENT == 2 and $item->ABONENT2 == 0)
                                            Qurum

                                        @endif
                                    </td>
                                    <td>{{$item->KODTARIF}}
                                        {{substr(str_replace( $bul,$dey,$item->adtarif),0,40)}}
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                            <tfoot >
                            </tfoot>
                        </table>
                        {{--                cedvel son--}}
        @endif
    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>

    @section('select_all')
        {{--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
        <script language="javascript">

            $("#checkAll").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        </script>
    @endsection
    @section('data_table_ccs')
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.2.1/b-colvis-2.2.1/b-html5-2.2.1/b-print-2.2.1/kt-2.6.4/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.css"/>
    @endsection

    @section('data_table_js')
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.2.1/b-colvis-2.2.1/b-html5-2.2.1/b-print-2.2.1/kt-2.6.4/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.js"></script>

        <script>
            $(function () {
                $("#example1").DataTable({
                    "pageLength": 15,
                    "lengthMenu": [ [15, 25, 50, -1], [15, 25, 50, "All"] ],
                    "responsive": true,
                    // "lengthChange": false,
                    // "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    //         buttons: [
                    //             {
                    //                 extend: 'excelHtml5',
                    //                 text: 'Save current page',
                    //                 exportOptions: {
                    //                     modifier: {
                    //                         page: 'current'
                    //                     }
                    //                 }
                    //             }
                    //         ]

                })
                    .buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });


        </script>
    @endsection



@endsection
