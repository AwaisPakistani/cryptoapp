<?php

require "../connection.php";
require '../vendor/autoload.php';

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // All moview query
    
      if (isset( $_GET['signal_id'])) {
                    $id = $_GET['signal_id'];
                    $sql_signal = "SELECT * FROM signals WHERE id='$id'";
                    $result_signal = $conn->query($sql_signal);
                    // for fetching channel name
                    $row_signal = $result_signal->fetch_all(MYSQLI_ASSOC);
                  
                   // $channel_name= $row_signal[0]['channel_name'];
                    // for fetching channel name end
                if ($result_signal->num_rows > 0) {
                    // output data of each row
                    // $row = $result->fetch_all(MYSQLI_ASSOC);
                   
                     if (isset( $_POST['coin_name'])) {
                        $coin_name = $_POST['coin_name'];
                      } else {
                        $coin_name= $row_signal[0]['coin_name'];
                      }
                      if (isset( $_POST['risk_level'])) {
                        
                        if ($_POST['risk_level']=='high' || $_POST['risk_level']=='mid' || $_POST['risk_level']=='low') {
                          $risk_level = $_POST['risk_level'];
                        } else {
                          echo "Rish level selected should be high, mid or low ";
                          exit();
                        }
                      } else {
                        $risk_level= $row_signal[0]['risk_level'];
                      }
                         
                      if (isset($_POST['signal_type'])) {  
                            if ($_POST['signal_type']=='long' || $_POST['signal_type']=='small') {
                              $signal_type = $_POST['signal_type'];
                            } else {
                              echo "Signal Type selected should be long or small ";
                              exit();
                            }
                        
                          
                      } else {
                        $signal_type= $row_signal[0]['signal_type'];
                      }    
                      if (isset( $_POST['target_price'])) {
                        $target_price = $_POST['target_price'];
                      } else {
                        $target_price= $row_signal[0]['target_price'];
                      }
                      if (isset( $_POST['stop_loss_price'])) {
                        $stop_loss_price = $_POST['stop_loss_price'];
                      } else {
                        $stop_loss_price = $row_signal[0]['stop_loss_price'];
                      }
                      if (isset( $_POST['take_profit_price'])) {
                        $take_profit_price = $_POST['take_profit_price'];
                      } else {
                        $take_profit_price = $row_signal[0]['take_profit_price'];
                      }
                      if (isset( $_POST['signal_strength'])) {
                        
                        if ($_POST['signal_strength']=='high' || $_POST['signal_strength']=='medium' || $_POST['signal_strength']=='low') {
                          $signal_strength = $_POST['signal_strength'];
                        } else {
                          echo "Signal Strength selected should be high, medium or low ";
                          exit();
                        }
                      } else {
                        $signal_strength = $row_signal[0]['signal_strength'];
                      }
                      if (isset( $_POST['validity_period'])) {
                        $validity_period = $_POST['validity_period'];
                      } else {
                        $signal_strength = $row_signal[0]['signal_strength'];
                      }
                      if (isset( $_POST['additional_comments'])) {
                        $additional_comments = $_POST['additional_comments'];
                      } else {
                        $additional_comments = $row_signal[0]['additional_comments'];
                      } // strategy_tag
                      if (isset( $_POST['visibility_settings'])) {
                        $visibility_settings = $_POST['visibility_settings'];
                      } else {
                        $visibility_settings = $row_signal[0]['visibility_settings'];
                      }
                      if (isset( $_POST['strategy_tag'])) {
                        $strategy_tag = $_POST['strategy_tag'];
                      } else {
                        $strategy_tag = $row_signal[0]['strategy_tag'];
                      }
                      if (isset( $_POST['charts_anaylysis'])) {
                        $charts_anaylysis = $_POST['charts_anaylysis'];
                      } else {
                        $charts_anaylysis = $row_signal[0]['charts_anaylysis'];
                      }
                     
                      $updated_at = date("Y-m-d h:i:sa");

                      $sql = "UPDATE signals SET coin_name='$coin_name', risk_level='$risk_level', signal_type='$signal_type',target_price='$target_price',stop_loss_price='$stop_loss_price',take_profit_price='$take_profit_price',signal_strength='$signal_strength',validity_period='$validity_period',additional_comments='$additional_comments',visibility_settings='$visibility_settings',strategy_tag='$strategy_tag',charts_anaylysis='$charts_anaylysis', updated_at='$updated_at' WHERE id= '$id'";
                    
                      if ($conn->query($sql) === TRUE) {
                            $admin_id = $row_signal[0]['admin_id'];

                            $sql_all = "SELECT * FROM admins WHERE id='$admin_id'";
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
                            $message = (new Swift_Message('Crypto Signal UPdation      `                                                                                                                                                                                                                                                                                                                             '))
                            ->setFrom(['info@invofy.store' =>$name ])
                            ->setTo([$email => 'Recipient Name'])
                            ->setBody('Dear '.$name.',<br/> your signal has updated successfully', 'text/html')
                            ->addPart('This is the plain text version for non-HTML mail clients', 'text/plain');

                            // Send the message
                            $result = $mailer->send($message);

                            if ($result) {
                            // echo 'Message has been sent';
                              $result = array("status" => "1", "message" => "Message has been sent and Your signal updated successfully");
                            } else {
                            // echo 'Message could not be sent';
                              $result = array("status" => "1", "message" => "Message could not be sent but Your signal created successfully");
                            }
                        
                      } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                      }


                } else {
                    $result = array("status" => "0", "message" => "Signal not found");
                }
      } else {
        echo "Signal id is required ";
        exit();
      }
  }else{
    $result = array("status" => "0", "message" => "Request is not post");
  }
  echo json_encode($result);
  $conn->close();
?>