<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/rhythmdance/includes/db.inc.php';

try {
    $sql = 'SELECT style_id, style_name, description, image
      FROM dance_styles';
    $result = $pdo->query($sql);
   
} catch (PDOException $e) {
    $error = 'Error fetching dancestyles: ' . $e->getMessage();
    echo $error;
    exit();
}



foreach ($result as $row) {
    $dancestyles[] = array(
        'style_id' => $row['style_id'],
        'description' => $row['description'],
        'style_name' => $row['style_name'],
        'image' => $row['image']
    );
}

// Quick test output — skip the HTML file for now


include 'dancestyle.html.php';
