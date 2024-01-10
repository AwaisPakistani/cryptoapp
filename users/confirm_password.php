<?php
require "../connection.php";
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $code= $_GET['code'];
          $email=base64_decode($code);
          $sql_all = "SELECT * FROM users WHERE email='$email'";
          $result_all = $conn->query($sql_all);
          $row_all = $result_all->fetch_all(MYSQLI_ASSOC); 
          
          if (isset($_POST['password'])) {
           
           
            if (isset($_POST['retype'])) {
              $pass = $_POST['password'];
              $retype_pass = $_POST['retype'];
              if ($pass!=$retype_pass) {
                $result = array("status" => "0", "message" => "Passwords are not matching");
              }else{
                  $password=password_hash($pass, PASSWORD_DEFAULT);
                  //$currentdatatime = date("Y/m/d");
                  $sql = "SELECT * FROM users WHERE email='$email'";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                      // output data of each row
                      $row = $result->fetch_all(MYSQLI_ASSOC);
                      
                      $updated_at = date("Y-m-d h:i:sa");
                      $sql1 = "UPDATE admins SET password='$password',updated_at='$updated_at' WHERE email='$email'";
                
                      if ($conn->query($sql1) === TRUE) {
                          echo "Password updated successfully";
                      } else {
                          echo "Error: " . $sql . "<br>" . $conn->error;
                      }
       
                    } else {
                        $result = array("status" => "0", "message" => "Records are empty");
                    }
                   
              }
              
            } else{
              // echo "Please retype password";
              // exit();
              $result = array("status" => "0", "message" => "Please enter re-type password");
            }
          } else{
            // echo "password is required ";
            // exit();
            $result = array("status" => "0", "message" => "Password is required");
          }
  }else{
    // echo "Method is not post";
    $result = array("status" => "0", "message" => "Method is not post");
  }
  echo json_encode($result);
  $conn->close();
?>
