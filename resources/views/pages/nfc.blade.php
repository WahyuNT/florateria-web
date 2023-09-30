@extends('layouts.master')
@section('content')
    ---
    feature_name: Web NFC
    chrome_version: 89
    feature_id: 6261030015467520
    check_min_version: true
    ---

    <h3>Background</h3>
    <p>
        Web NFC aims to provide sites the ability to read and write to NFC tags when
        they are brought in close proximity to the user’s device (usually 5-10 cm, 2-4
        inches). The current scope is limited to NDEF, a lightweight binary message
        format. Low-level I/O operations (e.g. ISO-DEP, NFC-A/B, NFC-F) and Host-based
        Card Emulation (HCE) are not supported within the current scope.
    </p>

    <button id="scanButton">Scan</button>
    <button id="writeButton">Write</button>
    <button id="makeReadOnlyButton">Make Read-Only</button>

    {% include output_helper.html initial_output_content=initial_output_content %}

    <script>
        log = ChromeSamples.log;

        if (!("NDEFReader" in window))
            ChromeSamples.setStatus("Web NFC is not available. Use Chrome on Android.");
    </script>

    {% include js_snippet.html filename='index.js' %}


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
