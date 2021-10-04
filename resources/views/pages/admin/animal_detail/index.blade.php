@extends('layouts.animal_detail')

@section('title')
Detail Ternak | {{ $animal->name }}
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
                    <div class="text-center">Detail Ternak : <b>{{ $animal->name }}</b></div>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td width="45%">Kategori</td>
                            <td width="10%">:</td>
                            <td>{{ $animal->category->name }}</td>
                        </tr>
                        <tr>
                            <td>Peternakan</td>
                            <td>:</td>
                            <td>{{ $animal->farm->name }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $animal->name }}</td>
                        </tr>
                        <tr>
                            <td>Berat</td>
                            <td>:</td>
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
                            <td><hr /></td>
                            <td></td>
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
                        <tr>
                            <td>Input Date</td>
                            <td>:</td>
                            <td>{{ $animal->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <td>Update Date</td>
                            <td>:</td>
                            <td>{{ $animal->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </table>

                    <hr>
                    <h5 style="text-align: center; margin-bottom:25px;">Foto : <b>{{ $animal->name }}</b></h5>
                    <hr>
                    <div class="row">
                        @forelse ($gallery as $g)
                        <div class="col-sm-4">
                            <a href="{{ $g->picture }}" data-toggle="lightbox"
                                data-title="Updated By: {{ $g->ub->name }} - {{ $g->updated_at->format('d M Y, H:i') }}" data-gallery="gallery">
                                <img src="{{ $g->picture }}" class="img-fluid mb-2"
                                    alt="gallery-{{ $g->animal->name }}" style="width: 162px; height: 162px;" />
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