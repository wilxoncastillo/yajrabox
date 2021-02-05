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
    <style>
        td.details-control {
        background: url('images/details_open.png') no-repeat center center;

        cursor: pointer;
        }
        tr.details td.details-control {
            background: url('images/details_close.png') no-repeat center center;
        }
    </style>

    {{ $dataTable->scripts() }}

    <script type="text/javascript">
        function format ( d ) {
            return 'Email: ' + d.created_at + '<br>' +
                'Intro: ' + d.updated_at +'<br>' +
                'The child row can contain any data you wish, including links, images, inner tables etc.';
        }

        $(document).ready( function () {
            var table = $('#user-table').DataTable();

            console.log(table);

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

            // Array to track the ids of the details displayed rows
            var detailRows = [];

            $('#user-table').on( 'click', 'tr button.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
                var idx = $.inArray( tr.attr('id'), detailRows );


                if ( row.child.isShown() ) {
                    tr.removeClass( 'details' );
                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice( idx, 1 );
                }
                else {
                    tr.addClass( 'details' );
                    row.child( format( row.data() ) ).show();

                    // Add to the 'open' array
                    if ( idx === -1 ) {
                        detailRows.push( tr.attr('id') );
                    }
                }
            } );

            // On each draw, loop over the `detailRows` array and show any child rows
            table.on( 'draw', function () {
                $.each( detailRows, function ( i, id ) {
                    $('#'+id+' table.details-control').trigger( 'click' );
                } );
            } );

        //------------------
        });


    </script>
@endpush
