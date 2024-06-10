@extends('back.layouts.master')
@section('title',request()->get('ay').' '.request()->get('il').' Hesablanmış məbləğ ')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            @if((request()->get('il')) and (request()->get('ay')) )
                                {{request()->get('ay')}}-{{ request()->get('il')}}  @yield('title') üzrə siyahı
                            @endif

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
                    <div class="card-title"> <form action="{{route('hesablanmis_mebleg')}}" method="get" name="formdan">
                            @csrf
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <select class="form-control mb-2" name="ay" aria-label="Default select example" >
                                        <option value="" selected>Ay seçin  </option>
                                        @if(request()->get('ay') !=0)
                                            <option  @if(request()->get('ay')) selected @endif   value="{{request()->get('ay')}}">{{request()->get('ay')}}</option>
                                        @endif
                                        @foreach($aylar as $ay)
                                            @if(request()->get('ay')!=$ay->ay)
                                                <option    value="{{$ay->ay}}">{{$ay->ay}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control mb-2" name="il" aria-label="Default select example" >
                                        <option value="" selected>İl seçin  </option>
                                        @if(request()->get('ay') !=0)
                                            <option  @if(request()->get('il')) selected @endif   value="{{request()->get('il')}}">{{request()->get('il')}}</option>
                                        @endif
                                        @foreach($iller as $il)
                                            @if(request()->get('il')!=$il->il)
                                                <option    value="{{$il->il}}">{{$il->il}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>


                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2">Göndər</button>
                                </div>
                            </div>
                        </form>
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
                    @if (request()->get('il') and request()->get('ay'))
                        {{--                cedvel evvel --}}
                        <table id="example1" class="table table-bordered table-striped ">
                            <thead class="text-center text-bold">
                            <tr >
                                <td class="text-left"> {{request()->get('ay')}}-{{ request()->get('il')}}</td>
                                <td colspan="6" class="text-center">Cəmi</td>
                            </tr>
                            <tr >
                                <td class="text-left" >#</td>
                                <td>Telefon</td>
                                <td>KODQURUM</td>
                                <td>KODMHM</td>
                                <td>ABONENT</td>
                                <td>hesablama</td>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $bul = ['Ў','ў','Ё','ё','·','√','№','¤', 'Ї','ї', '°','∙','Є','є'];
                                $dey=  ['Ə','ə','Ö','ö','I','ı','Ü','ü', 'Ş','ş', 'Ğ','ğ','Ç','ç'];
                                ?>
                            @foreach($data as $item)
                                <tr class="text-center">
                                    <td class="text-left" >
                                        {{$loop->iteration}}
                                    </td>

                                    <td>{{$item->notel}}</td>
                                    <td>{{$item->KODQURUM}}</td>
                                    <td>{{$item->KODMHM}}</td>
                                    <td>{{$item->ABONENT}}</td>
                                    <td>{{$item->cemi_hesablama}}</td>
                                </tr>
                            @endforeach


                            </tbody>
                            <tfoot >
                            </tfoot>
                        </table>
                        {{--                cedvel son--}}
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>


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
