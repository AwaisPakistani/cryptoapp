<?php

require "../connection.php";
require '../vendor/autoload.php';

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // All moview query 

    if (isset( $_POST['name'])) {
      $name = $_POST['name'];
    } else {
      echo "name required ";
      exit();
    }
    $verify_token = mt_rand(100000,199999);
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $emailexist_query = "SELECT * FROM users WHERE email='$email'";
        $emailexistance = $conn->query($emailexist_query);
        if ($emailexistance->num_rows > 0) {
          echo "Email already exists";
          exit();
        }
        else{ 
                        // Create the Transport
              $transport = (new Swift_SmtpTransport('invofy.store', 465, 'ssl'))
              ->setUsername('info@invofy.store')
              ->setPassword('invofy@store');
  
              // Create the Mailer using your created Transport
              $mailer = new Swift_Mailer($transport);
  
              // Create a message
              $message = (new Swift_Message('Crypto User Registration      `                                                                                                                                                                                                                                                                                                                             '))
              ->setFrom(['info@invofy.store' =>$name ])
              ->setTo([$email => 'Recipient Name'])
              ->setBody('You have registered successfully!</b>Use this token<b> '.$verify_token.' </b>to verify account', 'text/html')
              ->addPart('This is the plain text version for non-HTML mail clients', 'text/plain');
  
              // Send the message
              $result = $mailer->send($message);
  
              if ($result) {
              echo 'Message has been sent';
              } else {
              echo 'Message could not be sent';
              }
        }
        // end mail
        
      } else {
        echo "email is required ";
        exit();
      }
    
    if (isset($_POST['password'])) {
      $pass = $_POST['password'];
      $password=password_hash($pass, PASSWORD_DEFAULT);
    } else {
      echo "password is required ";
      exit();
    }
    if (isset($_POST['phone'])) {
      $phone = $_POST['phone'];
    } else {
      echo "phone is required ";
      exit();
    }
    if (isset($_POST['notification_preferences'])) {
        $notification_preferences = $_POST['notification_preferences'];
    } else {
        $notification_preferences = '';
    }
    if (isset($_POST['linked_bank_account'])) {
        $linked_bank_account = $_POST['linked_bank_account'];
    } else {
        $linked_bank_account = '';
    }
    if (isset($_POST['portfolio_overview'])) {
        $portfolio_overview = $_POST['portfolio_overview'];
    } else {
        $portfolio_overview = '';
    }
    // portfolio_overview
   
     
   
    if (isset($_FILES["profile_picture"]["name"])) {
      // Image
      $filename = $_FILES["profile_picture"]["name"];
      $tempname = $_FILES["profile_picture"]["tmp_name"];  
    } else {
      echo "profile picture image is required ";
      exit();
    }
   
   
    //   $thumbnail = $_POST['thumbnail'];
    
    
    $account_balance = 0;

    //$remember_token = mt_rand(100000, 999999);

    $created_at = date("Y-m-d h:i:sa");
   

    $updated_at = date("Y-m-d h:i:sa");
   
    
    $folder = "profiles/".$filename;  

    // $sql = "SELECT * FROM categories WHERE id= '$category_id'";
    // $result = $conn->query($sql);
    
    // if ($result->num_rows > 0) {
                // output data of each row
                if (move_uploaded_file($tempname, $folder)) {
  
                  $sql = "INSERT INTO users (name,email, email_verified_at,email_verified_status, password, profile_picture, phone ,notification_preferences, portfolio_overview,verify_token, created_at, updated_at)
                  VALUES ('$name','$email','','0', '$password', '$folder','$phone','$notification_preferences','$portfolio_overview','$verify_token','$created_at','$updated_at')";
                  
                  if ($conn->query($sql) === TRUE) {
                    echo "User created successfully";
                  } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
          
              }else{
          
                  echo "Image does not uploaded";
          
              }
            
    // }else {
    //             $result = array("status" => "0", "message" => "Category not found");
    //             echo json_encode($result);
    // }
   
    
  
    
    $conn->close();
  }else{
    echo "Method is not post";
  }
 
?>
