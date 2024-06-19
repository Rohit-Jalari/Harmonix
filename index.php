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
                        var data = JSON.parse(JSON.parse(response).result).outputPath;
                        console.log(data);
                        // Create the audio element
                        var audioPlayer = $('<audio controls></audio>');    
                        // Set the source of the audio element
                        audioPlayer.attr('src', data);    
                        // Append the audio player to the div with id 'audioPlayer'
                        $('#audioPlayer').append(audioPlayer);
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
        <button type="submit" name="submit">Process</button>
    </form>

    <div class="audio-wrapper">
        <div id="audioControls">
            <!-- Controls for trimming -->
            <button id="trimButton">Trim to 30 seconds</button>
            <button id="submitButton" style="display: none;">Submit</button>
        </div>
        <!-- Container for Wavesurfer -->
        <div id="waveform" style="width: 100%; height: 200px; display: none;"></div>
        <div id="audioPlayer"></div>
    </div>

    <!-- Other scripts and closing tags -->
</body>


</html>