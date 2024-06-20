const path = require('path');

module.exports = {
    entry: {
        main: 'src/trimmer.js',     // Entry point for your main application
    },
    output: {
        filename: 'bundle.js',  // Output bundle names will be main.bundle.js, wavesurfer.bundle.js, etc.
        path: path.resolve(__dirname, 'dist')
    },
    module: {
        rules: [
        ]
    }
};
