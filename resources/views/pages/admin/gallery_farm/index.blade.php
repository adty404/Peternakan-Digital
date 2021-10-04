@extends('layouts.admin')

@section('title')
Gallery Peternakan
@endsection


@push('addon-style')
    <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
    @include('sweetalert::alert')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gallery Peternakan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Gallery</a></li>
                        {{-- @if (auth()->office()->role == 'super-admin')
                <li class="breadcrumb-item active">Dashboard v1</li>
              @endif --}}
                        <li class="breadcrumb-item active">Peternakan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" style="line-height: 30px;">Peternakan - {{ $farm->name }}</h4>
                            <a href="{{ route('farm-gallery.create', ['gallery' => $farm->code]) }}">
                                <button type="button" class="btn btn-primary" style="float: right;">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data
                                </button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse ($gallery as $g)
                                <div class="col-sm-2">
                                    <a href="{{ $g->picture }}" data-toggle="lightbox"
                                        data-title="Gallery - {{ $g->farm->name }}" data-gallery="gallery">
                                        <img src="{{ $g->picture }}" class="img-fluid mb-2"
                                            alt="gallery-{{ $g->farm->name }}" style="width: 162px; height: 162px;" />
                                    </a>
                                    <button href="{{ route('farm-gallery.destroy', ['gallery' => $g->id]) }}"
                                        class="btn btn-danger btn-sm" id="delete" style="float: right;"><i
                                            class="fa fa-trash"></i> Hapus</button>
                                </div>
                                @empty
                                <h3>Data Gallery masih kosong</h3>
                                @endforelse
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    {{ $gallery->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post" id="deleteForm">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Hapus" style="display: none">
                    </form>
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->

                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->

                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@push('addon-script')
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $('button#delete').on('click', function(e){
        e.preventDefault();
        var href = $(this).attr('href');

        Swal.fire({
            title: 'Apakah kamu yakin hapus data ini?',
            text: "Data yang sudah dihapus tidak bisa dikembalikan!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!'
            }).then((result) => {
            if (result.value) {
                document.getElementById('deleteForm').action = href;
                document.getElementById('deleteForm').submit();

                Swal.fire(
                'Terhapus!',
                'Data kamu berhasil dihapus.',
                'success'
                )
            }
        })
    })
</script>
@endpush