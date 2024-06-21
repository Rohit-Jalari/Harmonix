<?php
// require('../config/session.php');
?>
<!DOCTYPE html>
<html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template-free">

<head>
    <?php include('includes/head.php'); ?>
    <link rel="stylesheet" href="assets/vendor/css/rtl/core-dark.css">
    <link rel="stylesheet" href="assets/vendor/libs/dropzone/dropzone.css">


    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../dist/bundle.js" type="module"></script>
    <script>
        $(document).ready(function() {
            // process button is enabled after uploading file
            $('#file').change(function() {
                var fileSelected = $(this).val() !== "";
                $('#submitBtn').prop('disabled', !fileSelected);
            });

            $('form').submit(function(event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);
                $("#file").val(""); // Clear file input after submission
                $('#submitBtn').prop('disabled', true) // disables process button after clicking it
                $("#audioPlayer").empty(); // Clear audio player div
                console.log(formData);
                $.ajax({
                    url: 'process/process.php',
                    type: 'POST',
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // var data = JSON.parse(response);
                        // var outputPath = '../' + JSON.parse(data).outputPath;
                        // var audioID = JSON.parse(data).audioID;
                        console.log(response);
                        // console.log('File Path = ' + outputPath);
                        // console.log('Audio ID = ' + audioID);
                        // let div = $(`<div id="audioID">${audioID}</div>`);
                        // $('#audioPlayer').append(div);
                        // // Create the audio element
                        // var audioPlayer = $('<audio controls></audio>');
                        // // Set the source as 'outputPath' of the audio element
                        // audioPlayer.attr('src', outputPath);
                        // // Append the audio player to the div with id 'audioPlayer'
                        // $('#audioPlayer').append(audioPlayer);
                    },
                    error: function() {
                        alert('Error processing file.');
                    }
                });
            });
        });
    </script>
    <style>
        #dropzone-basic {
            border: 2px dashed #9ca8b6;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

                <div class="app-brand">
                    <a href="../../pages/profile.php" class="py-2">
                        <span class="logo logo-shadow">Harmonix</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item active">
                        <a href="studioSeparate.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Separate Vocals</div>
                        </a>
                    </li>
                    <!-- Studio -->
                    <li class="menu-item">
                        <a href="studioMain.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Studio</div>
                        </a>
                    </li>
                    <!-- Library -->
                    <li class="menu-item">
                        <a href="studioLibrary.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Library</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- Menu End -->

            <!-- Layout page Start -->
            <div class="layout-page" style="height: 150vh">
                <!-- nav bar start -->
                <?php include('includes/navbar.php') ?>
                <!-- nav bar end -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="row d-flex justify-content-center aligh-items-center">
                            <div class="col-10">
                                <div class="card">
                                    <div>
                                        Separate Vocals
                                    </div>
                                    <form action="process/process.php" method="post" class="dropzone" id="dropzone-basic">
                                        <div class="dz-message needsclick">
                                            Drop audio files here or click to upload
                                        </div>
                                    </form>
                                    <button type="button" id="submitBtn">Add Audio Player</button>
                                    <!-- Container for Wavesurfer -->
                                    <div id="waveform" style="width: 100%; height: 200px; display: none;"></div>
                                    <div id="audioPlayer"></div>

                                </div>

                            </div>
                        </div>



                        <h1>Upload Audio File</h1>
                        <!-- Old Upload Form -->
                        <!-- <form id="uploadForm" action="" method="post" enctype="multipart/form-data">
                            <input type="file" name="audioFile" accept=".wav, .mp3" id="file">
                            <button type="submit" name="submit" id="submitBtn" disabled>Process</button>
                        </form> -->

                        <div class="audio-wrapper">
                            <div id="audioControls">
                                <!-- Controls for trimming -->
                                <button id="trimButton">Trim to 30 seconds</button>
                                <button id="submitButton" style="display: none;">Submit</button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</body>
<?php include('includes/script.php') ?>
<script src="assets/vendor/libs/dropzone/dropzone.js"></script>
<script>
    Dropzone.options.dropzoneBasic = {
        autoProcessQueue: false, // Prevent automatic uploads
        maxFiles: 1, // Allow only one file
        acceptedFiles: 'audio/*',
        addRemoveLinks: true, // Allow file removal
        init: function() {
            var myDropzone = this;

            // Listen for the 'addedfile' event to store the uploaded file information
            myDropzone.on("addedfile", function(file) {
                // Store the file in the Dropzone instance for later processing
                myDropzone.files.push(file);
            });

            // Add an event listener to the button to create the audio player
            document.getElementById("submitBtn").addEventListener("click", function() {
                if (myDropzone.files.length > 0) {
                    // Assume the first file is the one we want to process
                    var file = myDropzone.files[0];
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        var audioUrl = event.target.result;
                        var audioContainer = document.getElementById("audioContainer");
                        var audioElement = document.createElement("audio");
                        audioElement.controls = true;
                        audioElement.src = audioUrl;
                        audioContainer.appendChild(audioElement);
                    };

                    reader.readAsDataURL(file);
                } else {
                    alert("Please upload an audio file first.");
                }
            });
        }
    };
</script>

</html>