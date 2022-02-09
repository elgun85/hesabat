@extends('back.layouts.master')
@section('title','Vəzifə elave et')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vəzifə</h1>
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
          <h3 class="card-title"></h3>

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
                <h3 class="card-title">İstifadəçilər üçün yeni vəzifə əlavə et</h3>
              </div>

              <form  method="POST" action="{{route('mvezife.store')}}">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1"> </label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Vəzifənin adı" {{old('name')}} required>
                      @error('name') <p class="text-danger">{{$message}}</p> @enderror
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


                          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Vəzifələrin siyahısı</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Vəzifə</th>
      <th scope="col">İşləmlər</th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $vezife)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$vezife->name}}</td>
      <td>
          <a href="{{route('mvezife.edit',$vezife->id)}}" class="btn btn-outline-primary btn-sm" ><i class="fas fa-edit"></i></a>
          <a href="{{route('mvezife.delete',$vezife->id)}}" class="btn btn-outline-danger btn-sm"><i class="fas fa-times "></i> </a>
      </td>
    </tr>
  @endforeach

  </tbody>
</table>
              {{$data->links('pagination::bootstrap-4')}}
            </div>
            <!-- /.card -->
          </div>
        </div>
{{--        <!-- /.card-body -->--}}
{{--        <div class="card-footer">--}}
{{--          Footer--}}
{{--        </div>--}}
{{--        <!-- /.card-footer-->--}}
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>


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

