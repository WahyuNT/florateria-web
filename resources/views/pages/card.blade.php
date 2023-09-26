@extends('layouts.master')
@section('content')
    <div class="card">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">RFID</th>
                    <th scope="col">Plant</th>
                    <th scope="col">Player</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->rfid }}</td>
                        <td>{{ $item->plants->name }}</td>
                        @if ($item->id_player)
                            <td>{{ $item->id_player }}</td>
                        @else
                            <td><span class="badge bg-danger rounded-3 fw-semibold">Belum di redeem</span></td>
                        @endif
                    </tr>
                @empty
                    <p class="text-center">Data not found!</p>
                @endforelse


            </tbody>
        </table>
    </div>
@endsection
