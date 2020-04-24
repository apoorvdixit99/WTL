<?php 

        $link = mysqli_connect("localhost","apoorv","Ubuntu@123456","wtlphp5") or die($link);

        $registrationid = $_POST["registrationid"];

        $query = "SELECT * FROM userdetails WHERE registrationid='$registrationid'";
        $result  = mysqli_query($link, $query);
        $rowcount = mysqli_num_rows($result);

        if($rowcount>0) {
            echo "Already Exists";
        }
?>