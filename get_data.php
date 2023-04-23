<?php
// Connect to database and query data
$conn = mysqli_connect('localhost', 'root', '', 'ajax_crud');
$result = mysqli_query($conn, 'SELECT * FROM User_Table');

$data = array();
// Fetch data and encode image file in base64
while ($row = mysqli_fetch_assoc($result)) {
    
    $image_data = base64_encode(file_get_contents($row['File_Path']));
    // print_r($image_data);
    // exit();
    $row['File_Path'] = $image_data;
    $data[] = $row;
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>

