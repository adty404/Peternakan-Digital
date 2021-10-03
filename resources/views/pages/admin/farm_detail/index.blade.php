@extends('layouts.animal_detail')

@section('title')
Detail Peternakan | {{ $farm->name }}
@endsection

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
                </div>
            </div>
        </div>
    </div>
</div>


@endsection