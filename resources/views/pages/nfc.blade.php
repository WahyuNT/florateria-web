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
            <form action="{{ route('store-plant') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kartu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- (A) NFC TAG ACTIONS -->
                        <div id="demoNFC">
                            <div class="d-flex justify-content-start">
                                <div class="col me-3">

                                    <select class="form-select" name="id_plant" aria-label="Default select example">
                                        <option selected>Pilih jenis tanaman</option>
                                        @foreach ($plants as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="button" class="btn btn-success" id="demoW" value="Write" disabled
                                        onclick="nfc.write();">
                                </div>
                            </div>
                            <input type="text" name="rfid" hidden id="demoT" value="Hello World" required>
                            {{-- <input type="button" id="demoR" value="Read" disabled onclick="nfc.read()"> --}}
                        </div>

                        <!-- (B) "CONSOLE MESSAGES" -->
                        <div id="demoMSG"></div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        function generateRandomText(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let randomText = '';

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                randomText += characters.charAt(randomIndex);
            }

            return randomText;
        }

        function setRandomText() {
            const demoInput = document.getElementById("demoT");
            const randomText = generateRandomText(30);
            demoInput.value = randomText;
        }
        // Event listener untuk menjalankan setRandomText() saat DOM telah dimuat
        document.addEventListener("DOMContentLoaded", setRandomText);
    </script>
    <script>
        function sendForm() {
            const form = document.querySelector("form"); // Pilih formulir berdasarkan elemen pertama
            const formData = new FormData(form); // Buat objek FormData dari formulir

            fetch(form.action, {
                    method: "POST",
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    // Tangani respons dari API di sini
                    console.log(data);
                })
                .catch((error) => {
                    // Tangani kesalahan jika terjadi
                    console.error("Kesalahan:", error);
                });
        }
    </script>

    <script>
        var nfc = {
            // (A) INIT
            hTxt: null, // html data to write
            hWrite: null, // html write button
            hRead: null, // html read button
            hMsg: null, // html "console messages"
            init: () => {
                // (A1) GET HTML ELEMENTS
                nfc.hTxt = document.getElementById("demoT"),
                    nfc.hWrite = document.getElementById("demoW"),
                    nfc.hRead = document.getElementById("demoR"),
                    nfc.hMsg = document.getElementById("demoMSG");

                // (A2) FEATURE CHECK + GET PERMISSION
                if ("NDEFReader" in window) {
                    nfc.logger("Ready");
                    nfc.hWrite.disabled = false;
                    nfc.hRead.disabled = false;
                    nfc.hReadOnly.disabled = false;
                } else {
                    nfc.logger("Web NFC is not supported on this browser.");
                }
            },

            // (B) HELPER - DISPLAY LOG MESSAGE
            logger: msg => {
                let row = document.createElement("div");
                row.innerHTML = msg;
                nfc.hMsg.appendChild(row);
            },

            // (C) WRITE NFC TAG
            write: () => {
                nfc.logger("Approach NFC Tag");
                sendForm();
                const ndef = new NDEFReader();
                ndef.write(nfc.hTxt.value)
                    .then(() => {
                        nfc.logger("Write OK");
                        setRandomText();
                    })
                    .catch(err => nfc.logger("ERROR - " + err.message));
            },


            // (D) READ NFC TAG
            read: () => {
                nfc.logger("Approach NFC Tag");
                const ndef = new NDEFReader();
                ndef.scan()
                    .then(() => {
                        ndef.onreadingerror = err => nfc.logger("Read failed");
                        ndef.onreading = evt => {
                            const decoder = new TextDecoder();
                            for (let record of evt.message.records) {
                                nfc.logger("Record type: " + record.recordType);
                                nfc.logger("Record encoding: " + record.encoding);
                                nfc.logger("Record data: " + decoder.decode(record.data));
                            }
                        };
                    })
                    .catch(err => nfc.logger("Read error - " + err.message));
            }
        };
        window.onload = nfc.init;
    </script>
@endsection
