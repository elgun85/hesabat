@extends('back.layouts.master')
@section('title','Rabitə nazirliklər  üzrə hesabat')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            @if((request()->get('il')) and (request()->get('ay')) )
                                {{request()->get('ay')}}-{{ request()->get('il')}} Rabitə nazirliklər üzrə hesabat
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
                    <div class="card-title"> <form action="{{route('data_naz')}}" method="get" name="formdan">
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
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title">Basic Table</h4>
                        </div>
                        <div class="col-md-4 text-right"> <button id="exporttable" class="btn btn-primary">Excel</button> </div>
                    </div>
                        {{--                cedvel evvel --}}
                        <div class="table-responsive ">
                            <table id="htmltable" class="table table-bordered table-hover">
                                <thead class="thead-light">
                                <tr >
                                    <td class="text-left"> {{request()->get('ay')}}-{{ request()->get('il')}}</td>
{{--                                    <td colspan="4" class="text-center" >Mənzil</td>
                                    <td colspan="4" class="text-center">Qurum</td>--}}
                                    <td colspan="4" class="text-center">Cəmi</td>


                                </tr>
                                <tr>
                                    <th>Rabitə xidmətləri</th>
{{--                                    <th>Say(M)</th>
                                    <th>Ədv məb(M)</th>
                                    <th>Əsas məb(M)</th>
                                    <th>Məbləg(M)</th>

                                    <th>Say(Q)</th>
                                    <th>Ədv məb(Q)</th>
                                    <th>Əsas məb(Q)</th>
                                    <th>Məbləg(Q)</th>--}}

                                    <th>Say</th>
                                    <th>Ədv məbləğ</th>
                                    <th>Əsas məbləğ</th>
                                    <th>Məbləğ</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($gelirler as $gelir)
{{--
                                    <tr class="text-center text-success text-bold"><td colspan="5">{{$gelir->Başlıq}}</td></tr>
--}}
                                    <tr class="text-left
                                    @if($gelir->xidmetin_novu===' ')
                                        text-danger text-bold
                                    @endif
                                        " >

                                    <tr class="text-left">




                                       <td>{{$gelir->xidmetin_novu}}

                                           @if($gelir->xidmetin_novu===' ' and  $gelir->Başlıq === '1.0 Telefon xidmətləri'  )
                                               <b>  {{$gelir->Başlıq}}  üzrə  </b>
                                           @endif
                                           @if($gelir->xidmetin_novu===' ' and  $gelir->Başlıq === '4.1 İcarə haqqı (Portların  icarəsi)')
                                               <b>  {{$gelir->Başlıq}}  üzrə </b>
                                           @endif
                                           @if($gelir->xidmetin_novu===' ' and  $gelir->Başlıq === '4.2 İcarə haqqı (Avadanlıqların icarəsi)')
                                               <b>  {{$gelir->Başlıq}}  üzrə </b>
                                           @endif

                                           @if($gelir->xidmetin_novu===' ' and  $gelir->Başlıq === '4.3 İcarə haqqı (Kabellərin  icarəsi)')
                                               <b>  {{$gelir->Başlıq}}  üzrə </b>
                                           @endif

                                           @if($gelir->xidmetin_novu===' ' and  $gelir->Başlıq === '5. Servis (ƏDX)')
                                               <b>  {{$gelir->Başlıq}}  üzrə </b>
                                           @endif

                                           @if($gelir->xidmetin_novu===' ' and  $gelir->Başlıq === '6. Digər')
                                               <b>  {{$gelir->Başlıq}}  üzrə </b>
                                           @endif


                                           @if($gelir->xidmetin_novu===' ')
                                               <b>  {{$gelir->xidmetin_novu}} Cəmi  </b>
                                           @endif

                                       </td>
                                        {{--
                                                                                <td>{{$gelir->menzil_say}}</td>
                                                                                <td>{{round(($gelir->menzil_summa-($gelir->menzil_summa/1.18)),2)}}</td>
                                                                                <td>{{round(($gelir->menzil_summa/1.18),2)}}</td>
                                                                                <td>{{$gelir->menzil_summa}}</td>


                                                                                <td>{{$gelir->idere_say}}</td>
                                                                                <td>{{$qur_edv=round(($gelir->idere_summa-round((($gelir->idere_summa-$gelir->idere_edv)/1.18+$gelir->idere_edv),2)),2)}}</td>
                                                                                <td>{{$esas_idare_mebleg=round((($gelir->idere_summa-$gelir->idere_edv)/1.18+$gelir->idere_edv),2)}}</td>
                                                                                <td>{{$qur_meb=round(($gelir->idere_summa),2)}}</td>
                                        --}}

                                        <td>{{$gelir->cemi_say}}</td>
                                        <td>{{number_format($edv_umumi=round(($gelir->cemi_hesab-round((($gelir->cemi_hesab-$gelir->idere_edv)/1.18+$gelir->idere_edv),2)),2), 2, ',', ' ')}}</td>
                                        <td>{{number_format($esas_umumi=round((($gelir->cemi_hesab-$gelir->idere_edv)/1.18+$gelir->idere_edv),2), 2, ',', ' ')}}</td>
                                        <td>{{number_format($gelir->cemi_hesab, 2, ',', ' ')}}</td>

                                    </tr>
                                @endforeach
                                </tbody>

{{--senedlesme--}}
                                <tr>
<td></td>
                                </tr>

                                <tbody>
                                @foreach($senedlesme as $sened)
                                    <tr class="text-left">

                                        <td >{{$sened->xidmetin_novu}}</td>

{{--                                        <td>{{$sened->menzil_say}}</td>
                                        <td>{{round(($sened->menzil_summa-round(($sened->menzil_summa/1.18),2)),2)}}</td>
                                        <td>{{round(($sened->menzil_summa/1.18),2)}}</td>
                                        <td>{{round(($sened->menzil_summa),2)}}</td>

                                        <td>{{$sened->idere_say}}</td>
                                        <td>{{$qurum_edv=(round(($sened->idere_summa),2) -round((($sened->idere_summa-$sened->idere_edv)/1.18+$sened->idere_edv),2) )  }}</td>
                                        <td>{{$esas_qurum_mebleg=round((($sened->idere_summa-$sened->idere_edv)/1.18+$sened->idere_edv),2)}}</td>
                                        <td>{{round(($sened->idere_summa),2)}}</td>--}}

                                        <td>{{$sened->cemi_say}}</td>
                                        <td>{{$cemi_edv=round(($sened->cemi_hesab-round((($sened->cemi_hesab-$sened->idere_edv)/1.18+$sened->idere_edv),2)),2)}}</td>

                                        {{--          <td>{{$cemi_edv=round(($sened->cemi_hesab-),2)}}</td>--}}
                                        <td>{{$cemi_esas=( round((($sened->cemi_hesab-$sened->idere_edv)/1.18+$sened->idere_edv),2)) }}</td>
                                        <td>{{$cemi_mebleg=round(($sened->cemi_hesab),2)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

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
    <script type='text/Javascript'>
        $(function() {
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
