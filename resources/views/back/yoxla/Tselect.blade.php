
@extends('back.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Ana Səhifə</a></li>
              <li class="breadcrumb-item active"><a href="{{route('analiz')}}">Analiz</a></li>
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
<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>









{{--                    <th>Seç</th>--}}
                    <th>Telefon</th>
                    <th>Ş/hesab</th>
                    <th>Əsas tarif</th>
                    <th>Kod</th>
                    <th>Internet</th>
                    <th>Abonent</th>
                    <th>Abonent2</th>

                  </tr>
                  </thead>
                  <tbody>

                  <tr>
@foreach($data_esas as $xidmet)
{{--                      <td ><input name='id[]' type="checkbox" id="checkItem"  value=""></td>--}}
                      <td>{{$xidmet->telefon}}</td>
                      <td>{{$xidmet->hesab}}</td>
                      <td>{{$xidmet->tarif}}</td>
                      <td>{{$xidmet->tarifs}}</td>
                      <td>
                          @foreach($tarifler as $tar)
                              @if($xidmet->tarifs == $tar->kod)
                                  {{$tar->name}}

                              @endif
                          @endforeach
                      </td>
                      <td>{{$xidmet->abonent}}</td>
                      <td>{{$xidmet->abonent2}}</td>


                  </tr>

                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>


{{--                    <th>Seç</th>--}}
                    <th>Telefon</th>
                    <th>Ş/hesab</th>
                    <th>Əsas tarif</th>
                    <th>Kod</th>
                    <th>Internet</th>
                    <th>Abonent</th>
                    <th>Abonent2</th>

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
{{--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
        		<script language="javascript">
			$("#checkAll").click(function () {
				$('input:checkbox').not(this).prop('checked', this.checked);
			});
		</script>

    @endsection



@section('dtable_css')
      <!-- DataTables -->
{{--  <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">--}}
{{--  <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">--}}
{{--  <link rel="stylesheet" href="{{asset('back/')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">--}}

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







