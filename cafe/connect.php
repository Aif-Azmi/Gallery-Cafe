<?php

$con=new mysqli('localhost','root','','gallery' );

if($con){
    //echo "Connection successful";
}else {
    die(mysqli_error ($con));
}


?>