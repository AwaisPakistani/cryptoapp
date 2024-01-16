<?php

require "../connection.php";
require '../vendor/autoload.php';

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // All moview query 

    if (isset($_POST['email'])) {

      $email = $_POST['email'];
            // Create the Transport
            $transport = (new Swift_SmtpTransport('invofy.store', 465, 'ssl'))
            ->setUsername('info@invofy.store')
            ->setPassword('invofy@store');

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $message = (new Swift_Message('Crypto Currency      `                                                                                                                                                                                                                                                                                                                             '))
            ->setFrom(['info@invofy.store' =>'Subscription' ])
            ->setTo([$email => 'Recipient Name'])
            ->setBody('You have subscribed successfully', 'text/html')
            ->addPart('This is the plain text version for non-HTML mail clients', 'text/plain');

            // Send the message
            $result = $mailer->send($message);

            if ($result) {
            echo 'Message has been sent';
            } else {
            echo 'Message could not be sent';
            }
      
      // end mail
      
    } else {
      echo "email is required ";
      exit();
    }
   
    
    //$remember_token = mt_rand(100000, 999999);



    $created_at = date("Y-m-d h:i:sa");
   

    $updated_at = date("Y-m-d h:i:sa");

  
    $sql = "INSERT INTO subscribers (email,created_at, updated_at)
    VALUES ('$email','$created_at','$updated_at')";
                  
    if ($conn->query($sql) === TRUE) {
                    echo "You have subscribed successfully";
    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
    }
          
    $conn->close();
  }else{
    echo "Method is not post";
  }
 
?>
