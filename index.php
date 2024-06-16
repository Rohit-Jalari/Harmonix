<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Processing</title>
    <script src="assets/libs/jquery.js"></script>
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
        <button type="submit" name="submit">Process</button>
    </form>

    <div class="audio-wrapper">
        <div id="audioPlayer">
        </div>
    </div>
</body>

</html>
