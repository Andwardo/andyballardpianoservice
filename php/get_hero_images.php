<?php
/*
 * get_hero_images.php
 *
 *  Created on: 2025-04-24
 *  Edited on: 2025-04-24
 *      Author: Andwardo
 *      Version: 1.2
 */

$directory = __DIR__ . '/../images/hero';
$images = glob($directory . '/*.jpeg');

$imageUrls = array_map(function($imgPath) {
    return str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath($imgPath));
}, $images);

header('Content-Type: application/json');
echo json_encode($imageUrls);
?>