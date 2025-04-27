<?php
/*
 * get_hero_images.php
 *
 *  Created on: 2025-04-24
 *  Edited on: 2025-04-26
 *      Author: Andwardo
 *      Version: 1.3
 */

$directory = __DIR__ . '/../images/hero'; // Hero images directory
$images = glob($directory . '/*.png');     // Grab all .png images

$imageUrls = array_map(function($imgPath) {
    $relativePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath($imgPath));
    $relativePath = str_replace('\\', '/', $relativePath); // For Windows servers
    return $relativePath;
}, $images);

header('Content-Type: application/json');
echo json_encode($imageUrls);
?>