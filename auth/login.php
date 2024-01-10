<?php
require "../connection.php";
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $email = $_POST['email'];
          $password = $_POST['password'];
          //$currentdatatime = date("Y/m/d");
         
          $sql = "SELECT * FROM admins WHERE email= '$email'";
          
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
                // output data of each row
              $row = $result->fetch_all(MYSQLI_ASSOC);
              $password_hashed = $row[0]['password'];
              if(password_verify($_POST['password'],$password_hashed)){
                $result = array("status" => "1", "message" => "Login successfully", "data" => $row);
              }else{
                $result = array("status" => "0", "message" => "Password is incorrect");
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
