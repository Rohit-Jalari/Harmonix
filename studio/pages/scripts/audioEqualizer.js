import WaveSurfer from '../assets/vendor/libs/wavesurfer/wavesurfer.esm.js'

// Initialize variables
let audioContext = null;
const eqBands = [32, 64, 125, 250, 500, 1000, 2000, 4000, 8000, 16000];
let filters = [];

// Event listener to create AudioContext on user gesture
document.addEventListener('click', () => {
    if (audioContext === null) {
        if (window.AudioContext || window.webkitAudioContext) {
            audioContext = new (window.AudioContext || window.webkitAudioContext)();

            // Create filters for each band
            filters = eqBands.map((band) => {
                const filter = audioContext.createBiquadFilter();
                filter.type = band <= 32 ? 'lowshelf' : band >= 16000 ? 'highshelf' : 'peaking';
                filter.frequency.value = band;
                filter.gain.value = 0; // Random initial gain
                filter.Q.value = 1; // Quality factor
                return filter;
            });

            // Connect the audio element to the equalizer filters
            const audioElement = document.createElement('audio');
            audioElement.controls = true;
            audioElement.src = '../uploads/Trimmed-Tu jaane na.wav';
            document.body.appendChild(audioElement);

            audioElement.addEventListener('canplay', () => {
                const source = audioContext.createMediaElementSource(audioElement);
                const equalizer = filters.reduce((prev, curr) => {
                    prev.connect(curr);
                    return curr;
                }, source);
                equalizer.connect(audioContext.destination);
            }, { once: true });
        } else {
            console.error('Web Audio API is not supported in this browser');
        }
        // Create vertical sliders for each filter band
        const container = document.createElement('div');
        container.style.display = 'flex';
        container.style.flexDirection = 'row';
        container.style.alignItems = 'center';

        filters.forEach((filter) => {
            const sliderContainer = document.createElement('div');
            sliderContainer.style.margin = '10px';

            const slider = document.createElement('input');
            slider.type = 'range';
            slider.style.width = '20px';
            slider.style.height = '200px';
            slider.style.writingMode = 'vertical-lr'; // Vertical orientation
            slider.style.direction = 'rtl'; // Right-to-left direction for vertical slider
            slider.min = -40;
            slider.max = 40;
            slider.value = filter.gain.value;
            slider.step = 0.1;

            slider.oninput = (e) => {
                filter.gain.value = e.target.value;
            };

            sliderContainer.appendChild(slider);
            container.appendChild(sliderContainer);
        });

        document.body.appendChild(container);
    }
});