<?php

require "../connection.php";
require '../vendor/autoload.php';

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // All moview query 
    
      if (isset( $_GET['admin_id'])) {
                    $id = $_GET['admin_id'];
                    $sql_user = "SELECT id,channel_name FROM admins WHERE id='$id'";
                    $result_user = $conn->query($sql_user);
                    // for fetching channel name
                    $row_user = $result_user->fetch_all(MYSQLI_ASSOC);
                  
                    $channel_name= $row_user[0]['channel_name'];
                    // for fetching channel name end
                if ($result_user->num_rows > 0) {
                    // output data of each row
                    // $row = $result->fetch_all(MYSQLI_ASSOC);
                    $admin_id = $_GET['admin_id'];
                    if (isset( $_POST['coin_name'])) {
                        $coin_name = $_POST['coin_name'];
                      } else {
                        echo "coin name required ";
                        exit();
                      }
                      if (isset( $_POST['risk_level'])) {
                        
                        if ($_POST['risk_level']=='high' || $_POST['risk_level']=='mid' || $_POST['risk_level']=='low') {
                          $risk_level = $_POST['risk_level'];
                        } else {
                          echo "Rish level selected should be high, mid or low ";
                          exit();
                        }
                      } else {
                        echo "risk level required ";
                        exit();
                      }
                         
                      if (isset($_POST['signal_type'])) {  
                            if ($_POST['signal_type']=='long' || $_POST['signal_type']=='small') {
                              $signal_type = $_POST['signal_type'];
                            } else {
                              echo "Signal Type selected should be long or small ";
                              exit();
                            }
                        
                          
                      } else {
                        echo "signal type is required ";
                        exit();
                      }    
                      $created_at = date("Y-m-d h:i:sa");
                     
                  
                      $updated_at = date("Y-m-d h:i:sa");

                      $sql = "INSERT INTO signals (admin_id,coin_name, risk_level, signal_type,channel_name,created_at, updated_at)
                      VALUES ('$admin_id','$coin_name','$risk_level', '$signal_type','$channel_name','$created_at','$updated_at')";
                      
                      if ($conn->query($sql) === TRUE) {
                           
                            $sql_all = "SELECT * FROM admins WHERE id='$id'";
                            $result_all = $conn->query($sql_all);
                            $row_all = $result_all->fetch_all(MYSQLI_ASSOC); 
                            $name = $row_all[0]['name'];
                            $email = $row_all[0]['email'];
                                 // Create the Transport
                            $transport = (new Swift_SmtpTransport('invofy.store', 465, 'ssl'))
                            ->setUsername('info@invofy.store')
                            ->setPassword('invofy@store');

                            // Create the Mailer using your created Transport
                            $mailer = new Swift_Mailer($transport);

                            // Create a message
                            $message = (new Swift_Message('Crypto Signal creation      `                                                                                                                                                                                                                                                                                                                             '))
                            ->setFrom(['info@invofy.store' =>$name ])
                            ->setTo([$email => 'Recipient Name'])
                            ->setBody('Dear '.$name.',<br/> your signal has created successfully', 'text/html')
                            ->addPart('This is the plain text version for non-HTML mail clients', 'text/plain');

                            // Send the message
                            $result = $mailer->send($message);

                            if ($result) {
                            // echo 'Message has been sent';
                              $result = array("status" => "1", "message" => "Message has been sent and Your signal created successfully");
                            } else {
                            // echo 'Message could not be sent';
                              $result = array("status" => "1", "message" => "Message could not be sent but Your signal created successfully");
                            }
                        
                      } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                      }


                } else {
                    $result = array("status" => "0", "message" => "Admin not found");
                }
      } else {
        echo "Admin id is required ";
        exit();
      }

  }else{
    $result = array("status" => "0", "message" => "Request is not post");
  }
  echo json_encode($result);
  $conn->close();
?>
