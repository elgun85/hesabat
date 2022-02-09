@extends('back.layouts.master')
@section('title','Aylıq xidmətlər üzrə hesabat')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            @if((request()->get('il')) and (request()->get('ay')) )
                                {{request()->get('ay')}}-{{ request()->get('il')}} Aylıq xidmətlər üzrə hesabat
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
                   <div class="card-title"> <form action="{{route('gelir')}}" method="get" name="formdan">
                            @csrf
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <select class="form-control mb-2" name="ay" aria-label="Default select example" >
                                        <option value="" selected>Ay seçin  </option>
                                        <option @if (request()->get('ay')=='1') selected  @endif value="1">Yanvar</option>
                                        <option @if (request()->get('ay')=='2') selected  @endif value="2">Fevral</option>
                                        <option @if (request()->get('ay')=='3') selected  @endif value="3">Mart</option>
                                        <option @if (request()->get('ay')=='4') selected  @endif value="4">Aprel</option>
                                        <option @if (request()->get('ay')=='5') selected  @endif value="5">May</option>
                                        <option @if (request()->get('ay')=='6') selected  @endif value="6">İyun</option>
                                        <option @if (request()->get('ay')=='7') selected  @endif value="7">İyul</option>
                                        <option @if (request()->get('ay')=='8') selected  @endif value="8">Avqust</option>
                                        <option @if (request()->get('ay')=='9') selected  @endif value="9">Sentyabr</option>
                                        <option @if (request()->get('ay')=='10') selected  @endif value="10">Oktyabr</option>
                                        <option @if (request()->get('ay')=='11') selected  @endif value="11">Noyabr</option>
                                        <option @if (request()->get('ay')=='12') selected  @endif value="12">Dekabr</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control mb-2" name="il" aria-label="Default select example" >
                                        <option value="" selected>İl seçin  </option>
                                        <option @if (request()->get('il')=='2021') selected  @endif value="2021">2021</option>
                                        <option @if (request()->get('il')=='2022') selected  @endif value="2022">2022</option>

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



    @if (request()->get('il') and request()->get('ay'))

        {{--                cedvel evvel --}}

        <div class="col-md-8">

        </div>
        <div class="col-md-4 float-right"> <button id="exporttable" class="btn btn-primary">Export</button> </div>
</div>


        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Rabitə xidmətləri</th>
                <th>Say(M)</th>
                <th>Ədv məb(M)</th>
                <th>Əsas məb(M)</th>
                <th>Məbləg(M)</th>

                <th>Say(Q)</th>
                <th>Ədv məb(Q)</th>
                <th>Əsas məb(Q)</th>
                <th>Məbləg(Q)</th>

                <th>Say(C)</th>
                <th>Ədv məb(C)</th>
                <th>Əsas məb(C)</th>
                <th>Məbləg(C)</th>

            </tr>

            </thead>
            <tbody>

            @php
                $cemi_hesab_sum = 0
            @endphp

            @foreach($data as $gelir)

                <tr>

                    <td>{{$gelir->xidmetin_novu}}</td>
                    <td>{{$gelir->menzil_say}}</td>
                    <td>edv</td>
                    <td>{{round(($gelir->menzil_summa/1.18),2)}}</td>
                    <td>{{$gelir->menzil_summa}}</td>
                    <td>{{$gelir->idere_say}}</td>
                    <td>edv</td>
                    <td>{{round(($gelir->idere_summa/1.18),2)}}</td>
                    <td>{{$gelir->idere_summa}}</td>
                    <td>{{$gelir->cemi_say}}</td>
                    <td>edv</td>
                    <td>{{round(($gelir->cemi_hesab/1.18),2)}}</td>
                    <td>{{$gelir->cemi_hesab}}</td>





                </tr>

                @php
                    $cemi_hesab_sum += $gelir->cemi_hesab
                @endphp
            @endforeach


            </tbody>
            <tfoot>


            <tr>
                <th>Rabitə xidmətləri</th>
                <th>Say(M)</th>
                <th>Ədv məb(M)</th>
                <th>Əsas məb(M)</th>
                <th>Məbləg(M)</th>

                <th>Say(Q)</th>
                <th>Ədv məb(Q)</th>
                <th>Əsas məb(Q)</th>
                <th>Məbləg(Q)</th>

                <th>Say(C)</th>
                <th>Ədv məb(C)</th>
                <th>Əsas məb(C)</th>
                <th>Məbləg(C)</th>

            </tr>

            </tfoot>
        </table>
        {{--                cedvel son--}}

{{--        {{ $cemi_hesab_sum }}--}}

    @endif



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


    @section('table_css')
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
        <style>body {
                background-color: #f9f9fa
            }

            .flex {
                -webkit-box-flex: 1;
                -ms-flex: 1 1 auto;
                flex: 1 1 auto
            }

            @media (max-width:991.98px) {
                .padding {
                    padding: 1.5rem
                }
            }

            @media (max-width:767.98px) {
                .padding {
                    padding: 1rem
                }
            }

            .padding {
                padding: 5rem
            }

            .card {
                box-shadow: none;
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
                -ms-box-shadow: none
            }

            .pl-3,
            .px-3 {
                padding-left: 1rem !important
            }

            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid #d2d2dc;
                border-radius: 0
            }

            .card .card-title {
                color: #000000;
                margin-bottom: 0.625rem;
                text-transform: capitalize;
                font-size: 0.875rem;
                font-weight: 500
            }

            .card .card-description {
                margin-bottom: .875rem;
                font-weight: 400;
                color: #76838f
            }

            p {
                font-size: 0.875rem;
                margin-bottom: .5rem;
                line-height: .2rem
            }

            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar
            }

            .table,
            .jsgrid .jsgrid-table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 1rem;
                background-color: transparent
            }

            .table thead th,
            .jsgrid .jsgrid-table thead th {
                border-top: 0;
                border-bottom-width: 1px;
                font-weight: 500;
                font-size: .875rem;
                text-transform: uppercase
            }

            .table td,
            .jsgrid .jsgrid-table td {
                font-size: 0.875rem;
                padding: .875rem 0.9375rem
            }

            .badge {
                border-radius: 0;
                font-size: 12px;
                line-height: 1;
                padding: .375rem .5625rem;
                font-weight: normal
            }

            .btn {
                border-radius: 0
            }</style>
    @endsection
@section('table_js')
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.table2excel.min.js"></script>

    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src=''></script>
    <script type='text/Javascript'>$(function() {
            $("#exporttable").click(function(e){
                var table = $("#example1");
                if(table && table.length){
                    $(table).table2excel({
                        exclude: ".noExl",
                        name: "Excel Document Name",
                        filename: "Aylıq xidmətlər" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                        fileext: ".xls",
                        exclude_img: true,
                        exclude_links: true,
                        exclude_inputs: true,
                        preserveColors: false
                    });
                }
            });

        });</script>
@endsection



{{--@section('data_table_ccs')--}}
{{--    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>--}}
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.2.1/b-colvis-2.2.1/b-html5-2.2.1/b-print-2.2.1/kt-2.6.4/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.css"/>--}}
{{--@endsection--}}

{{--@section('data_table_js')--}}
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.2.1/b-colvis-2.2.1/b-html5-2.2.1/b-print-2.2.1/kt-2.6.4/sb-1.3.0/sp-1.4.0/sl-1.3.4/datatables.min.js"></script>--}}

{{--    <script>--}}
{{--        $(function () {--}}
{{--            $("#example1").DataTable({--}}
{{--                "pageLength": 15,--}}
{{--                "lengthMenu": [ [15, 25, 50, -1], [15, 25, 50, "All"] ],--}}
{{--                "responsive": true,--}}
{{--                // "lengthChange": false,--}}
{{--                // "autoWidth": false,--}}
{{--                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]--}}
{{--            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');--}}


{{--            $('#example2').DataTable({--}}
{{--                "paging": true,--}}
{{--                "lengthChange": false,--}}
{{--                "searching": false,--}}
{{--                "ordering": true,--}}
{{--                "info": true,--}}
{{--                "autoWidth": false,--}}
{{--                "responsive": true,--}}
{{--            });--}}
{{--        });--}}


{{--    </script>--}}
{{--@endsection--}}





@endsection
