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
              <li class="breadcrumb-item"><a href="#">Ana səhifə</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
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
<table class="table table-bordered table-hover">
    <thead>
    <tr>
       <th>Kod</th>
       <th>Tarif adı</th>
       <th>Say(M)</th>
       <th>Hesablama(M)</th>
        <th>Say(M/Q)</th>
       <th>Hesablama(M/Q)</th>
       <th>Say(Q)</th>
       <th>Hesablama(Q)</th>
       <th>Cəmi(Say)</th>
       <th>Cəmi(Hesablama)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $xidmet)
    <tr>
        <td>{{$xidmet->kod}}</td>
        <td>{{$xidmet->name}}</td>
        <td>{{$xidmet->menzil_say}}</td>
        <td>{{$xidmet->menzil_sum}}</td>
        <td>{{$xidmet->qurum_say}}</td>
        <td>{{$xidmet->qurum_sum}}</td>
        <td>{{$xidmet->idare_say}}</td>
        <td>{{$xidmet->idare_sum}}</td>
        <td>{{$xidmet->cemi_say}}</td>
        <td>{{$xidmet->cemi_sum}}</td>


    </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>cəmi</th>
            <th></th>
            <th>{{$cemi[0]}}</th>
            <th>{{$cemi[1]}}</th>
            <th>{{$cemi[2]}}</th>
            <th>{{$cemi[3]}}</th>
            <th>{{$cemi[4]}}</th>
            <th>{{$cemi[5]}}</th>
            <th>{{$cemi[6]}}</th>
            <th>{{$cemi[7]}}</th>



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

        @section('select_all')
        		<script language="javascript">
			$("#checkAll").click(function () {
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
		</script>

    @endsection



@section('dtable_css')

      <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

   @section('dtable_js')
<!-- DataTables  & Plugins -->
<script src="{{asset('back/')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('back/')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('back/')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('back/')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('back/')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


       <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
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
