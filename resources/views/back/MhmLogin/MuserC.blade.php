@extends('back.layouts.master')
@section('title','İstifadəçilər')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>İstifadəçilər</h1>
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
{{--          <h3 class="card-title">Title</h3>--}}

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
         <div class="row ">
                          <div class="col-md-6 ">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Yeni istifadəçı əlavə et</h3>
              </div>

              <form  method="POST" action="{{route('muser.store')}}">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">İstifadəçi adı</label>
                    <input type="text" class="form-control" name="login" id="exampleInputEmail1" placeholder="İstifadəçi adı" {{old('login')}} required>
                      @error('login') <p class="text-danger">{{$message}}</p> @enderror
                  </div>

                 <div class="form-group">
                    <label for="exampleInputEmail1">Ad,soyad </label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Ad,soyad" {{old('name')}} required>
                      @error('name') <p class="text-danger">{{$message}}</p> @enderror
                  </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Şifrə </label>
                    <input type="text" class="form-control" name="password" id="exampleInputEmail1" placeholder="Şifrə" {{old('password')}} >
                      @error('password') <p class="text-danger">{{$message}}</p> @enderror
                  </div>

                <div class="form-group">
                  <label>Şöbə Seçin</label>
                  <select name="cat_id" class="form-control select2" style="width: 100%;"  onmousedown="if(this.options.length>5){this.size=5;}" onchange="this.blur()"  onblur="this.size=0;" >
                   <option value=""  selected ></option>
                      @foreach($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->sobe}}</option>
                      @endforeach
                  </select>
                     @error('cat_id') <p class="text-danger">{{$message}}</p> @enderror
                </div>

                <div class="form-group">
                  <label>Vəzifə Seçin</label>
                  <select name="vez_id" class="form-control select2" style="width: 100%;" onmousedown="if(this.options.length>5){this.size=5;}" onchange="this.blur()"  onblur="this.size=0;" >
                   <option value=""  selected ></option>
                      @foreach($vezifeler as $vezife)
                    <option value="{{$vezife->id}}">{{$vezife->name}}</option>
                      @endforeach
                  </select>
                     @error('vez_id') <p class="text-danger">{{$message}}</p> @enderror
                </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Qeyd</label>
                    <input type="text" class="form-control" name="qeyd" id="exampleInputEmail1" placeholder="Qeyd yazın" {{old('qeyd')}} >
                      @error('qeyd') <p class="text-danger">{{$message}}</p> @enderror
                  </div>

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Əlavə et</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
         </div>

{{--    Sag            teref        --}}


                          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                 <form method="post" action="{{route('UdeleteAll')}}">
		{{ csrf_field() }}
        		<input class="btn btn-light float-right" type="submit" name="submit" value="Seçilənləri sil"/>
                <h3 class="card-title">İstifadəçılərin siyahısı</h3>
              </div>


 <div class="card">
              <div class="card-header">
{{--                <h3 class="card-title">DataTable with default features</h3>--}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th ><input type="checkbox" id="checkAll">  </th>
                    <th>Login</th>
                    <th>Şifrə</th>
                    <th>Ad,soyad</th>
                    <th>Şöbə</th>
                    <th>Vəzifə</th>
                    <th>Qeyd</th>
                    <th>İşləm</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($mlogin as $login)
                  <tr>
    <td ><input name='id[]' type="checkbox" id="checkItem"  value="{{$login->id}}">
                    <td>{{$login->login}}</td>
                    <td>{{$login->password}}</td>
                    <td>{{$login->name}} </td>
                    <td>{{mb_convert_case ($login->category[0]->sobe,MB_CASE_TITLE,'UTF-8')}}</td>
                    <td> {{$login->vezife[0]->name}}</td>
{{--                      <td></td>--}}
                    <td>{{$login->qeyd}}</td>
                    <td>
          <a href="{{route('muser.edit',$login->id)}}" class="btn btn-outline-primary btn-sm" ><i class="fas fa-edit"></i></a>
          <a href="{{route('muser.delete',$login->id)}}" class="btn btn-outline-danger btn-sm"><i class="fas fa-times "></i> </a>
                    </td>

                  </tr>
                      @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th >  </th>

                    <th>Login</th>
                    <th>Şifrə</th>
                    <th>Ad,soyad</th>
                    <th>Şöbə</th>
                    <th>Vəzifəsi</th>
                    <th>Qeyd</th>
                    <th>İşləm</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>








            </div>
            <!-- /.card -->
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


<script>

</script>

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







    @section('toastr_css')
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection


 @section('toastr_js')
      <script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>


@endsection

    @endsection




