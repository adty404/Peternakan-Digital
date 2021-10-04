@extends('layouts.animal_detail')

@section('title')
Detail Peternakan | {{ $farm->name }}
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12">
            <div class="card" style="margin-top: 30px;">
                <div class="card-header">
                    <div class="text-center">Detail Peternakan : <b>{{ $farm->name }}</b></div>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td width="45%">Nama</td>
                            <td width="10%">:</td>
                            <td>{{ $farm->name }}</td>
                        </tr>
                        <tr>
                            <td>Perusahaan</td>
                            <td>:</td>
                            <td>{{ $farm->office->name }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $farm->address }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
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

                    <hr>
                    <h5 style="text-align: center; margin-bottom:25px;">Gallery : <b>{{ $farm->name }}</b></h5>
                    <hr>
                    <div class="row">
                        @forelse ($gallery as $g)
                        <div class="col-sm-4">
                            <a href="{{ $g->picture }}" data-toggle="lightbox"
                                data-title="Gallery - {{ $g->farm->name }}" data-gallery="gallery">
                                <img src="{{ $g->picture }}" class="img-fluid mb-2"
                                    alt="gallery-{{ $g->farm->name }}" style="width: 162px; height: 162px;" />
                            </a>
                        </div>
                        @empty
                        <h3>Data Gallery masih kosong</h3>
                        @endforelse
                        {{ $gallery->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
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
@endpush