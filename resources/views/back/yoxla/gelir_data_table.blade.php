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
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


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
