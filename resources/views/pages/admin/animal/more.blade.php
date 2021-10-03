@extends('layouts.admin')

@section('title')
    Detail
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail - {{ $animal->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ternak</a></li>
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
                            <h3 class="card-title">Detail - {{ $animal->name }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td width="55%">Berat</td>
                                        <td width="20%">:</td>
                                        <td>{{ $animal->weight }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tinggi</td>
                                        <td>:</td>
                                        <td>{{ $animal->height }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kondisi</td>
                                        <td>:</td>
                                        <td>{{ $animal->condition }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{ $animal->note }}</td>
                                    </tr>
                                    <tr>
                                        <td>Created By</td>
                                        <td>:</td>
                                        <td>{{ $animal->cb->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Updated By</td>
                                        <td>:</td>
                                        <td>{{ $animal->ub->name }}</td>
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
@endpush