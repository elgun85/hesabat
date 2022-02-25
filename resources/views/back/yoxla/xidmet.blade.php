@extends('back.layouts.master')
@section('title','Xidmətlər üzrə hesabat')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
{{--                            @if((request()->get('il')) and (request()->get('ay')) )--}}
{{--                                {{request()->get('ay')}}-{{ request()->get('il')}} Aylıq xidmətlər üzrə hesabat--}}
{{--                            @endif--}}
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
                        <div class="col-md-8">
{{--                            <h4 class="card-title">Cemi -{{$say}}</h4>--}}
                        </div>
                        <div class="col-md-4 text-right"> <button id="exporttable" class="btn btn-primary">Excel</button> </div>
                    </div>
                        {{--                cedvel evvel --}}
                        <div class="table-responsive ">
                            <table id="htmltable" class="table table-bordered table-hover">
                                <thead class="thead-light">
{{--                                <tr >--}}
{{--                                    <td class="text-left"> {{request()->get('ay')}}-{{ request()->get('il')}}</td>--}}
{{--                                    <td colspan="4" class="text-center" >Mənzil</td>--}}
{{--                                    <td colspan="4" class="text-center">Qurum</td>--}}
{{--                                    <td colspan="4" class="text-center">Cəmi</td>--}}


{{--                                </tr>--}}
                                <tr>
                                    <th>kod</th>
                                    <th>tarif</th>
                                    <th>men_say</th>
                                    <th>men_hes</th>
                                    <th>qur_say</th>
                                    <th>qur_hes</th>
                                    <th>cem_say</th>
                                    <th>cem_hes</th>
{{--                                    <th>diger</th>--}}


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $tar)

                                    <tr class="text-left
                                    @if($tar->tarif===' ')
                                         text-danger text-bold
                                    @endif
                                    "
                                    >
                                        <td>{{$tar->tarif}}


                                            @if($tar->tarif===' ' and  $tar->Qrup === 'Telefon' and !$tar->xidmetin_novu)
                                                <b>  {{$tar->Qrup}} xidmətləri üzrə  </b>
                                            @endif
                                            @if($tar->tarif===' ' and  $tar->Qrup === 'Internet' and !$tar->xidmetin_novu)
                                                <b>  {{$tar->Qrup}} xidmətləri üzrə </b>
                                            @endif
                                            @if($tar->tarif===' ' and  $tar->Qrup === 'Sair' and !$tar->xidmetin_novu)
                                                <b>  {{$tar->Qrup}} xidmətləri üzrə </b>
                                            @endif


                                            @if($tar->tarif===' ')
                                                <b>  {{$tar->xidmetin_novu}} cəmi  </b>
                                            @endif

                                        </td>



                                        @if($tar->tarif===' ')
                                        <td>&nbsp;</td>

                                        @else
                                            <td>{{$tar->adtarif}}</td>
                                        @endif

                                        <td>{{$tar->menzil_say}}</td>
                                        <td>{{$tar->menzil_summa}}</td>
                                        <td>{{$tar->idere_say}}</td>
                                        <td>{{$tar->idere_summa}}</td>
                                        <td>{{$tar->cemi_say}}</td>
                                        <td>{{$tar->cemi_hesab}}</td>
{{--                                        <td>{{$tar->Diger_say}}</td>--}}



                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                        {{--                cedvel son--}}

                        {{--        {{ $cemi_hesab_sum }}--}}

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

@section('gel_sen_css')
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <style>
        body {
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

@section('gel_sen_js')
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.table2excel.min.js"></script>

    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src=''></script>
    <script type='text/Javascript'>$(function() {
            $("#exporttable").click(function(e){
                var table = $("#htmltable");
                if(table && table.length){
                    $(table).table2excel({
                        exclude: ".noExl",
                        name: "Excel Document Name",
                        filename: "Gelir_Sair_" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
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






@endsection
