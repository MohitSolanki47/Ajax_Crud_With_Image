<?php
  // get form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $image = $_FILES['image']['name'];
  $tmp_name = $_FILES['image']['tmp_name'];
  $folder = 'C:/xampp/htdocs/Ajax_Crud_With_file/';
    
  // move uploaded image to server
  move_uploaded_file($tmp_name, $folder.$image);
  $File_Path = 'C:/xampp/htdocs/Ajax_Crud_With_file/'.$image;
    //   echo $tmp_name;
    //   exit();
    // insert data into database
  $conn = mysqli_connect('localhost', 'root', '', 'ajax_crud'); // ajax_crud Is a Database Name
  $sql = "INSERT INTO User_Table (User_name, User_Email, File_Path) VALUES ('$name', '$email', '$File_Path')"; // User_Table Is a Table Name
  mysqli_query($conn, $sql);
?>
