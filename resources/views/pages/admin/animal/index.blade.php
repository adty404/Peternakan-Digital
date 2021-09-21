@extends('layouts.admin')

@section('title')
Animal
@endsection

@section('content')
<div class="content-wrapper">
    @include('sweetalert::alert')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Animal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Animal</a></li>
                        {{-- @if (auth()->user()->role == 'super-admin')
                <li class="breadcrumb-item active">Dashboard v1</li>
              @endif --}}
                        <li class="breadcrumb-item active">Index</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            @if (auth()->user()->role != 'operator')
                            <a href="{{ route('animal.create') }}">
                                <button type="button" class="btn btn-primary" style="float: right;">
                                    <i class="fa fa-plus"></i>
                                    Add Data
                                </button>
                            </a>
                            @endif
                            <h3 class="card-title">Animal Table</h3>
                        </div>
    
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="crudTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Farm</th>
                                        <th>Name</th>
                                        <th>Weight</th>
                                        <th>Height</th>
                                        <th>Condition</th>
                                        <th>Note</th>
                                        <th>Barcode</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                        <th>Updated At</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
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

@push('addon-style')
<!-- DataTables -->
<link rel="stylesheet" href="{{  asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{  asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{  asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('addon-script')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    // AJAX DataTable
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        scrollX: true,
        order:[[0,"DESC"]],
        columnDefs: [
                {
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11], // your case first column
                    "className": "text-center",
                },
            ],
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [{ 
                data: 'DT_RowIndex', 
                orderable: false, 
                searchable : false
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'farm',
                name: 'farm'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'weight',
                name: 'weight',
            },
            {
                data: 'height',
                name: 'height',
            },
            {
                data: 'condition',
                name: 'condition',
            },
            {
                data: 'note',
                name: 'note',
            },
            {
                data: 'barcode',
                name: 'barcode',
            },
            {
                data: 'created_by',
                name: 'created_by',
            },
            {
                data: 'updated_by',
                name: 'updated_by',
            },
            {
                data: 'updated_at',
                name: 'updated_at',
            },
            {
                data: 'aksi',
                name: 'aksi',
            },
        ]
    });
</script>
@endpush