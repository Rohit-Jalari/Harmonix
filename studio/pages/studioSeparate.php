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
    <!-- <script src="../dist/bundle.js" type="module"></script> -->
    <script>
        $(document).ready(function() {
            // process button is enabled after uploading file
            $('#file').change(function() {
                var fileSelected = $(this).val() !== "";
                $('#submitBtn').prop('disabled', !fileSelected);
            });

            $('form').submit(function(event) {
                event.preventDefault();
            });
        });
    </script>
    <style>
        #dropzone-basic {
            border: 2px dashed #9ca8b6;
            padding: 20px;
            border-radius: 5px;
        }

        /* CSS for individual sliders */
        .slider {
            writing-mode: vertical-lr;
            /* Vertical orientation */
            direction: rtl;
            /* Right-to-left direction for vertical slider */
            margin: 10px;
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
                                <div id="uploadBody" class="card" style="display: block;">
                                    <div>
                                        Separate Vocals
                                    </div>
                                    <form action="process/process.php" method="post" class="dropzone" id="dropzone-basic">
                                        <div class="dz-message needsclick">
                                            Drop audio files here or click to upload
                                        </div>
                                    </form>
                                    <div class="d-flex justify-content-center mt-3">
                                        <button class="primary" id="submitButton" disabled>Process</button>
                                    </div>
                                </div>
                                <div class="card" id="spectogramContainer" style="display: none;">
                                    <div>
                                        <button class="btn-danger mb-3" id="discardButton">Discard</button>
                                    </div>
                                    <!-- Container for Wavesurfer -->
                                    <div id="spectogram" style="width: 100%; height: 200px;">

                                    </div>
                                    <div class="d-flex justify-content-center align-item-center" style="width: 100%;">
                                        <button id="separateButton">
                                            Separate
                                        </button>
                                    </div>
                                </div>
                                <div class="card" id="effects" style="display: none;">
                                    <div class="nav-align-top">
                                        <ul class="nav nav-pills mb-3" role="tablist">
                                            <li class="nav-item">
                                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#equalizer" aria-controls="equalizer" aria-selected="true">Equalizer</button>
                                            </li>
                                            <li class="nav-item">
                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#reverb" aria-controls="reverb" aria-selected="false">Reverb</button>
                                            </li>

                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="equalizer" role="tabpanel">
                                                <label class="switch switch-square switch-success">
                                                    <input type="checkbox" class="switch-input" id="equalizerSwitch" />
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on">
                                                            <i class="bx bx-check"></i>
                                                        </span>
                                                        <span class="switch-off">
                                                            <i class="bx bx-x"></i>
                                                        </span>
                                                    </span>
                                                    <span class="switch-label">Off</span>
                                                </label>
                                                <div class="equalizer-container d-flex align-items-center">
                                                    <label>Equalizer Sliders:</label>
                                                    <input type="range" class="slider" id="slider1" min="-40" max="40" step="0.1" value="0" disabled>
                                                    <input type="range" class="slider" id="slider2" min="-40" max="40" step="0.1" value="0" disabled>
                                                    <input type="range" class="slider" id="slider3" min="-40" max="40" step="0.1" value="0" disabled>
                                                    <input type="range" class="slider" id="slider4" min="-40" max="40" step="0.1" value="0" disabled>
                                                    <input type="range" class="slider" id="slider5" min="-40" max="40" step="0.1" value="0" disabled>
                                                    <input type="range" class="slider" id="slider6" min="-40" max="40" step="0.1" value="0" disabled>
                                                    <input type="range" class="slider" id="slider7" min="-40" max="40" step="0.1" value="0" disabled>
                                                    <input type="range" class="slider" id="slider8" min="-40" max="40" step="0.1" value="0" disabled>
                                                    <input type="range" class="slider" id="slider9" min="-40" max="40" step="0.1" value="0" disabled>
                                                    <input type="range" class="slider" id="slider10" min="-40" max="40" step="0.1" value="0" disabled>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="reverb" role="tabpanel">
                                                <label class="switch switch-square switch-success">
                                                    <input type="checkbox" class="switch-input" />
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on">
                                                            <i class="bx bx-check"></i>
                                                        </span>
                                                        <span class="switch-off">
                                                            <i class="bx bx-x"></i>
                                                        </span>
                                                    </span>
                                                    <span class="switch-label">Off</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
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
<script src="assets/vendor/libs/wavesurfer/wavesurfer.min.js"></script>
<script src="assets/vendor/libs/wavesurfer/plugins/hover.min.js"></script>
<script src="assets/vendor/libs/wavesurfer/plugins/regions.min.js"></script>
<script>
    var wavesurfer, uploadedAudioURL;
    // Disable Dropzone auto-discovery
    Dropzone.autoDiscover = false;

    function blockUI(containerID, message) {
        $(containerID).block({
            message: `<div class="d-flex justify-content-center"><p class="me-2 mb-0" style="color:black;">${message}</p> <div class="sk-wave sk-primary m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>`,
            css: {
                backgroundColor: "transparent",
                border: "0"
            },
            overlayCSS: {
                backgroundColor: "white",
                opacity: 0.8
            }
        });
    }

    // Initialize Dropzone
    var myDropzone = new Dropzone("#dropzone-basic", {
        autoProcessQueue: false, // Prevent automatic uploads
        maxFiles: 1, // Allow only one file
        acceptedFiles: 'audio/*',
        addRemoveLinks: true // Allow file removal
    });

    // Listen for the 'addedfile' event to store the uploaded file information
    myDropzone.on("addedfile", function(file) {
        // Remove any previously added file
        if (myDropzone.files.length > 1) {
            myDropzone.removeFile(myDropzone.files[0]);
        }
        $('#spectogramContainer').css('display', 'none');
        $('#submitButton').prop('disabled', false);
    });

    // Listen for the 'removedfile' event to clear the spectogram container
    myDropzone.on("removedfile", function(file) {
        document.getElementById("spectogram").innerHTML = "";
        $('#spectogramContainer').css('display', 'none');
    });

    // Add an event listener to the button to create the spectogram
    // document.getElementById("submitButton").addEventListener("click", function() {
    $("#submitButton").on("click", function() {
        console.log('start');
        blockUI('#spectogram', 'Please Wait.....')
        console.log('end');

        if (myDropzone.files.length > 0) {
            // Assume the first file is the one we want to process
            var file = myDropzone.files[0];
            var reader = new FileReader();

            reader.onload = function(event) {
                var audioUrl = event.target.result;

                // Clear any existing spectogram
                document.getElementById("spectogram").innerHTML = "";

                wavesurfer = WaveSurfer.create({
                    container: '#spectogram',
                    waveColor: 'violet',
                    progressColor: 'purple',
                    height: 128,
                    mediaControls: true,
                    autoplay: false,
                    plugins: [
                        WaveSurfer.Hover.create({
                            lineColor: '#ff0000',
                            lineWidth: 2,
                            labelBackground: '#555',
                            labelColor: '#fff',
                            labelSize: '11px',
                        })
                    ]
                });
                /** When audio starts loading */
                wavesurfer.on('load', (url) => {
                    blockUI('#spectogram', 'Initializing Loading .....');
                });

                /** During audio loading */
                wavesurfer.on('loading', (percent) => {
                    blockUI('#spectogram', 'Loading Audio .....');
                });

                /** When the audio has been decoded */
                wavesurfer.on('decode', (duration) => {
                    $('#spectogram').unblock();
                });

                /** When the audio is both decoded and can play */
                wavesurfer.on('ready', (duration) => {
                    $('#spectogram').unblock();
                });

                /** When visible waveform is drawn */
                wavesurfer.on('redrawcomplete', () => {
                    blockUI('#spectogram', 'Drawing Waveform.....');
                });
                /** When all audio channel chunks of the waveform have drawn */
                wavesurfer.on('redrawcomplete', () => {
                    $('#spectogram').unblock();
                })

                // Create a new audio element to get duration
                var audio = new Audio();
                audio.src = audioUrl;

                // Wait for audio metadata to be loaded to get duration
                audio.addEventListener('loadedmetadata', function() {
                    var duration = audio.duration; // Get audio duration in seconds
                    if (duration > 300) {
                        alert("Error : File duration must be less than 120 seconds\nUploaded File duration = " + duration + " seconds");
                        myDropzone.removeFile(myDropzone.files[0]);
                        $('#spectogramContainer').css('display', 'none');
                        $('#uploadBody').css('display', 'block');
                        $('#separateButton').prop('disabled', false) // disables process button after clicking it
                    }

                    var plugins = [
                        WaveSurfer.Hover.create({
                            lineColor: '#ff0000',
                            lineWidth: 2,
                            labelBackground: '#555',
                            labelColor: '#fff',
                            labelSize: '11px',
                        })
                    ];
                    wavesurfer.load(audioUrl);
                });
            };

            reader.readAsDataURL(file);
            $("#spectogram").unblock();
            $('#uploadBody').css('display', 'none');
            $('#spectogramContainer').css('display', 'block');
            $('#separateButton').text('Separate');
        } else {
            alert("Please upload an audio file first.");
        }
    });
    $("#discardButton").on('click', function() {
        var confirmed = confirm('Do you want to discard progress?');

        if (confirmed) {
            myDropzone.removeFile(myDropzone.files[0]);
            $('#spectogramContainer').css('display', 'none');
            $('#equalizer').css('display', 'none');
            $('#uploadBody').css('display', 'block');
            $('#separateButton').prop('disabled', false) // disables process button after clicking it
            $('#submitButton').prop('disabled', true);
        }
    });
    $('#separateButton').on('click', function() {
        // Capture start time
        var startTime = new Date().getTime();
        // console.log($('#separateButton').text());
        if ($('#separateButton').text().trim() == 'Separate') {
            console.log('Separated');
            if (wavesurfer.isPlaying()) {
                wavesurfer.pause();
            }
            blockUI('#spectogram', 'Separating Vocal.....');
            // var formData = new FormData(myDropzone.files[0]);

            var file = myDropzone.files[0];
            var formData = new FormData();

            formData.append('audioFile', file);

            $('#separateButton').text('Save'); // disables process button after clicking it
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
                    console.log(response);
                    var data = JSON.parse(response).result;
                    var outputPath = '../' + JSON.parse(data).outputPath;
                    var audioID = JSON.parse(data).audioID;
                    console.log('File Path = ' + outputPath);
                    console.log('Audio ID = ' + audioID);
                    wavesurfer.empty();
                    // outputPath = '../outputs/audioID=667d9740a64550.31045716/accompaniment.mp3';
                    uploadedAudioURL = outputPath;
                    wavesurfer.load(outputPath);
                    $('#spectogram').unblock();
                    loadequalizer();
                    // Capture completion time
                    var completionTime = new Date().getTime();

                    // Calculate elapsed time in milliseconds
                    var elapsedTimeMs = completionTime - startTime;

                    // Convert elapsed time to seconds
                    var elapsedTimeSec = elapsedTimeMs / 1000; // convert milliseconds to seconds

                    // Log or use elapsedTimeSec as needed
                    console.log('AJAX request took ' + elapsedTimeSec.toFixed(2) + ' seconds to complete.');
                },
                error: function() {
                    alert('Error processing file.');
                }
            });
        } else if ($('#separateButton').text().trim() == 'Save') {
            console.log("Saved");
        }
    });

    function loadequalizer() {
        $('#effects').css('display', 'block');
    }
</script>
<script type="module" data-type="module" src="scripts/effectEqualizer.js"></script>

</html>