@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <span class="font-weight-bold">Alternar Columnas:</span>
                        <a class="toggle-vis btn btn-sm btn-primary" data-column="1">Id</a> -
                        <a class="toggle-vis btn btn-sm btn-primary" data-column="2">Nombre</a> -
                        <a class="toggle-vis btn btn-sm btn-primary" data-column="3">Email</a> -
                        <a class="toggle-vis btn btn-sm btn-primary" data-column="4">Created_At</a> -
                        <a class="toggle-vis btn btn-sm btn-primary" data-column="5">Update_At</a>
                    </div><hr>

                    {{ $dataTable->table([], true) }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}

    <script type="text/javascript">
        $(document).ready( function () {
            var table = $('#user-table').DataTable();

            var column = table.column(4);
            column.visible( ! column.visible() );

            var column = table.column(5);
            column.visible( ! column.visible() );


            $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();

                // Get the column API object
                var column = table.column( $(this).attr('data-column') );

                // Toggle the visibility
                column.visible( ! column.visible() );
            } );
        });
    </script>
@endpush
