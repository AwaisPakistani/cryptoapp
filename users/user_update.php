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
    $sql_all = "SELECT * FROM users WHERE id='$id'";
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
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
    } else {
        $phone=$row_all[0]['phone']; 
    }
    
    if (isset($_POST['email'])) {
      $email = $_POST['email'];
      $emailexist_query = "SELECT * FROM users WHERE email='$email'";
      $emailexistance = $conn->query($emailexist_query);
      if ($emailexistance->num_rows > 0) {
        echo "Email already exists";
        exit();
      }
      
      // end mail
      
    } else {
        $email=$row_all[0]['email']; 
    }

    //$remember_token = mt_rand(100000, 999999);

    $updated_at = date("Y-m-d h:i:sa");
    
    if (isset($_FILES["profile_picture"]["name"])) {
        $path=$row_all[0]['profile_picture'];
        if($path!=null){
            if(file_exists($path)){
                unlink($path);
            }else{
                echo "file does not exists<br>";
            }
        }
        // Image
        $filename = $_FILES["profile_picture"]["name"];
        $tempname = $_FILES["profile_picture"]["tmp_name"];  
        $folder = "profiles/".$filename;  
        if (move_uploaded_file($tempname, $folder)) {
            $updated_at = $row_all[0]['updated_at'];
            $sql = "UPDATE users SET name='$name',email='$email',phone='$phone',address='$address',password='$password',profile_picture='$folder' WHERE id='$id'";
            
            if ($conn->query($sql) === TRUE) {
              echo "User updated successfully";
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }else{
    
            echo "Image does not uploaded";
    
        }
      } else {
          
          $folder=$row_all[0]['profile_picture']; 
          // $exp_filename = explode('/',$folder);
          // $file=$exp_filename[1];
          // $filename = $file;
          $sql = "UPDATE users SET name='$name',email='$email',phone='$phone', password='$password',photo='$folder' WHERE id='$id'";
            
          if ($conn->query($sql) === TRUE) {
            echo "User updated successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
      }
    
    $conn->close();
  }else{
    echo "Method is not post";
  }
 
?>
