@extends('layouts.animal_detail')

@section('title')
QRCode
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12">
            <div class="card" style="margin-top: 30px;">
                <div class="card-header">
                    <div class="text-center">QRCode</b></div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        {!! QrCode::size(250)->generate($link); !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection