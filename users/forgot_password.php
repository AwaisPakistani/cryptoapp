<?php
require "../connection.php";
require '../vendor/autoload.php';
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $emailexist_query = "SELECT * FROM users WHERE email='$email'";
            $emailexistance = $conn->query($emailexist_query);
            if ($emailexistance->num_rows > 0) {
               $name = 'Awais'; 
               $encodemail = base64_encode($email);
               $link = "http://localhost/crypto/users/confirm_password.php?code=".$encodemail;
                // send mail 
                        $transport = (new Swift_SmtpTransport('invofy.store', 465, 'ssl'))
                        ->setUsername('info@invofy.store')
                        ->setPassword('invofy@store');

                        // Create the Mailer using your created Transport
                        $mailer = new Swift_Mailer($transport);

                        // Create a message
                        $message = (new Swift_Message('Crypto Reset Password      `                                                                                                                                                                                                                                                                                                                             '))
                        ->setFrom(['info@invofy.store' =>$name ])
                        ->setTo([$email => 'Recipient Name'])
                        ->setBody('Please check your mail to change password<br/><a href='.$link.'>Change Password</a>', 'text/html')
                        ->addPart('This is the plain text version for non-HTML mail clients', 'text/plain');

                        // Send the message
                        $result = $mailer->send($message);

                        if ($result) {
                        echo 'Please check your mail to change password';
                        } else {
                        echo 'Message could not be sent';
                        }
                }
                // end mail
                else{
                $result = array("status" => "0", "message" => "Email does not exist");
                }
          }else{
            $result = array("status" => "0", "message" => "Please enter email");
          }
          
  }else{
    // echo "Method is not post";
    $result = array("status" => "0", "message" => "Method is not post");
  }
  echo json_encode($result);
  $conn->close();
?>
