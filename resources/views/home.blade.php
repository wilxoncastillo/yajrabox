@extends('layouts.app')

@section('content')
<div class="container">
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
                        <a class="toggle-vis btn btn-sm btn-primary" data-column="0">Id</a> -
                        <a class="toggle-vis btn btn-sm btn-primary" data-column="1">Nombre</a> -
                        <a class="toggle-vis btn btn-sm btn-primary" data-column="2">Intro</a> -
                        <a class="toggle-vis btn btn-sm btn-primary" data-column="3">Email</a> -
                        <a class="toggle-vis btn btn-sm btn-primary" data-column="4">Created_At</a> -
                        <a class="toggle-vis btn btn-sm btn-primary" data-column="5">Update_At</a>
                    </div><hr>

                    <table class="table" id='myTable'>
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Intro</th>
                          <th>Email</th>
                          <th>Created_At</th>
                          <th>Updated_At</th>

                        </tr>
                      </thead>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready( function () {
            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('get.users') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'intro', name: 'intro' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' }
                ]
            });

            $('a.toggle-vis').on( 'click', function (e) {
                e.preventDefault();

                //console.log($(this).attr('data-column'));

                // Get the column API object
                var column = table.column( $(this).attr('data-column') );

                // Toggle the visibility
                column.visible( ! column.visible() );
            } );
        });
    </script>
@endpush
