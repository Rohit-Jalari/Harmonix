import WaveSurfer from '../assets/vendor/libs/wavesurfer/wavesurfer.esm.js';

var audioContext = null;
var filters = [];
var prevFilter = [];
var inputSliders = document.querySelectorAll('.slider');

$(document).ready(function () {
    $('#equalizerSwitch').change(function () {
        if ($(this).prop('checked')) {
            $(this).siblings('.switch-label').text('On'); // change label if checked 
            inputSliders.forEach(slider => {
                $(slider).prop('disabled', false)   // remove disable if checked
            });
            if (prevFilter.length != 0) {  // escape first time checked
                filters.forEach( (filter, index) => {
                    filter.gain.value = prevFilter[index];   // copy previous filter to current
                })                
            } 

        } else {
            $(this).siblings('.switch-label').text('Off'); // change label if unchecked
            inputSliders.forEach(slider => {
                $(slider).prop('disabled', true)   // disable if unchecked
            });
            prevFilter = filters.map(function (filter) { // copy previous equalizer value to prevFilter
                return filter.gain.value;
            })
            console.log(prevFilter);
            filters.forEach((filter) => {  // reset the filter
                console.log(filter.gain.value);
                filter.gain.value = 0;
            })
        }
    });
});


// Event listener to start AudioContext on user gesture
document.getElementById('equalizerSwitch').addEventListener('click', function () {// Create your own media element
    if (audioContext == null) {
        const audio = new Audio()
        audio.controls = true
        audio.src = uploadedAudioURL

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

        // Now, create a Web Audio equalizer

        // Create Web Audio context
        audioContext = new AudioContext()

        // Define the equalizer bands
        const eqBands = [32, 64, 125, 250, 500, 1000, 2000, 4000, 8000, 16000]

        // Create a biquad filter for each band
        filters = eqBands.map((band) => {
            const filter = audioContext.createBiquadFilter()
            filter.type = band <= 32 ? 'lowshelf' : band >= 16000 ? 'highshelf' : 'peaking'
            filter.gain.value = 0
            filter.Q.value = 1 // resonance
            filter.frequency.value = band // the cut-off frequency
            return filter
        })

        // Connect the audio to the equalizer
        audio.addEventListener(
            'canplay',
            () => {
                // Create a MediaElementSourceNode from the audio element
                const mediaNode = audioContext.createMediaElementSource(audio)

                // Connect the filters and media node sequentially
                const equalizer = filters.reduce((prev, curr) => {
                    prev.connect(curr)
                    return curr
                }, mediaNode)

                // Connect the filters to the audio output
                equalizer.connect(audioContext.destination)
            },
            { once: true },
        )

        // feed the value of slider to the filter array
        inputSliders.forEach((slider, index) => {
            slider.oninput = (e) => (filters[index].gain.value = e.target.value)
        });
    }
});
