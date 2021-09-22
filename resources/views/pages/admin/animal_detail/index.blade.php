@extends('layouts.animal_detail')

@section('title')
Detail Animal | {{ $animal->name }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-xs-12">
            <div class="card" style="margin-top: 30px;">
                <div class="card-header">
                    <div class="text-center">Detail Animal : <b>{{ $animal->name }}</b></div>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td width="45%">Category</td>
                            <td width="10%">:</td>
                            <td>{{ $animal->category->name }}</td>
                        </tr>
                        <tr>
                            <td>Farm</td>
                            <td>:</td>
                            <td>{{ $animal->farm->name }}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{ $animal->name }}</td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td>:</td>
                            <td>{{ $animal->weight }}</td>
                        </tr>
                        <tr>
                            <td>Height</td>
                            <td>:</td>
                            <td>{{ $animal->height }}</td>
                        </tr>
                        <tr>
                            <td>Condition</td>
                            <td>:</td>
                            <td>{{ $animal->condition }}</td>
                        </tr>
                        <tr>
                            <td>Note</td>
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
                </div>
            </div>
        </div>
    </div>
</div>


@endsection