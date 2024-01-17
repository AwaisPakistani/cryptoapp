<?php

require "../connection.php";
require '../vendor/autoload.php';

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // All moview query
      if (isset( $_GET['stock_id'])) {
                    $id = $_GET['stock_id'];
                    $sql_stock = "SELECT * FROM stocks WHERE id='$id'";
                    $result_stock = $conn->query($sql_stock);
                    // for fetching channel name
                    $row_stock = $result_stock->fetch_all(MYSQLI_ASSOC);
                  
                if ($result_stock->num_rows > 0) {
                     if (isset( $_POST['symbol'])) {
                        $symbol = $_POST['symbol'];
                      } else {
                        $symbol= $row_stock[0]['symbol'];
                      }
                      if (isset( $_POST['company_name'])) {
                        $company_name = $_POST['company_name'];
                      } else {
                        $company_name= $row_stock[0]['company_name'];
                      }
                      if (isset( $_POST['risk_level'])) {
                        
                        if ($_POST['risk_level']=='high' || $_POST['risk_level']=='mid' || $_POST['risk_level']=='low') {
                          $risk_level = $_POST['risk_level'];
                        } else {
                          echo "Rish level selected should be high, mid or low ";
                          exit();
                        }
                      } else {
                        $risk_level= $row_stock[0]['risk_level'];
                      }
                         
                      if (isset($_POST['signal_type'])) {  
                            if ($_POST['signal_type']=='long' || $_POST['signal_type']=='small') {
                              $signal_type = $_POST['signal_type'];
                            } else {
                              echo "Signal Type selected should be long or small ";
                              exit();
                            }
                        
                      } else {
                        $signal_type= $row_stock[0]['signal_type'];
                      }    
                      if (isset( $_POST['target_price'])) {
                        $target_price = $_POST['target_price'];
                      } else {
                        $target_price= $row_stock[0]['target_price'];
                      }
                      if (isset( $_POST['stop_loss_price'])) {
                        $stop_loss_price = $_POST['stop_loss_price'];
                      } else {
                        $stop_loss_price = $row_stock[0]['stop_loss_price'];
                      }
                     
                      if (isset( $_POST['additional_comments'])) {
                        $additional_comments = $_POST['additional_comments'];
                      } else {
                        $additional_comments = $row_stock[0]['additional_comments'];
                      } // strategy_tag
                      if (isset( $_POST['visibility_settings'])) {
                        $visibility_settings = $_POST['visibility_settings'];
                      } else {
                        $visibility_settings = $row_stock[0]['visibility_settings'];
                      }

                      if (isset( $_POST['change_percent'])) {
                        $change_percent = $_POST['change_percent'];
                      } else {
                        $change_percent = $row_stock[0]['change_percent'];
                      }

                      if (isset( $_POST['volume'])) {
                        $volume = $_POST['volume'];
                      } else {
                        $volume = $row_stock[0]['volume'];
                      }

                      if (isset( $_POST['market_cap'])) {
                        $market_cap = $_POST['market_cap'];
                      } else {
                        $market_cap = $row_stock[0]['market_cap'];
                      }
                    
                     
                      $updated_at = date("Y-m-d h:i:sa");
                      if (isset($_FILES['stock_image']['name'])) {

                        $path=$row_stock[0]['image'];
                        if($path!=null){
                            if(file_exists($path)){
                                unlink($path);

                            }else{
                                echo "file does not exists<br>";
                            }
                        }

                        $filename = $_FILES["stock_image"]["name"];
                        $tempname = $_FILES["stock_image"]["tmp_name"];  
                        $folder = "stocks_images/".$filename;  
                        if (move_uploaded_file($tempname, $folder)) {
                          echo "File uploaded successfully";
                        }else{
                          echo "File could not uploaded";
                        }
                      }else{
                        $folder = $row_stock[0]['image'];
                      }
                      $sql = "UPDATE stocks SET symbol='$symbol',company_name='$company_name',image='$folder', risk_level='$risk_level', signal_type='$signal_type',target_price='$target_price',stop_loss_price='$stop_loss_price',additional_comments='$additional_comments',visibility='$visibility_settings', 
                      change_percent='$change_percent', 
                      volume='$volume', 
                      market_cap='$market_cap', 
                      updated_at='$updated_at' WHERE id= '$id'";
                    
                      if ($conn->query($sql) === TRUE) {
                            $admin_id = $row_stock[0]['admin_id'];

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
                            ->setBody('Dear '.$name.',<br/> your Stock has updated successfully', 'text/html')
                            ->addPart('This is the plain text version for non-HTML mail clients', 'text/plain');

                            // Send the message
                            $result = $mailer->send($message);

                            if ($result) {
                            // echo 'Message has been sent';
                              $result = array("status" => "1", "message" => "Message has been sent and Your Stock updated successfully");
                            } else {
                            // echo 'Message could not be sent';
                              $result = array("status" => "1", "message" => "Message could not be sent but Your Stock created successfully");
                            }
                        
                      } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                      }


                } else {
                    $result = array("status" => "0", "message" => "Stock not found");
                }
      } else {
        echo "Stock id is required ";
        exit();
      }
  }else{
    $result = array("status" => "0", "message" => "Request is not post");
  }
  echo json_encode($result);
  $conn->close();
?>
