@extends('layouts.admin')

@section('title')
Ubah Data Ternak
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
                    <h1 class="m-0">Ternak</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Ternak</a></li>
                        {{-- @if (auth()->office()->role == 'super-admin')
                <li class="breadcrumb-item active">Dashboard v1</li>
              @endif --}}
                        <li class="breadcrumb-item active">Ubah Data</li>
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
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Ubah Data</h3>
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
                        <form method="POST" action="{{ route('animal-data.update', $animal) }}" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select name="category_id" id="" class="form-control select2">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            @if ($category->id === $animal->category_id)
                                                selected
                                            @endif
                                            >
                                            {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Peternakan</label>
                                    <select name="farm_id" id="" class="form-control select2">
                                        @foreach ($farms as $farm)
                                        <option value="{{ $farm->id }}" 
                                            @if ($farm->id === $animal->farm_id)
                                                selected
                                            @endif
                                            >
                                            {{ $farm->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Name" value="{{ $animal->name ?? old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="weight">Berat</label>
                                    <input type="text" name="weight" class="form-control" id="weight"
                                        placeholder="Weight" value="{{ $animal->weight ?? old('weight') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="height">Tinggi</label>
                                    <input type="text" name="height" class="form-control" id="height"
                                        placeholder="Height" value="{{ $animal->height ?? old('height') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="condition">Kondisi</label>
                                    <input type="text" name="condition" class="form-control" id="condition"
                                        placeholder="Condition" value="{{ $animal->condition ?? old('condition') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="note">Keterangan</label>
                                    <input type="text" name="note" class="form-control" id="note"
                                        placeholder="Note" value="{{ $animal->note ?? old('note') }}" required>
                                </div>
                                {{-- <input type="hidden" name="created_by" value="{{ Auth::user()->id }}"> --}}
                                <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Kirim</button>
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