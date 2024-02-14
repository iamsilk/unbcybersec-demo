<?php

// Get the cat parameter
$catName = $_GET['cat'];

// Define the path to the images directory
$imagesDirectory = '/cats/';

// Construct the full path to the cat image
$catImagePath = $imagesDirectory . $catName;

// Set the appropriate content type for PNG images
header('Content-Type: image/png');

// Output the image (or default image if not found)
readfile($catImagePath);

?>
