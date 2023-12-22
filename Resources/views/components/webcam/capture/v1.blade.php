<div class="container">

    <h1 class="text-center">Laravel webcam capture image and save from camera</h1>


    <form method="POST" action="#">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br />
                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
            </div>

            <div class="col-md-6">
                <div id="results">Your captured image will appear here...</div>
            </div>

            <div class="col-md-12 text-center">
                <br />
                <button class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>

@push('styles')
    <style type="text/css">
        #results {
            padding: 20px;
            border: 1px solid;
            background: #ccc;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <script>
        Webcam.set({
            width: 490,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });

        }
    </script>
@endpush
