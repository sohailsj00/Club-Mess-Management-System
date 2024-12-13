<?php
try {
    // Check if 'file' parameter is set
    if(isset($_GET['file'])) {
        // File name from GET parameter
        $filename = $_GET['file'];

        // Verify if file exists and is safe to include
        if(file_exists($filename)) {
            // Headers for download
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; Filename=Data.xls");

            // Include the file
            include $filename;
        } else {
            echo "File not found.";
        }
    } else {
        echo "File parameter is not set.";
    }


} catch (Exception $e) {
    // Error handling
    echo "Error: ".$e->getMessage();
}
?>
