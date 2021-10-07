@extends('layouts.admin')

@section('title')
Tambah Data Peristiwa
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
                    <h1 class="m-0">Peristiwa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Peristiwa</a></li>
                        <li class="breadcrumb-item active">Tambah Data</li>
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
                            <h3 class="card-title">Tambah Data</h3>
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
                        <form method="POST" action="{{ route('peristiwa.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Ternak</label>
                                    <select name="animal_id" id="" class="form-control select2">
                                        @foreach ($animal as $a)
                                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="tanggal" class="form-control datetimepicker-input"
                                            data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Waktu</label>

                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input type="text" name="waktu" class="form-control datetimepicker-input"
                                            data-target="#timepicker" />
                                        <div class="input-group-append" data-target="#timepicker"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="peristiwa">Peristiwa</label>
                                    <select name="peristiwa" class="form-control select2" id="peristiwa">
                                        <option value="Lahir" {{(old('jurusan') == 'Lahir') ? ' selected' : ''}}>Lahir</option>
                                        <option value="Datang" {{(old('jurusan') == 'Datang') ? ' selected' : ''}}>Datang</option>
                                        <option value="Sehat" {{(old('jurusan') == 'Sehat') ? ' selected' : ''}}>Sehat</option>
                                        <option value="Sakit" {{(old('jurusan') == 'Sakit') ? ' selected' : ''}}>Sakit</option>
                                        <option value="Hilang" {{(old('jurusan') == 'Hilang') ? ' selected' : ''}}>Hilang</option>
                                        <option value="Mati" {{(old('jurusan') == 'Mati') ? ' selected' : ''}}>Mati</option>
                                        <option value="Dijual" {{(old('jurusan') == 'Dijual') ? ' selected' : ''}}>Dijual</option>
                                        <option value="Pindah" {{(old('jurusan') == 'Pindah') ? ' selected' : ''}}>Pindah</option>
                                    </select>
                                    @if($errors->has('kelas'))
                                        <span class="help-block">{{$errors->first('kelas')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Keterangan">{{ old('keterangan') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" class="form-control" id="name"
                                        placeholder="Foto" required>
                                </div>
                                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Kirim</button>
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

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>
    $('.select2').select2();
</script>

<script type="text/javascript">
    $(function () {  
      //Date picker
      $('#reservationdate').datetimepicker({
        format: 'MM/DD/YYYY',
        locale: 'en'
      });
  
      //Timepicker
      $('#timepicker').datetimepicker({
        use24hours: true,
        format: 'HH:mm',
      });
  
    })
    
  </script>
@endpush