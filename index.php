<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Processing</title>
    <script src="assets/libs/jquery.js"></script>
    <script src="dist/bundle.js" type="module"></script>
    <!-- <script src="https://unpkg.com/wavesurfer.js"></script> -->

    <script>
        $(document).ready(function () {
            // Function to handle form submission
            $('form').submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                var formData = new FormData($(this)[0]);
                console.log(formData);
                $.ajax({
                    url: 'process.php', // script that handles form submission
                    type: 'POST',
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        var data = JSON.parse(response);
                        console.log(data.result);
                        $('#audioPlayer').html('<audio controls><source src="data:audio/mp3;base64,' + response.backing_track + '" type="audio/mp3"></audio>');
                    },
                    error: function () {
                        alert('Error processing file.');
                    }
                });
            });
        });
    </script>
</head>

<body>
    <h1>Upload Audio File</h1>
    <form id="uploadForm" action="process.php" method="post" enctype="multipart/form-data">
        <input type="file" name="audioFile" accept=".wav, .mp3">
    </form>

    <div class="audio-wrapper">
        <div id="audioControls">
            <!-- Controls for trimming -->
            <button id="trimButton">Trim to 30 seconds</button>
            <button id="submitButton" style="display: none;">Submit</button>
        </div>
        <!-- Container for Wavesurfer -->
        <div id="waveform" style="width: 100%; height: 200px; display: none;"></div>
    </div>

    <!-- Other scripts and closing tags -->
</body>


</html>