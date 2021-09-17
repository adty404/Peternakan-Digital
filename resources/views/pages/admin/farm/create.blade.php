@extends('layouts.admin')

@section('title')
Add Farm Data
@endsection

@push('prepend-style')
<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Farm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Farm</a></li>
                        {{-- @if (auth()->office()->role == 'super-admin')
                <li class="breadcrumb-item active">Dashboard v1</li>
              @endif --}}
                        <li class="breadcrumb-item active">Add Data</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('farm.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Name" value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" rows="3" class="form-control" placeholder="Address">{{ old('address') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" name="phone" class="form-control" id="phone"
                                        placeholder="Phone" value="{{ old('phone') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="pic">Pic</label>
                                    <input type="text" name="pic" class="form-control" id="pic"
                                        placeholder="Pic" value="{{ old('pic') }}" required>
                                </div>
                                @if(auth()->user()->role == 'master')
                                <div class="form-group">
                                    <label for="">Office</label>
                                    <select name="office_id" id="" class="form-control select2">
                                        @foreach ($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                @if(auth()->user()->role == 'super-admin')
                                <input type="hidden" name="office_id" value="{{ Auth::user()->office->id }}">
                                @endif
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $('.select2').select2();
</script>
@endpush