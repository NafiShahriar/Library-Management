<?php
$con = mysqli_connect("localhost", "root", "", "bookinfo");
$bid = $_GET['id1'];
$sid = $_GET['id2'];


 $delete_query = "delete from sb where sb.uid=$bid AND sb.sid=$sid";
 if (mysqli_query($con, $delete_query)) {
                
                echo "<p class='text-center bg-submit'><b>DELETED SUCCESSFULLY</b></p>";
                header("Refresh:0.5; url=index.php");
            } else {
                echo "<p class='text-center bg-danger'>Error</p>";
            }