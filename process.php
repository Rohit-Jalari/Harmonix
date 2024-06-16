<?php

function processAudio($audioFilePath) {
    
    $pythonScript = 'python process_audio.py'; 

    // Validation
    if (!file_exists($audioFilePath) || !is_file($audioFilePath)) {
        return "Error: Invalid file.";
    }

    // Escape any shell arguments for security
    $escapedFilePath = escapeshellarg($audioFilePath);

    // Execution and captuure 'output' and 'errors'
    exec("$pythonScript $escapedFilePath 2>&1", $output, $return_var);

    // Check for errors
    if ($return_var !== 0) {
        error_log("Error executing Python script: " . implode("\n", $output));
        return "Error executing Python script.";
    }
    //outputs the processed audio data as a base64 encoded string
    return $output[0];
}


if(isset($_FILES['audioFile'])) {
    // Directory where uploaded files will be saved
    $target_dir = "uploads/";
    // Constructing the path to save the uploaded file
    // $target_file = $target_dir . basename($_FILES["audioFile"]["name"]);

    // // Check if the file is a valid audio file
    // $audioFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // if($audioFileType != "wav" && $audioFileType != "mp3") {
    //     echo json_encode(array('error' => 'Only WAV and MP3 files are allowed.'));
    //     exit;
    // }

    // Check file size (max 50MB)
    if ($_FILES["audioFile"]["size"] > 50000000) {
        echo json_encode(array('error' => 'File size exceeds maximum limit of 50MB.'));
        exit;
    }

    // Generate a unique filename to avoid collisions
    // $uniqueFileName = $target_dir . uniqid('audio_', true) . '.' . $audioFileType;
    $uniqueFileName = $target_dir . uniqid('audio_', true) . '.mp3';

    // Attempt to move the uploaded file to the specified location
    if (move_uploaded_file($_FILES["audioFile"]["tmp_name"], $uniqueFileName)) {
    
        $result = processAudio($uniqueFileName);
        
        // Delete the uploaded file after processing
        unlink($uniqueFileName);

        // Return processed data as JSON response
        echo json_encode(array('results' => $result));
    } else {
        echo json_encode(array('error' => 'Error uploading file.'));
    }
}
