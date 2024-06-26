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
                    <li class="menu-item">
                        <a href="studioSeparate.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Separate Vocals</div>
                        </a>
                    </li>
                    <!-- Studio -->
                    <li class="menu-item active">
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
                                    <form action="process/process.php" method="post" class="dropzone" id="dropzone-basic">
                                        <div class="dz-message needsclick">
                                            Drop audio files here or click to upload Track
                                        </div>
                                    </form>
                                    <div class="d-flex justify-content-center mt-3">
                                        <button class="primary" id="submitButton">Process</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 card" id="spectogramContainer" style="display: none;">
                                <div>
                                    <button class="btn-danger mb-3" id="discardButton">Discard All</button>
                                </div>
                                <!-- Container for Wavesurfer -->
                                <div id="spectogram" style="width: 100%; height: 200px;">

                                </div>
                                <div id="recordContainer" style="width: 100%; margin-top:1rem;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <button id="record">Record</button>
                                            <button id="pause" style="display: none;">Pause</button>

                                            <select id="mic-select">
                                                <option value="" hidden>Select mic</option>
                                            </select>

                                            <p id="progress">00:00</p>
                                        </div>
                                        <div>
                                            <button class="btn btn-danger" id="discardRecording">Discard Recording</button>
                                        </div>
                                    </div>


                                    <div id="mic" style="border: 1px solid #ddd; border-radius: 4px; margin-top: 1rem"></div>

                                    <div id="recordings" style="margin: 1rem 0"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    </div>
</body>
<?php include('includes/script.php') ?>
<script type="module" data-type="module" src="scripts/vocalRecord.js"></script>

<script src="assets/vendor/libs/dropzone/dropzone.js"></script>
<script src="assets/vendor/libs/wavesurfer/wavesurfer.min.js"></script>
<script src="assets/vendor/libs/wavesurfer/plugins/hover.min.js"></script>
<script src="assets/vendor/libs/wavesurfer/plugins/regions.min.js"></script>
<script>
    var wavesurfer, uploadAudiURL;
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

    });

    // Listen for the 'removedfile' event to clear the spectogram container
    myDropzone.on("removedfile", function(file) {
        document.getElementById("spectogram").innerHTML = "";
        $('#spectogramContainer').css('display', 'none');
    });

    // Add an event listener to the button to create the spectogram
    // document.getElementById("submitButton").addEventListener("click", function() {
    $("#submitButton").on("click", function() {
        // console.log('start');
        blockUI('#spectogram', 'Please Wait.....')
        // console.log('end');

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
                    blockUI('#spectogram', 'Initializing Process.....');
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
                    if (duration > 61) {
                        alert("Error : File duration must be less than 60 seconds\nUploaded File duration = " + duration + " seconds");
                        myDropzone.removeFile(myDropzone.files[0]);
                        $('#spectogramContainer').css('display', 'none');
                        $('#uploadBody').css('display', 'block');
                        $('#separateBtn').prop('disabled', false) // disables process button after clicking it

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
                    uploadAudiURL = audioURL;
                    $('#record').on('click', function() {
                        let recordStatus = document.getElementById('record').innerHTML;
                        console.log(recordStatus);
                        // if($(this).text() == 'Record') {
                        //     console.log('Record');
                        //     wavesurfer.playPause();
                        // } else if($(this).text() == 'Stop'){
                        //     console.log('Stop');
                        // }
                        // wavesurfer.playPause();
                    });
                });
            };

            reader.readAsDataURL(file);
            $("#spectogram").unblock();
            $('#uploadBody').css('display', 'none');
            $('#spectogramContainer').css('display', 'block');
        } else {
            alert("Please upload an audio file first.");
        }
    });
    $("#discardButton").on('click', function() {
        var confirmed = confirm('Do you want to discard progress?');

        if (confirmed) {
            myDropzone.removeFile(myDropzone.files[0]);
            $('#spectogramContainer').css('display', 'none');
            $('#uploadBody').css('display', 'block');
            // $('#mic').html('');
            $('#recordings').html('');
        }
    });
    $('#discardRecording').on('click', function() {
        var confirmed = confirm('Do you want to discard vocal record progress?');

        if (confirmed) {
            $('#recordings').html('');
        }

    })
</script>

</html>