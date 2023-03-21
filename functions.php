<?php
function check_login($conn){

  if(isset($_SESSION['id'])){

    $id= $_SESSION['id'];
    $sql="SELECT * FROM utenti WHERE id='$id' LIMIT 1";

    $result= mysqli_query($conn, $sql);
    if($result && mysqli_num_rows($result)>0){
      $user_data = mysqli_fetch_assoc($result);
      return $user_data;
    }
  }else{
    header("Location:login.php");
    die();
  }
  
 
}