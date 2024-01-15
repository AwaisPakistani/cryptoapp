<?php

require "../connection.php";
require '../vendor/autoload.php';

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    // All moview query    
    $sql_all = "SELECT * FROM admins WHERE id='$id'";
    $result_all = $conn->query($sql_all);
    $row_all = $result_all->fetch_all(MYSQLI_ASSOC); 

    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $name=$row_all[0]['name']; 
    }
    if (isset($_POST['password'])) {
        $pass = $_POST['password'];
        $password=password_hash($pass, PASSWORD_DEFAULT);
    } else {
        $password=$row_all[0]['password']; 
    }
    if (isset($_POST['contact'])) {
        $contact = $_POST['contact'];
    } else {
        $contact=$row_all[0]['contact']; 
    }
    
    if (isset($_POST['email'])) {
      $email = $_POST['email'];
      $emailexist_query = "SELECT * FROM admins WHERE email='$email'";
      $emailexistance = $conn->query($emailexist_query);
      if ($emailexistance->num_rows > 0) {
        echo "Email already exists";
        exit();
      }
      
      // end mail
      
    } else {
        $email=$row_all[0]['email']; 
    }


    if (isset($_POST['channel_name'])) {
      $channel_name = $_POST['channel_name'];
    } else {
        $channel_name=$row_all[0]['channel_name'];
    }
    //$remember_token = mt_rand(100000, 999999);

    $updated_at = date("Y-m-d h:i:sa");
    
    if (isset($_FILES["photo"]["name"])) {
        // Image
        $filename = $_FILES["photo"]["name"];
        $tempname = $_FILES["photo"]["tmp_name"];  
        $folder = "thumbnails/".$filename;  
        if (move_uploaded_file($tempname, $folder)) {
            $updated_at = $row_all[0]['updated_at'];
            $sql = "UPDATE admins SET name='$name',email='$email',contact='$contact',address='$address',password='$password',photo='$folder',role='$role' WHERE id='$id'";
            
            if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
    
        }else{
    
            echo "Image does not uploaded";
    
        }
      } else {
          
          $folder=$row_all[0]['photo']; 
          $exp_filename = explode('/',$folder);
          $file=$exp_filename[1];
          $filename = $file;
          $updated_at = date("Y-m-d h:i:sa");
          $sql = "UPDATE admins SET name='$name',email='$email',contact='$contact',password='$password',photo='$folder',updated_at='$updated_at' WHERE id='$id'";
            
          if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
      }
    
    $conn->close();
  }else{
    echo "Method is not post";
  }
 
?>
