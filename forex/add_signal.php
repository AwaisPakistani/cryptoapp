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
                    $sql_user = "SELECT id,name,channel_name FROM admins WHERE id='$id'";
                    $result_user = $conn->query($sql_user);
                    // for fetching channel name
                    $row_user = $result_user->fetch_all(MYSQLI_ASSOC);
                  
                    $channel_name= $row_user[0]['channel_name'];
                    $admin_name= $row_user[0]['name'];
                    // for fetching channel name end
                if ($result_user->num_rows > 0) {
                    // output data of each row
                    // $row = $result->fetch_all(MYSQLI_ASSOC);
                    $admin_id = $_GET['admin_id'];
                    if (isset( $_POST['pair_name'])) {
                        $pair_name = $_POST['pair_name'];
                      } else {
                        echo "Pair name required ";
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
                      if (isset( $_POST['target_price'])) {
                        $target_price = $_POST['target_price'];
                      } else {
                        echo "Target Price required ";
                        exit();
                      }
                      
                      if (isset( $_POST['stop_loss_price'])) {
                        $stop_loss_price = $_POST['stop_loss_price'];
                      } else {
                        $stop_loss_price = '';
                      }
                    
                      if (isset( $_POST['signal_strength'])) {
                        
                        if ($_POST['signal_strength']=='high' || $_POST['signal_strength']=='medium' || $_POST['signal_strength']=='low') {
                          $signal_strength = $_POST['signal_strength'];
                        } else {
                          echo "Signal Strength selected should be high, medium or low ";
                          exit();
                        }
                      } else {
                        $signal_strength = '';
                      }
                      
                      if (isset( $_POST['additional_comments'])) {
                        $additional_comments = $_POST['additional_comments'];
                      } else {
                        $additional_comments = '';
                      } // strategy_tag
                      

                      if (isset( $_POST['visibility_settings'])) {
                        
                        if ($_POST['visibility_settings']=='true' || $_POST['visibility_settings']=='false') {
                          $visibility_settings = $_POST['visibility_settings'];
                        } else {
                          echo "Visibility selected should be just true or false ";
                          exit();
                        }
                      } else {
                        echo "Visibility required ";
                        exit();
                      }

                      $created_at = date("Y-m-d h:i:sa");
                     
                  
                      $updated_at = date("Y-m-d h:i:sa");

                      if (isset($_FILES['signal_image']['name'])) {
                        $filename = $_FILES["signal_image"]["name"];
                        $tempname = $_FILES["signal_image"]["tmp_name"];  
                        $folder = "images/".$filename;  
                        if (move_uploaded_file($tempname, $folder)) {
                          echo "File uploaded successfully";
                        }else{
                          echo "File could not uploaded";
                        }
                      } else {
                        $folder ='';
                      }
                      

                      $sql = "INSERT INTO forex (admin_id,admin_name,pair_name,image, risk_level, signal_type,channel_name,target_price,stop_loss_price,additional_comments,visibility,created_at, updated_at)
                      VALUES ('$admin_id','$admin_name','$pair_name','$folder','$risk_level', '$signal_type','$channel_name','$target_price','$stop_loss_price','$additional_comments','$visibility_settings','$created_at','$updated_at')";
                      
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
