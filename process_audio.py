from flask import Flask, request, jsonify
import numpy as np
import librosa
from sklearn.decomposition import NMF

app = Flask(__name__)

def nmf_separation(audio_file):
    try:
        # Load the audio file
        y, sr = librosa.load(audio_file, sr=None)

        # Compute the magnitude spectrogram
        S = np.abs(librosa.stft(y))

        # Perform NMF
        n_components = 2  # Number of components (e.g., vocals and accompaniment)
        model = NMF(n_components=n_components, init='random', random_state=0)
        W = model.fit_transform(S)
        H = model.components_

        # Reconstruct the separated sources
        vocals = np.dot(W[:, 0][:, np.newaxis], H[0, np.newaxis, :])
        accompaniment = np.dot(W[:, 1][:, np.newaxis], H[1, np.newaxis, :])

        # Invert the spectrograms to obtain separated audio signals
        accompaniment_audio = librosa.istft(accompaniment)

        # Convert the audio signal to bytes (for simplicity)
        backing_track_bytes = librosa.util.buf_to_float(accompaniment_audio.T)
        return backing_track_bytes

    except Exception as e:
        return str(e)

@app.route('/process_audio', methods=['POST'])
def process_audio():
    if 'audio_file' not in request.files:
        return jsonify({'error': 'No audio file uploaded'}), 400
    
    return jsonify({'backing_track': 'Hello'})

    # audio_file = request.files['audio_file']
    # audio_data = audio_file.read()

    # Process audio and get backing track
    # backing_track_bytes = nmf_separation(audio_data)

    # Return the processed audio (backing track) as bytes
    # return jsonify({'backing_track': backing_track_bytes.decode('latin-1')})

if __name__ == '__main__':
    app.run(debug=False)
