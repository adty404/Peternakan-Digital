@extends('layouts.admin')

@section('title')
Ubah Data Peristiwa
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
                        <form method="POST" action="{{ route('peristiwa.update', $peristiwa) }}" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="Ternak">Ternak</label>
                                    <input type="text" name="Ternak" class="form-control" id="Ternak"
                                        placeholder="Name" value="{{ $peristiwa->animal->name ?? old('Ternak') }}" required readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="tanggal" value="{{ \Carbon\Carbon::parse($peristiwa->tanggal)->format('m-d-y') ?? old('tanggal') }}" class="form-control datetimepicker-input"
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
                                        <input type="text" name="waktu" value="{{ $peristiwa->waktu ?? old('waktu') }}" class="form-control datetimepicker-input"
                                            data-target="#timepicker" />
                                        <div class="input-group-append" data-target="#timepicker"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Peristiwa</label>
                                    <select name="peristiwa" id="" class="form-control select2">
                                        <option value="Lahir" @if($peristiwa->peristiwa == 'Lahir') selected @endif>Lahir</option>
                                        <option value="Datang" @if($peristiwa->peristiwa == 'Datang') selected @endif>Datang</option>
                                        <option value="Sehat" @if($peristiwa->peristiwa == 'Sehat') selected @endif>Sehat</option>
                                        <option value="Sakit" @if($peristiwa->peristiwa == 'Sakit') selected @endif>Sakit</option>
                                        <option value="Hilang" @if($peristiwa->peristiwa == 'Hilang') selected @endif>Hilang</option>
                                        <option value="Mati" @if($peristiwa->peristiwa == 'Mati') selected @endif>Mati</option>
                                        <option value="Dijual" @if($peristiwa->peristiwa == 'Dijual') selected @endif>Dijual</option>
                                        <option value="Pindah" @if($peristiwa->peristiwa == 'Pindah') selected @endif>Pindah</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" rows="3" class="form-control" placeholder="Keterangan">{{ $peristiwa->keterangan ?? old('keterangan') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" class="form-control" id="foto"
                                        value="{{ $peristiwa->foto ?? old('foto') }}">
                                </div>
                                <input type="hidden" name="animal_id" value="{{ $peristiwa->animal_id ?? old('animal_id') }}">
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