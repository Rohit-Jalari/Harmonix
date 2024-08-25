import WaveSurfer from '../assets/vendor/libs/wavesurfer/wavesurfer.esm.js';

var audioContext = null;

$(document).ready(function () {
    $('#reverbSwitch').change(function () {
        if ($(this).prop('checked')) {
            $(this).siblings('.switch-label').text('On'); // change label if checked 
            

        } else {
            $(this).siblings('.switch-label').text('Off'); // change label if unchecked
            
        }
    });
});

// Event listener to start AudioContext on user gesture
document.getElementById('reverbSwitch').addEventListener('click', async () => {// Create your own media element
    if (audioContext == null) {
        console.log(uploadedAudioURL);
        var audio = new Audio(uploadedAudioURL);
        // audio.controls = true;

        wavesurfer.destroy()

        // Create a WaveSurfer instance and pass the media element
        wavesurfer = WaveSurfer.create({
            container: '#spectogram',
            waveColor: 'rgb(200, 0, 200)',
            progressColor: 'rgb(100, 0, 100)',
            autoplay: true,
            media: audio, // <- this is the important part
        })

        // Optionally, add the audio to the page to see the controls
        $('#spectogram').append(audio)
        $(audio).css('width', '100%')

        // Append audio element to the body
        // document.body.appendChild(audio);

        await Tone.start();  // Start Tone.js context
        // reverb = new Tone.Reverb().toDestination();  // Create reverb effect
        let delay = new Tone.FeedbackDelay(0.5, 0.1).toDestination();
        const mediaElementSource = Tone.context.createMediaElementSource(audio);
        // Tone.connect(mediaElementSource, reverb);
        Tone.connect(mediaElementSource, delay);
    }

});