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
                        Toggle column:
                        <a class="toggle-vis" data-column="0">id</a> -
                        <a class="toggle-vis" data-column="1">nombre</a> -
                        <a class="toggle-vis" data-column="2">intro</a> -
                        <a class="toggle-vis" data-column="3">email</a> -
                        <a class="toggle-vis" data-column="4">created_at</a> -
                        <a class="toggle-vis" data-column="5">update_at</a>

                    </div>

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

            /*
            var table = $('#myTable').DataTable( {
                "scrollY": "200px",
                "paging": false
            } );
            */

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
