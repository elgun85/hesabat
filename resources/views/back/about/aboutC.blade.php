@extends('back.layouts.master')
@section('title','Create new about')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>About</h1>
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
                        <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Create new about</h3>
                                </div>

                                <form  method="POST" action="{{route('about.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> </label>
                                            <img class="rounded float-start " id="preview-image-before-upload" src=""width="100px"> <br>
                                            <br>
                                            <br>
                                            <input type="file" id="image" class="form-control-file" name="image" wire:model="image">
                                            @error('image') <p class="text-danger">{{$message}}</p> @enderror
                                        </div>


                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{old('name')}}"  required>
                                            @error('name') <p class="text-danger">{{$message}}</p> @enderror
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{old('mail')}}"  name="mail" id="exampleInputEmail1">
                                            @error('mail') <p class="text-danger">{{$message}}</p> @enderror
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{old('phone')}} "  name="phone" id="exampleInputEmail1">
                                            @error('phone') <p class="text-danger">{{$message}}</p> @enderror
                                        </div>

@foreach($skills as $pese)
                                        <div class="form-check ">
                                            <input class="form-check-input" name="skills[]" type="checkbox" value="{{$pese->name}}" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{$pese->name}}
                                            </label>
                                            @error('skills') <p class="text-danger">{{$message}}</p> @enderror
                                        </div>

                                        @endforeach



 <div class="card-body">
              <textarea id="summernote" name="about" >
{{old('about')}}
              </textarea>
   </div>




                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                    {{--    Sag            teref        --}}


                    <div class="col-md-7">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">about  lists</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Skills</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">About</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $about)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td><img src="{{asset($about->image)}}" alt="" width="40" height="40"></td>
                                        <td>{{Str::limit($about->name,8)}}</td>
                                        <td>{{Str::limit($about->skills,8)}}</td>
                                        <td>{{Str::limit($about->phone,8)}}</td>
                                        <td>{{Str::limit($about->mail,8)}}</td>
                                        <td>{{Str::limit($about->about,8)}}</td>
                                        <td>
                                            <a href="{{route('about.edit',$about->id)}}" class="btn btn-outline-primary btn-sm" ><i class="fas fa-edit"></i></a>
                                            <a href="{{route('about.delete',$about->id)}}" class="btn btn-outline-danger btn-sm"><i class="fas fa-times "></i> </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
{{--                            {{$data->links('pagination::bootstrap-4')}}--}}
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
@section('summernote_css')
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="{{asset('back/')}}/plugins/simplemde/simplemde.min.css">


@endsection


@section('summernote_js')
    <script src="{{asset('back/')}}/plugins/summernote/summernote-bs4.min.js"></script>


    <script>
        $(function () {
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
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

    <script
        type="text/javascript">
        $(document).ready(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

        });

    </script>

@endsection
@endsection

