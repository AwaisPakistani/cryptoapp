<?php

require "../connection.php";
require '../vendor/autoload.php';

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        echo "Subscriber id required";
        exit();
    }
    
    // All moview query    
    $sql_all = "SELECT * FROM subscribers WHERE id='$id'";
    $result_all = $conn->query($sql_all);
    $row_all = $result_all->fetch_all(MYSQLI_ASSOC); 

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $sql_mail = "SELECT * FROM subscribers WHERE email='$email'";
        $result_mail = $conn->query($sql_mail);
        if ($result_mail->num_rows > 0) {
          echo "Email already exists";
          exit();
        }
        
    } else {
        $email=$row_all[0]['email']; 
    }
    //$remember_token = mt_rand(100000, 999999);
    $updated_at = date("Y-m-d h:i:sa");

     $sql = "UPDATE subscribers SET email='$email',updated_at='$updated_at' WHERE id='$id'";
            
    if ($conn->query($sql) === TRUE) {
              echo "Email updated successfully";
    } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }else{
    echo "Method is not post";
  }
 
?>
