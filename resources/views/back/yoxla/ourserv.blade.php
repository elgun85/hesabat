@extends('back.layouts.master')
@section('title','1.'.request()->get('ay').'.'.request()->get('il').' -tarixə olan məlumat')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            @if((request()->get('il')) and (request()->get('ay')) )
                                1.{{request()->get('ay')}}.{{ request()->get('il')}} -tarixə olan məlumat
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
                    <div class="card-title">
                        <form action="#" method="get" name="formdan">
                            @csrf
                            <div class="form-row align-items-center">

                                <div class="col-auto">
                                    <select class="form-control mb-2" name="kat" aria-label="Default select example" >
                                        <option value="" selected>Kateqoriya  </option>
{{--                                        <option value="1" @if(request()->get('kat')==1) selected @endif>Menzil  </option>
                                        <option value="2" @if(request()->get('kat')==2) selected @endif>Qurum  </option>--}}
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2">Göndər</button>
                                </div>
                            </div>
                        </form> </div>

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
                        <div class="col-md-6  ">
                            @foreach($data as $basliq =>$xidmet_novu)
                                <ul class="list-unstyled    table-bordered ">
                                    <li  class=" mt-3 ml-3"><b style="font-size: 16px;">{{$basliq }}</b>
{{--                                    {{dd($xidmet_novu['1.2 Mis'][1][0]->cemi_hesab)}}--}}
{{--                                        @if($xi===' ' and  $gelir->Başlıq === '1.0 Telefon xidmətləri'  )--}}
{{--                                            <b>  {{$gelir->Başlıq}}  üzrə  </b>--}}
{{--                                        @endif--}}
{{--                                        {{   $xidmet_novu->cemi_hesab    }}--}}
                                    </li>
                                    <ul>
                                        @foreach($xidmet_novu as $xidmet => $tar)
                                            <li class="mt-3 ml-3">{{$xidmet}}  </li>
                                            @foreach($tar as $key)
                                                @foreach($key as $koftarif)
                                                    <ul>
                                                        <li class=" ml-3">
                                                                <?php
                                                                $bul = ['Ў','ў','Ё','ё','·','√','№','¤', 'Ї','ї', '°','∙','Є','є'];
                                                                $dey=  ['Ə','ə','Ö','ö','I','ı','Ü','ü', 'Ş','ş', 'Ğ','ğ','Ç','ç'];
                                                                ?>
                                                            {{$koftarif->KODTARIF}}
                                                            {{str_replace( $bul,$dey,$koftarif->adtarif)}}
                                                            <span class="badge rounded-pill bg-light float-end">{{$koftarif->cemi_hesab}}</span>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </ul>
                            @endforeach
                        </div>








                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
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
