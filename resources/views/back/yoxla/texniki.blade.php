@extends('back.layouts.master')
@section('title',' Ats ' .request()->get('ats'). ' üzrə Texniki verilənlər')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            @if((request()->get('ats'))  )
                               Ats {{request()->get('ats')}} üzrə Texniki verilənlər
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
                    <div class="card-title"> <form action="{{route('texniki')}}" method="get" name="formdan">
                            @csrf
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <select class="form-control mb-2" name="ats" aria-label="Default select example" >

                                        <option value="" selected >Ats seçin  </option>

                                        @if(request()->get('ats') !=0)
                                        <option  @if(request()->get('ats')) selected @endif   value="{{request()->get('ats')}}">{{request()->get('ats')}}</option>
                                        @endif

                                        @foreach($atsler as $ats)

                                            @if(request()->get('ats')!=$ats->ats)
                                                <option    value="{{$ats->ats}}">{{$ats->ats}}</option>
                                            @endif


                                        @endforeach

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



                    @if (request()->get('ats') )

                        {{--                cedvel evvel --}}
<div class="text-danger">Cəmi: {{$say}}</div>
                        <br>

                        <table id="example1" class="table table-bordered table-striped ">

                            <thead class="text-center text-bold">

                            <tr >
                                <td>#</td>
                                <td>Telefon</td>
                                <td>Ats</td>
                                <td>Şkaf</td>
                                <td>Ad,soyad</td>
                                <td>Ünvan</td>
                                <td>Tarif</td>
                                <td>Kat</td>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($data as $texniki)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$texniki->telefon}}</td>
                                    <td>{{$texniki->ats}}</td>
                                    <td>{{$texniki->skaf}}</td>
                                    <td class="text-left">{{$texniki->ad}}</td>
                                    <td class="text-left">{{$texniki->unvan}}</td>
                                    <td>{{$texniki->tarif}}</td>
                                    <td>{{$texniki->abonent}}</td>

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
                "pageLength": 10,
                "lengthMenu": [ [10,15, 25, 50, -1], [10,15, 25, 50, "All"] ],
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
