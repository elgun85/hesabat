@extends('back.layouts.master')
@section('title','Tarif elave et')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tarifler</h1>
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
                        <div class="col-md-4">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Yeni tarif əlavə et</h3>
                                </div>

                                <form method="POST" action="{{route('tarif.store')}}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> </label>
                                            <input type="text" class="form-control" name="kod" id="exampleInputEmail1"
                                                   placeholder="Kod" {{old('kod')}} required>
                                            @error('kod') <p class="text-danger">{{$message}}</p> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> </label>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                                                   placeholder="Tarifin  adı" {{old('name')}}  autofocus required>
                                            @error('name') <p class="text-danger">{{$message}}</p> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> </label>
                                            <input type="text" class="form-control" name="mebleg"
                                                   id="exampleInputEmail1" placeholder="Əhali üçün məbləğ"
                                                   {{old('mebleg')}} autofocus required>
                                            @error('mebleg') <p class="text-danger">{{$message}}</p> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> </label>
                                            <input type="text" class="form-control" name="mebleg_q"
                                                   id="exampleInputEmail1" placeholder="Qeyri Əhali üçün məbləğ"
                                                   {{old('mebleg_q')}} autofocus required>
                                            @error('mebleg_q') <p class="text-danger">{{$message}}</p> @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> </label>
                                            {{--                    <input type="text" class="form-control"  id="exampleInputEmail1" placeholder="Kategoriya yazin" {{old('category')}} required>--}}
                                            <select class="form-control" name="category"
                                                    aria-label="Default select example">
                                                <option selected>Texnologiya seçin{{old('category')}} </option>
                                                <option value="Adsl">Adsl</option>
                                                <option value="Gpon">Gpon</option>
                                                <option value="Gpon Kampaniya">Gpon Kampaniya</option>
                                                <option value="Ip Tv">Ip Tv</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> </label>
                                            <select class="form-control" name="novu"
                                                    aria-label="Default select example">
                                                <option selected>Kateqoriya seçin {{old('novu')}} </option>
                                                <option value="Hamısı">Hamısı</option>
                                                <option value="Mənzil">Əhali</option>
                                                <option value="Qeyri Əhali">Qeyri Əhali</option>

                                            </select>
                                            @error('novu') <p class="text-danger">{{$message}}</p> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> </label>
                                            <input type="text" class="form-control" name="qeyd1" id="exampleInputEmail1"
                                                   placeholder="Qeyd" {{old('qeyd1')}} >
                                            @error('qeyd1') <p class="text-danger">{{$message}}</p> @enderror
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


                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <form method="post" action="{{route('TarifdeleteAll')}}">
                                    {{ csrf_field() }}
                                    <input class="btn btn-light float-right" type="submit" name="submit"
                                           value="Seçilənləri sil"/>
                                    <h3 class="card-title">Tariflər</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->


                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"><input type="checkbox" id="checkAll"></th>
                                    <th scope="col">Kod</th>
                                    <th scope="col">Ad</th>
                                    <th scope="col">Məbləğ(M)</th>
                                    <th scope="col">Məbləğ(K)</th>
                                    <th scope="col">Kateqoriya</th>
                                    <th scope="col">Növü</th>
                                    <th scope="col">Qeyd</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $tarif)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td><input name='id[]' type="checkbox" id="checkItem" value="{{$tarif->id}}">
                                        <td>{{$tarif->kod}}</td>
                                        <td>{{$tarif->name}}</td>
                                        <td>{{$tarif->mebleg}}</td>
                                        <td>{{$tarif->mebleg_q}}</td>
                                        <td>{{$tarif->category}}</td>
                                        <td>{{$tarif->novu}}</td>
                                        <td>{{$tarif->qeyd1}}</td>
                                        <td>
                                            <a href="{{route('tarif.edit',$tarif->id)}}"
                                               class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('tarif.del',$tarif->id)}}"
                                               class="btn btn-outline-danger btn-sm"><i class="fas fa-times "></i> </a>
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
                "closeButton": true,
                "progressBar": true
            }
        toastr.success("{{ session('message') }}");
        @endif

            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true
            }
        toastr.error("{{ session('error') }}");
        @endif

            @if(Session::has('info'))
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true
            }
        toastr.info("{{ session('info') }}");
        @endif

            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton": true,
                "progressBar": true
            }
        toastr.warning("{{ session('warning') }}");
        @endif
    </script>


@endsection

@endsection

