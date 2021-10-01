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
                    <h1 class="m-0">Detail - {{ $farm->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Farm</a></li>
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
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-success card-outline">
                      <div class="card-body box-profile">
                        <div class="text-center">
                          <img class="profile-user-img img-circle" width="100" height="70"
                               src="{{ $farm->logo }}"
                               alt="Logo Peternakan">
                        </div>
        
                        <h3 class="profile-username text-center">{{ $farm->name }}</h3>
        
                        <p class="text-muted text-center"> Peternakan </p>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>



                <!-- left column -->
                <div class="col-md-9">
                    <!-- general form elements -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Detail - {{ $farm->name }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td width="45%">Email</td>
                                        <td width="10%">:</td>
                                        <td>{{ $farm->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor HP</td>
                                        <td>:</td>
                                        <td>{{ $farm->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>PIC</td>
                                        <td>:</td>
                                        <td>{{ $farm->pic }}</td>
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