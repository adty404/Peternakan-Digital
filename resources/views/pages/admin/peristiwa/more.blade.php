@extends('layouts.admin')

@section('title')
    Detail
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail - Peristiwa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Peristiwa</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Peristiwa {{ $peristiwa->animal->name }} - {{ $peristiwa->peristiwa }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td width="45%">Tanggal</td>
                                        <td width="10%">:</td>
                                        <td>{{ \Carbon\Carbon::parse($peristiwa->tanggal)->format('d M Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu</td>
                                        <td>:</td>
                                        <td>{{ $peristiwa->waktu }}</td>
                                    </tr>
                                    <tr>
                                        <td>Ternak</td>
                                        <td>:</td>
                                        <td>{{ $peristiwa->animal->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Peristiwa</td>
                                        <td>:</td>
                                        <td><b>{{ $peristiwa->peristiwa }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{ $peristiwa->keterangan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Foto</td>
                                        <td>:</td>
                                        <td><a href="{{ $peristiwa->foto }}" data-toggle="lightbox"
                                            data-title="Foto - {{ $peristiwa->animal->name }}" data-gallery="gallery" style="color:black;">
                                            <i class="fas fa-images">
                                        </a></td>
                                    </tr>
                                    <tr>
                                        <td>Pencatat</td>
                                        <td>:</td>
                                        <td>{{ $peristiwa->ub->name }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer" style="float: right;">
                                <button onclick="goBack()" type="button" class="btn btn-success">Back</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@push('addon-script')
<script>
    function goBack() {
      window.history.back();
    }
</script>

<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script src="{{ asset('plugins/filterizr/jquery.filterizr.min.js') }}"></script>

<script>
    $(function () {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
  
      $('.filter-container').filterizr({gutterPixels: 3});
      $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
      });
    })
  </script>
@endpush