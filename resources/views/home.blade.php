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

                    <table class="table" id='myTable'>
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Created_At</th>
                          <th>Updated_At</th>

                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($users as $item)
                        <tr>
                          <th scope="row">{{ $item->id }}</th>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->email }}</td>
                          <td>{{ $item->created_at }}</td>
                          <td>{{ $item->updated_at }}</td>
                        </tr>
                        @empty
                            <div class="alert-info">
                                No hay Datos
                            </div>
                        @endforelse
                      </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    -->

    <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>
@endpush
