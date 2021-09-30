@extends('layouts.admin')

@section('title')
Perusahaan
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active">Perusahaan Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ $office->logo }}"
                                    alt="Logo Perusahaan">
                            </div>

                            <h3 class="profile-username text-center">{{ $office->name }}</h3>

                            <p class="text-muted text-center"> Perusahaan </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tentang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                            <p class="text-muted">{{ $office->address }}</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Kontak</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">Email : {{ $office->email }}</span> <br>
                                <span class="tag tag-danger">Nomor Hp : {{ $office->phone }}</span> <br>
                                <span class="tag tag-danger">Pic : {{ $office->pic }}</span>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="active nav-link" href="#profile"
                                        data-toggle="tab">Profile</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="profile">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <form method="POST" action="{{ route('office.update', $office) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Name" value="{{ $office->name ?? old('name') }}"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="logo">Logo</label>
                                                <input type="file" name="logo" class="form-control" id="logo"
                                                    value="{{ $office->logo ?? old('logo') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Alamat</label>
                                                <textarea name="address" id="address" rows="3" class="form-control"
                                                    placeholder="Address">{{ $office->address ?? old('address') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Email" value="{{ $office->email ?? old('email') }}"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Nomor HP</label>
                                                <input type="number" name="phone" class="form-control" id="phone"
                                                    placeholder="Phone" value="{{ $office->phone ?? old('phone') }}"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="pic">Pic</label>
                                                <input type="text" name="pic" class="form-control" id="pic"
                                                    placeholder="Pic" value="{{ $office->pic ?? old('pic') }}" required>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-warning">Kirim</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection