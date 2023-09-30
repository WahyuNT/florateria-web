@extends('layouts.master')
@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambahkan Kartu
    </button>


    <div class="card mt-3">
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text">
                    <button id="scanButton">Scan</button>
                    <button id="writeButton">Write</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        scanButton.addEventListener("click", async () => {
            log("User clicked scan button");

            try {
                const ndef = new NDEFReader();
                await ndef.scan();
                log("> Scan started");

                ndef.addEventListener("readingerror", () => {
                    log("Argh! Cannot read data from the NFC tag. Try another one?");
                });

                ndef.addEventListener("reading", ({
                    message,
                    serialNumber
                }) => {
                    log(`> Serial Number: ${serialNumber}`);
                    log(`> Records: (${message.records.length})`);
                });
            } catch (error) {
                log("Argh! " + error);
            }
        });

        writeButton.addEventListener("click", async () => {
            log("User clicked write button");

            try {
                const ndef = new NDEFReader();
                await ndef.write("Hello world!");
                log("> Message written");
            } catch (error) {
                log("Argh! " + error);
            }
        });

        makeReadOnlyButton.addEventListener("click", async () => {
            log("User clicked make read-only button");

            try {
                const ndef = new NDEFReader();
                await ndef.makeReadOnly();
                log("> NFC tag has been made permanently read-only");
            } catch (error) {
                log("Argh! " + error);
            }
        });
    </script>
@endsection
