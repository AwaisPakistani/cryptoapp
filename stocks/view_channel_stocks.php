<?php
require "../connection.php";
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          //$currentdatatime = date("Y/m/d");
          if(isset($_POST['channel'])){
              $channel = $_POST['channel'];
          }
          else{
            echo "please choose name";
            exit();
          }
          $sql = "SELECT * FROM stocks WHERE channel_name='$channel'";
          $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_all(MYSQLI_ASSOC);
                $result = array("status" => "1", "message" => "Records available", "data" => $row);
            } else {
                $result = array("status" => "0", "message" => "Records are empty");
            }
            echo json_encode($result);
            $conn->close();
  }else{
    echo "Method is not post";
  }
 
?>
