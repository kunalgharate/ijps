<?php
// Base upload directory
$baseUploadDir = __DIR__ . '/'; // Ensure the base upload directory is consistent

// Define folder mappings based on editor IDs
$folderMappings = [
    'txtAffiliation' => 'affiliation',
    'txtBody' => 'text_body',
    'txtReferance' => 'reference',
];

// Ensure the editorId is provided in the request
if (!isset($_POST['editorId'])) {
    echo json_encode(['uploaded' => false, 'error' => 'Editor ID not provided.']);
    exit;
}

$editorId = $_POST['editorId'];
$folder = $folderMappings[$editorId] ?? 'default'; // Use 'default' folder if no mapping exists

// Full path to the specific upload folder
$uploadDir = $baseUploadDir . $folder . '/';
// echo $uploadDir; die;
// Ensure the upload directory exists
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        echo json_encode(['uploaded' => false, 'error' => 'Failed to create upload directory.']);
        exit;
    }
}

// Check if Base64 image data is provided
if (isset($_POST['upload'])) {
    // Get Base64 string from POST data
    $base64Image = $_POST['upload'];

    // Decode the Base64 string
    $data = base64_decode($base64Image);

    // Check if decoding succeeded
    if ($data === false) {
        echo json_encode(['uploaded' => false, 'error' => 'Base64 decoding failed.']);
        exit;
    }

    // Ensure a valid image file extension based on the file's MIME type (you can further extend this)
    $fileExtension = 'jpg'; // Default to jpg if no MIME type provided
    $targetFile = $uploadDir . uniqid('img_', true) . '.' . $fileExtension;

    // Save the image file to the server
    if (file_put_contents($targetFile, $data)) {
        // Return a success response with the file URL
        $response = [
            'uploaded' => true,
            'url' => 'https://www.ijpsjournal.com/uploads/' . $folder . '/' . basename($targetFile),
        ];
        echo json_encode($response);
        exit;
    } else {
        echo json_encode(['uploaded' => false, 'error' => 'Failed to save image to the server.']);
        exit;
    }
} else {
    echo json_encode(['uploaded' => false, 'error' => 'No file uploaded.']);
    exit;
}
?>
