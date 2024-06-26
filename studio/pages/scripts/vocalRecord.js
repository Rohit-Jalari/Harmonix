// Record plugin

import WaveSurfer from '../assets/vendor/libs/wavesurfer/wavesurfer.esm.js'
import RecordPlugin from '../assets/vendor/libs/wavesurfer/plugins/record.esm.js'

let micWavesurfer, record
let scrollingWaveform = true

const createWaveSurfer = () => {
    // Create an instance of WaveSurfer
    if (micWavesurfer) {
        micWavesurfer.destroy()
    }
    micWavesurfer = WaveSurfer.create({
        container: '#mic',
        waveColor: 'rgb(200, 0, 200)',
        progressColor: 'rgb(100, 0, 100)',
    })

    // Initialize the Record plugin
    record = micWavesurfer.registerPlugin(RecordPlugin.create({ scrollingWaveform, renderRecordedAudio: false }))
    // Render recorded audio
    record.on('record-end', (blob) => {
        const container = document.querySelector('#recordings')
        const recordedUrl = URL.createObjectURL(blob)

        // Create wavesurfer from the recorded audio
        const resultWavesurfer = WaveSurfer.create({
            container,
            waveColor: 'rgb(200, 100, 0)',
            progressColor: 'rgb(100, 50, 0)',
            url: recordedUrl,
        })

        // Play button
        const button = container.appendChild(document.createElement('button'))
        button.textContent = 'Play'
        button.onclick = () => resultWavesurfer.playPause()
        resultWavesurfer.on('pause', () => (button.textContent = 'Play'))
        resultWavesurfer.on('play', () => (button.textContent = 'Pause'))

        // Download link
        const link = container.appendChild(document.createElement('a'))
        Object.assign(link, {
            href: recordedUrl,
            download: 'recording.' + blob.type.split(';')[0].split('/')[1] || 'webm',
            textContent: 'Download recording',
        })
    })
    pauseButton.style.display = 'none'
    recButton.textContent = 'Record'

    record.on('record-progress', (time) => {
        updateProgress(time)
    })
}

const progress = document.querySelector('#progress')
const updateProgress = (time) => {
    // time will be in milliseconds, convert it to mm:ss format
    const formattedTime = [
        Math.floor((time % 3600000) / 60000), // minutes
        Math.floor((time % 60000) / 1000), // seconds
    ]
        .map((v) => (v < 10 ? '0' + v : v))
        .join(':')
    progress.textContent = formattedTime
}

const pauseButton = document.querySelector('#pause')
pauseButton.onclick = () => {
    if (record.isPaused()) {
        record.resumeRecording()
        wavesurfer.play()
        pauseButton.textContent = 'Pause'
        return
    }

    record.pauseRecording()
    wavesurfer.pause()
    // spectogramAudio.pause()
    pauseButton.textContent = 'Resume'
}

const micSelect = document.querySelector('#mic-select')
{
    // Mic selection
    RecordPlugin.getAvailableAudioDevices().then((devices) => {
        devices.forEach((device) => {
            const option = document.createElement('option')
            option.value = device.deviceId
            option.text = device.label || device.deviceId
            micSelect.appendChild(option)
        })
    })
}
// Record button
const recButton = document.querySelector('#record')

recButton.onclick = () => {
    if (record.isRecording() || record.isPaused()) {
        record.stopRecording()
        // spectogramAudio.pause()
        wavesurfer.stop()
        recButton.textContent = 'Record'
        pauseButton.style.display = 'none'
        return
    }

    recButton.disabled = true
    // console.log(check);

    // reset the wavesurfer instance

    // get selected device
    const deviceId = micSelect.value
    record.startRecording({ deviceId }).then(() => {    
        wavesurfer.play() 
        recButton.textContent = 'Stop'
        recButton.disabled = false
        pauseButton.style.display = 'inline'
    })
}
createWaveSurfer()
