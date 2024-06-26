<?php

function processAudio($audioFilePath) {
    $url = 'http://localhost:5000/separate_audio'; //flask server
    
    $postData = [
        'audio_file' => new CURLFile($audioFilePath, 'audio/mp3')
    ];
    // return $audioFilePath;
    // $postData = json_encode(['audioFilePath' => $audioFilePath]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Set a reasonable timeout for the cURL request
    // curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout in seconds

    $response = curl_exec($ch);

    // Check for cURL errors
    if(curl_errno($ch)) {
        $error_message = curl_error($ch);
        curl_close($ch);
        return json_encode(array('error' => 'cURL error: ' . $error_message));
    }

    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Check HTTP status code for error handling
    if ($http_status >= 400) {
        return json_encode(array('error' => 'HTTP errors: ' . $http_status));
    }

    return $response;
}

if(isset($_FILES['audioFile'])) {
    // echo json_encode(array('result' => '$result'));
    // return 
    // echo json_encode(array('result' => 'working'));
    // return;
    // Directory where uploaded files will be saved
    $target_dir = "../../uploads/";

    // Validate file type and size (example for MP3 file)
    $allowed_types = array('audio/mpeg', 'audio/mp3', 'audio/wav');
    $max_file_size = 10 * 1024 * 1024; // 10 MB

    // Check file type
    if (!in_array($_FILES['audioFile']['type'], $allowed_types)) {
        echo json_encode(array('error' => 'Invalid file type. Only MP3 files are allowed.'));
        exit;
    }

    // Check file size
    if ($_FILES['audioFile']['size'] > $max_file_size) {
        echo json_encode(array('error' => 'File size exceeds maximum limit of 10 MB.'));
        exit;
    }

    // Generate a unique filename for the uploaded file
    $uniqueFileName = $target_dir . uniqid('audioID=', true) . '.mp3';

    // Attempt to move the uploaded file to the specified location
    if (move_uploaded_file($_FILES["audioFile"]["tmp_name"], $uniqueFileName)) {
        // Process the uploaded file
        $result = processAudio($uniqueFileName);
        
        // Delete the uploaded file after processing
        unlink($uniqueFileName);

        // Return processed data as JSON response
        if ($result !== false) {
            echo json_encode(array('result' => $result));
        } else {
            echo json_encode(array('error' => 'Error processing file.'));
        }
    } else {
        echo json_encode(array('error' => 'Error uploading file.'));
    }
}
?>
