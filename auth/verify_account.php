<?php

require "../connection.php";
require '../vendor/autoload.php';

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    if (isset($_POST['verify_token'])) {
        $verify_token = $_POST['verify_token'];
        //echo $verify_token; exit();
    } else {
        echo "Please enter verify token you received in your mail box";
        exit(); 
    }
    // All moview query    
    $sql_all = "SELECT * FROM admins WHERE id='$id' AND verify_token='$verify_token'";
    $result_all = $conn->query($sql_all);
    $row_all = $result_all->fetch_all(MYSQLI_ASSOC); 

    if ($result_all->num_rows > 0) {
          
        $email_verified_at = date("Y-m-d h:i:sa");
        $updated_at = date("Y-m-d h:i:sa");
        $sql = "UPDATE admins SET email_verified_at='$email_verified_at',email_verified_status='1',updated_at='$updated_at' WHERE id='$id'";
        
        if ($conn->query($sql) === TRUE) {
          echo "Your email has verified successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        echo "Token is incorrect";
    }

   
           
    
        
      
    
    $conn->close();
  }else{
    echo "Method is not post";
  }
 
?>
