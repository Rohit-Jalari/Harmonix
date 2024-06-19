<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Processing</title>
    <script src="assets/js/jquery.min.js"></script>
    <script src="dist/bundle.js" type="module"></script>
    <!-- <script src="https://unpkg.com/wavesurfer.js"></script> -->

    <script>
        $(document).ready(function () {
            // process button is enabled after uploading file
            $('#file').change(function () {
                var fileSelected = $(this).val() !== "";
                $('#submitBtn').prop('disabled', !fileSelected);
            });

            $('form').submit(function (event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);
                $("#file").val(""); // Clear file input after submission
                $('#submitBtn').prop('disabled', true) // disables process button after clicking it
                $("#audioPlayer").empty(); // Clear audio player div
                console.log(formData);
                $.ajax({
                    url: 'process.php',
                    type: 'POST',
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        var data = JSON.parse(response).result;
                        var outputPath = JSON.parse(data).outputPath;
                        var audioID = JSON.parse(data).audioID;
                        console.log(data);
                        console.log('File Path = ' + outputPath);
                        console.log('Audio ID = ' + audioID);
                        let div = $(`<div id="audioID">${audioID}</div>`);
                        $('#audioPlayer').append(div);
                        // Create the audio element
                        // var audioPlayer = $('<audio controls></audio>');
                        // Set the source as 'outputPath' of the audio element
                        // audioPlayer.attr('src', outputPath);    
                        // Append the audio player to the div with id 'audioPlayer'
                        // $('#audioPlayer').append(audioPlayer);
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
        <input type="file" name="audioFile" accept=".wav, .mp3" id="file">
        <button type="submit" name="submit" id="submitBtn" disabled>Process</button>
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
