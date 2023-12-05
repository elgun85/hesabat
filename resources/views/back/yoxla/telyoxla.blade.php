@extends('back.layouts.master')
@section('title','Əsas və əlavə xidmətlərin yoxlanılması')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Əsas və əlavə xidmətlərin yoxlanılması</h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <h3 class="card-title float-right text-danger">{{Session('message')}}  </h3>

                {{--              <li class="breadcrumb-item active"><a href="{{route('telyoxla')}}"><i class="fas fa-angle-double-left"></i></a></li>--}}

{{--              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Ana Səhifə</a></li>--}}
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
          <h3 class="card-title">Əsas və əlavə xidmətlərin axtarışı   </h3>

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
{{--Adsl ucun--}}

<div class="col-sm-5">
                  <form  method="GET" action="{{route('telyoxla')}}">
                  @csrf
                      <div class="form-group">
                    <label for="exampleInputEmail1"> </label>
                    <select class="form-control" name="category" aria-label="Default select example" >
                     <option value="" selected>Texnologiya seçin  </option>
                     <option @if (request()->get('category')=='Adsl') selected  @endif value="Adsl">Adsl</option>
                     <option @if (request()->get('category')=='Gpon') selected  @endif value="Gpon">Gpon</option>
                     <option @if (request()->get('category')=='Gpon Kampaniya') selected  @endif value="Gpon Kampaniya">Gpon Kampaniya</option>
                     <option @if (request()->get('category')=='Ip Tv') selected  @endif value="Ip Tv">Ip Tv</option>
                    </select>
                  </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Kateqoriya seçin {{old('novu')}} </label>
                    <select class="form-control" name="novu" aria-label="Default select example" >
                    <option  value="" selected>Sec</option>
                    <option  @if(request()->get('novu')=='Hamısı') selected @endif value="Hamısı" >Hamısı</option>
                     <option @if(request()->get('novu')=='Mənzil') selected @endif value="Mənzil">Əhali</option>
                     <option @if(request()->get('novu')=='Qeyri Əhali') selected @endif value="Qeyri Əhali">Qeyri Əhali</option>
                    </select>
                      @error('novu') <p class="text-danger">{{$message}}</p> @enderror
                  </div>




                        @if(request()->get('category')||request()->get('novu'))
                            <a href="{{route('telyoxla')}}" class="btn btn-outline-secondary"><i class="fas fa-sync-alt"></i></a>
                        @endif

<button type="submit" class="btn btn-primary float-right">Gonder</button>
                  </form>


</div>



{{--<div class="col-sm-1"> </div>--}}


{{--***************************************************************************************************************************************--}}

<div class="col-sm-7">
    <div class="card">

     <form  method="GET" action="{{route('telyoxlaS')}}">
                  @csrf

{{--                        @if(request()->get('diger')||request()->get('elave')||request()->get('esas')--}}
{{--                           ||request()->get('abonent') ||request()->get('abonent2')||request()->get('internet[]'))--}}
{{--                            <a href="{{route('telyoxla')}}" class="btn btn-outline-secondary">Sıfırla</a>--}}
{{--                        @endif--}}
<div class="card-header">
    <a href="{{route('telyoxla')}}" class="btn btn-outline-secondary float-left"><i class="fas fa-sync-alt"></i></a>

   <button type="submit" class="btn btn-primary float-right"> Axtar</button>

</div>
<div class="card-body">
    <div class="form-group">
        <label for="exampleInputEmail1" class=""></label>
        <input type="text" name="telefonlarim" class="form-control" placeholder="Telefon nomresi">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1" class=""></label>
        <input type="text" name="diger" class="form-control" placeholder="Əsas xidmət axtarışı üçün kod yazin">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1" class=""></label>
        <input type="text" name="elave" class="form-control" placeholder="Əlavə xidmət axtarışı üçün tarif kodu yazin">
    </div>
                      <div class="form-group">
                    <label for="exampleInputEmail1"> </label>
                    <select class="form-control" name="esas" aria-label="Default select example" >
                     <option   value="" selected>Əsas xidmət seçin  </option>
                     <option   value="1">Əsas telefon (1) </option>
                     <option   value="707">Gpon (707) </option>
                     <option   value="721">Gpon (özgə Ats) </option>
                     <option   value="708">Gpon kompaniya(708) </option>
                     <option   value="723">Gpon (taksafon) </option>
{{--                     <option   value="[707,708,721,723]">Gpon(hamisi) </option>--}}
                    </select>
                  </div>



                                            <div class="form-group">
                    <label for="exampleInputEmail1">Abonent {{old('abonent')}} </label>
                    <select class="form-control" name="abonent" aria-label="Default select example" >
                     <option  value="" selected >Seçin</option>
                     <option  value="1">1 </option>
                     <option  value="2">2 </option>
                     <option  value="8">8 </option>
                    </select>
                      @error('abonent') <p class="text-danger">{{$message}}</p> @enderror
                  </div>

                                            <div class="form-group">
                    <label for="exampleInputEmail1">Abonent2 {{old('abonent2')}} </label>
                    <select class="form-control" name="abonent2" aria-label="Default select example" >
                     <option value="" selected >Seçin</option>
                      <option  value="0">0 </option>
                      <option  value="2">2 </option>
                    </select>
                      @error('abonent2') <p class="text-danger">{{$message}}</p> @enderror
                  </div>


                                  <div class="card-header">
                <h3 class="card-title">{{$category}}</h3>

              </div>


<table class="table table-hover ">
  <thead>
  </thead>
  <tbody>

<tr>
    <th scope="col"> <input type="checkbox" id="checkAll">  Seç</th>
     <th>kod</th>
     <th>Ad</th>
     <th>Məbləğ (Ə)</th>
     <th>Məbləğ (K)</th>
    <th>Status</th>
</tr>

  @foreach($data as $internet)


 <tr>
    <td>
        <input name='internet[]' type="checkbox" id="checkItem"  value="{{$internet->kod}}">
        {{$internet->kod}}
    </td>

     <td>{{$internet->name}} </td>
     <td>{{$internet->mebleg}} </td>
     <td>{{$internet->mebleg}} </td>
     <td>{{$internet->mebleg_q}} </td>
     <td> {{$internet->novu}}</td>
</tr>

  @endforeach

  </tbody>

</table>


</div>
<div class="card-footer">
                            @if(request()->get('category')||request()->get('abonent')||request()->get('abonent2')||request()->get('kod'))
                            <a href="{{route('analiz')}}" class="btn btn-outline-secondary">Sıfırla</a>
                        @endif

<button type="submit" class="btn btn-primary float-right">Gonder</button>
</div>
                  </form>
</div>
</div>



                </div>
            </div>
            <br>




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
