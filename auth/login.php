<?php
require "../connection.php";
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          if (isset($_POST['email'])) {
            $email = $_POST['email'];
          } else {
            echo "Please enter email";
            exit();
          }
          if (isset($_POST['password'])) {
            $password = $_POST['password'];
          } else {
            echo "Please enter password";
            exit();
          }
          
          
          
          //$currentdatatime = date("Y/m/d");
         
          $sql = "SELECT * FROM admins WHERE email= '$email'";
          
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {

            $sql2 = "SELECT * FROM admins WHERE email= '$email' AND email_verified_status= '1'";
            $result2 = $conn->query($sql2);
            if ($result2->num_rows > 0) {
                   // output data of each row
                       // output data of each row
                $row = $result->fetch_all(MYSQLI_ASSOC);
                $password_hashed = $row[0]['password'];
                if(password_verify($_POST['password'],$password_hashed)){
                  $result = array("status" => "1", "message" => "Login successfully", "data" => $row);
                }else{
                  $result = array("status" => "0", "message" => "Password is incorrect");
                }
            }else{
              $result = array("status" => "0", "message" => "Please verify your email");
            }  


            
          } else {
              $result = array("status" => "0", "message" => "Email does not exist");
          }
          echo json_encode($result);
          $conn->close();
  }else{
    echo "Method is not post";
  }
 
?>
