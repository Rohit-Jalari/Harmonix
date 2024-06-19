import WaveSurfer from 'wavesurfer.js'

$(document).ready(function () {
    var wavesurfer = WaveSurfer.create({
        container: '#waveform',
        waveColor: 'black',
        progressColor: '#383351',
        cursorColor: '#fff',
        barWidth: 3,
        barHeight: 1,
        responsive: true,
        hideScrollbar: true
    });

    // Function to handle file selection
    $('input[name="audioFile"]').change(function () {
        var file = this.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var audioData = e.target.result;
                wavesurfer.loadBlob(file);
                $('#waveform').show();
            };
            reader.readAsDataURL(file);
        }
    });

    // Trim to 30 seconds
    $('#trimButton').click(function () {
        wavesurfer.enableDragSelection({
            color: 'rgba(255, 0, 0, 0.3)',
            loop: false,
            minLength: 30, // trim to 30 seconds
            drag: true,
            resize: true
        });
    });
});