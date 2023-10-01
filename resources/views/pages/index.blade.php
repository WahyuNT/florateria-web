@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-6 ">
            <div class="card h-100 w-100 border" style="border-radius: 1rem">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Player Data</h5>
                        </div>
                        <div>
                            <a href="{{ route('player-data') }}">
                                More...
                            </a>
                        </div>
                    </div>
                    <div class=" border shadow-none" style="border-radius: 1rem">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($player as $item)
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
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('plants-data') }}">


                            <button class="btn btn-primary mt-4">More</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 ">
            <div class="card h-100 w-100 border" style="border-radius: 1rem">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Plants Data</h5>
                        </div>
                        <div>
                            <a href="{{ route('plants-data') }}">
                                More...
                            </a>
                        </div>
                    </div>
                    <div class=" border shadow-none" style="border-radius: 1rem">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($plants as $item)
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
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('plants-data') }}">


                            <button class="btn btn-primary mt-4">More</button>
                        </a>
                    </div>
                </div>
            </div>


        </div>
        <div class="col  mt-3">
            <div class="card h-100 w-100 border" style="border-radius: 1rem">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Inventory Data</h5>
                        </div>
                        <a href="{{ route('card-data') }}">
                            More...
                        </a>
                    </div>
                    <div class=" border shadow-none" style="border-radius: 1rem">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Plant</th>
                                        <th scope="col">Custom Name</th>
                                        <th scope="col">RFID</th>
                                        <th scope="col">Player</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($inventory as $item)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $item->plants->name }}</td>
                                            <td>
                                                @if ($item->custom_name)
                                                    {{ $item->custom_name }}
                                                @else
                                                    <div style="color: red">
                                                        <i> Belum di redeem</i>
                                                    </div>
                                                @endif
                                            </td>


                                            <td>{{ $item->rfid }}</td>
                                            @if ($item->id_player)
                                                <td>{{ $item->player->name }}</td>
                                            @else
                                                <td><span class="badge bg-danger rounded-3 fw-semibold">Belum di
                                                        redeem</span></td>
                                            @endif
                                        </tr>
                                    @empty
                                        <p class="text-center">Data not found!</p>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <a href="{{ route('card-data') }}">


                            <button class="btn btn-primary">More</button>
                        </a>
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection
