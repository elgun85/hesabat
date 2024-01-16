@extends('back.layouts.master')
@section('title','Mühasibatliq üçün hesabat')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('title')</h1>
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
                <div class="card-header" >
                    <div class="card-title">

                    </div>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus "></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times "></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">

<div class="row">
    <div class="mr-5">
        <a href="{{route('data_montly_analiz')}}" target="_blank" type="button" class="btn btn-outline-primary">Data montly analiz</a>
    </div>
    <div class="mr-5">
        <a href="{{route('data_montly_ourserv')}}" target="_blank"  type="button" class="btn btn-outline-primary">Data montly</a>
    </div>
    <div class="mr-5">
        <a href="{{route('data_cat_ourserv')}}" target="_blank"  type="button" class="btn btn-outline-primary">Data montly (fiziki+ huquqi )</a>
    </div>
    <div class="mr-5">
        <a href="{{route('data_naz_ourserv')}}"  target="_blank" type="button" class="btn btn-outline-primary">Data nazirlik</a>
    </div>
    <div class="mr-5">
        <a href="{{route('edv_sened_ourserv')}}" target="_blank" type="button" class="btn btn-outline-primary">Ədv-siz sənədləşmələr</a>
    </div>
    <div class="mr-5">
        <a href="{{route('edv_siyahi_ourserv')}}"  target="_blank" type="button" class="btn btn-outline-primary">Ədv-siz siyahi</a>
    </div>
{{--

    <div class="mr-5">
        <a href="" type="button" class="btn btn-outline-primary"></a>
    </div>

--}}


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








@endsection
