@extends('back.layouts.master')
@section('title','Tariflərin statistikası')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tariflərin statistikası</h1>
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
          <h3 class="card-title">Title</h3>

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



    <table id="maintable" class="display compact cell-border" cellspacing="0" width="100%" >
    <thead>
    <tr>
       <th style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:1px; ">Kod</th>
       <th style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:180px;">Tarif adı</th>
       <th >Say(M)</th>
       <th >Hes(M)</th>
        <th >Say(M/Q)</th>
       <th >Hes(M/Q)</th>
       <th >Say(Q)</th>
       <th >Hes(Q)</th>
       <th  >Cəmi(Say)</th>
       <th>Cəmi(Hes)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $xidmet)
    <tr>
        <td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:10px;">{{$xidmet->kod}}</td>
        <td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:180px;">{{$xidmet->name}}</td>
        <td >{{$xidmet->menzil_say}}</td>
        <td >{{$xidmet->menzil_sum}}</td>
        <td >{{$xidmet->qurum_say}}</td>
        <td >{{$xidmet->qurum_sum}}</td>
        <td >{{$xidmet->idare_say}}</td>
        <td >{{$xidmet->idare_sum}}</td>
        <td  >{{$xidmet->cemi_say}}</td>
        <td>{{$xidmet->cemi_sum}}</td>


    </tr>
    @endforeach
    </tbody>
    <tfoot style="background-color: #c0c0c0; color: #ffffff; font-size: 0.9em; ">
    <tr>
        <th style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:10px;"></th>
        <th style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:180px;"></th>
        <th ></th>
        <th ></th>
        <th ></th>
        <th ></th>
        <th ></th>
        <th ></th>
        <th  ></th>
        <th></th>

    </tr>
    </tfoot>
</table>





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

    @section('scc_data')

    <link rel="stylesheet" type="text/css" href="{{asset('back/datatables-master/')}}/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('back/datatables-master/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('back/datatables-master/')}}/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('back/datatables-master/')}}/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('back/datatables-master/')}}/css/style.css">

    @endsection

@section('js_data')

<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/jszip.min.js"></script>
<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/pdfmake.min.js"></script>
<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/vfs_fonts.js"></script>
<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/buttons.print.min.js"></script>
<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/app.js"></script>
<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/jquery.mark.min.js"></script>
<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/datatables.mark.js"></script>
<script type="text/javascript" src="{{asset('back/datatables-master/')}}/js/buttons.colVis.min.js"></script>

@endsection

    @endsection
