@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <th>{{ $item->id }}</th>
                            <td>{{ $item->name }}</td>
                        </tr>
                    @empty
                        <p class="text-center">Data not found!</p>
                    @endforelse


                </tbody>
            </table>
        </div>
    </div>
@endsection
