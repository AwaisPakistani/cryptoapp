<?php
require "../connection.php";
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // thumbnails  folder name
  if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
          $id = $_GET['id'];
          $sql = "SELECT * FROM accomodities WHERE id='$id'";
          $result = $conn->query($sql);
          $row = $result->fetch_all(MYSQLI_ASSOC);
          //echo $result->num_rows; exit();
          if ($result->num_rows > 0) {
            // delete reocrd
            $path=$row[0]['image'];
            if($path!=null){
                            if(file_exists($path)){
                                unlink($path);

                            }else{
                                echo "file does not exists<br>";
                            }
            }

            $sql = "DELETE FROM accomodities WHERE id='$id'";
          
            if ($conn->query($sql) === TRUE) {
              echo "Record Deleted successfully";
            } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
          }else{
            echo "Record not available";
          }
  }else{
    echo "Method is not delete";
  }
 
?>
