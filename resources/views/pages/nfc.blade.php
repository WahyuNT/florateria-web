@extends('layouts.master')
@section('content')
    <!-- (A) NFC TAG ACTIONS -->
    <div id="demoNFC">
        <input type="text" id="demoT" value="Hello World" required>
        <input type="button" id="demoW" value="Write" disabled onclick="nfc.write();">
        <input type="button" id="demoR" value="Read" disabled onclick="nfc.read()">
    </div>

    <!-- (B) "CONSOLE MESSAGES" -->
    <div id="demoMSG"></div>


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
                const ndef = new NDEFReader();
                ndef.write(nfc.hTxt.value)
                    .then(() => nfc.logger("Write OK"))
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
