@extends('back.layouts.master')
@section('title','Kateqoriya deyis')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kateqoriya</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
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
          <h3 class="card-title">@yield('title')</h3>

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
                          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Mhm Logindən şöbənin dəyişmək</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
{{--             @if(Session::has('message'))--}}
{{--             <div class="alet alert-success">{{Session::get('message')}}</div>--}}
{{--             @endif--}}
              <form  method="POST" action="{{route('category.update',$data->id)}}">
                  @method('PUT')
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> </label>
                    <input type="text" class="form-control" name="sobe" id="exampleInputEmail1" value="{{$data->sobe}}" {{old('sobe')}} required>
                      @error('sobe') <p class="text-danger">{{$message}}</p> @enderror
                  </div>

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Dəyiş</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
         </div>

{{--    Sag            teref        --}}


                          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                 <form method="post" action="{{route('CdeleteAll')}}">
		{{ csrf_field() }}
        		<input class="btn btn-light float-right" type="submit" name="submit" value="Seçilənləri sil"/>
                <h3 class="card-title">Mhm Logindən istifadə edən şöbələr</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
        <th scope="col"> <input type="checkbox" id="checkAll"> Hamısını Seç</th>
      <th scope="col">Şöbənin adı</th>
      <th scope="col">İşləmlər</th>
    </tr>
  </thead>
  <tbody>
  @foreach($category as $MhmCat)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td ><input name='id[]' type="checkbox" id="checkItem"  value="{{$MhmCat->id}}">
      <td>{{$MhmCat->sobe}}</td>
              <td>
          <a href="{{route('category.index')}}" class="btn btn-outline-success btn-sm" ><i class="fas fa-plus"></i></a>
          <a href="{{route('category.edit',$MhmCat->id)}}" class="btn btn-outline-primary btn-sm" ><i class="fas fa-edit"></i></a>
          <a href="{{route('cat.del',$MhmCat->id)}}" class="btn btn-outline-danger btn-sm"><i class="fas fa-times "></i> </a>
      </td>
    </tr>
  @endforeach

  </tbody>
</table>
              {{$category->links('pagination::bootstrap-4')}}
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
    @section('select_all')
{{--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
        		<script language="javascript">
			$("#checkAll").click(function () {
				$('input:checkbox').not(this).prop('checked', this.checked);
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

