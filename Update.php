<?php
// Connect to database
$conn = mysqli_connect('localhost', 'username', 'password', 'database');

// Get parameters from AJAX request
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image_data = $_POST['image_data'];

// Decode image data from base64
$image_data = base64_decode($image_data);

// Save image file to server
$file_name = 'image_' . $id . '.png';
$file_path = 'uploads/' . $file_name;
file_put_contents($file_path, $image_data);

// Update data in database
$sql = "UPDATE products SET name='$name', price='$price', image='$file_path' WHERE id=$id";
mysqli_query($conn, $sql);

// Return updated data as JSON
$sql = "SELECT * FROM products WHERE id=$id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

$data['image'] = base64_encode(file_get_contents($data['image']));

header('Content-Type: application/json');
echo json_encode($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Data and Image</title>
</head>
<body>
    <form id="update-form">
        <input type="hidden" name="id" value="1" />
        <label>Name:</label>
        <input type="text" name="name" value="Product 1" />
        <br />
        <label>Price:</label>
        <input type="number" name="price" value="10.99" />
        <br />
        <label>Image:</label>
        <input type="file" name="image" accept="image/*" />
        <br />
        <button type="submit">Update</button>
    </form>
    <div id="container"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>
</html>

<Script>
    $(document).ready(function() {
    // Handle form submission
    $('#update-form').submit(function(event) {
        event.preventDefault();
        var form_data = new FormData(this);
        $.ajax({
            url: 'update_data.php',
            type: 'POST',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                var container = $('#container');
                var image = '<img src="data:image/png;base64,' + data.image + '" />';
                var name = '<h3>' + data.name + '</h3>';
                var price = '<p>' + data.price + '</p>';
                container.html(image + name + price);
            }
        });
    });
});
</Script>