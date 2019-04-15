<?php
$con = mysqli_connect("localhost", "root", "", "bookinfo");
$id = $_GET['idd'];
$show_user = "select * from (SELECT *  from bookdetails) as result where uid=$id";
$result = mysqli_query($con, $show_user)->fetch_assoc();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>BAUST Library</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
         <link rel="icon" href="css/fav.png" type="image/gif">
    </head>
    <body>
        <!-- Header Area -->
        <div class="container text-center">
            <div class="row">
                
                <div class="header col-md-12">
                    <a href="index.php"><h1>Library Management</h1></a>
                </div>
            </div>
        </div>


        <div class="container text-center">
            <div class="row">
                <div class="head_page col-md-12">
                    <h2>Add New Book Info</h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <form action="" method="post" class="col-md-12"  enctype="multipart/form-data">
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">ID: <font color="teal"><i>*(required)</i></font></label>
                        <input class="col-md-8" type="text" name="sid" placeholder="Student id">
                    </div>
                     <div class="sigle-input col-md-12">
                        <label class="col-md-3">Date : <font color="teal"><i>*(required)</i></font></label>
                        <input class="col-md-8" type="date" name="day">
                    </div>
                    <div class="sigle-input col-md-12 text-center submit-data">
                        <input class="col-md-2" type="submit" name="submit" value="Save">
                        <input class="col-md-2" type="reset" value="Reset">
                    </div>
                </form>
            </div>
        </div>



        <?php
        $fk = 1;
        $submit = NULL;
        
//Insert
        
        if (isset($_POST['submit'])) {
           
            $sid = $_POST['sid'];
             $day = $_POST['day'];
             // $Quantity = $result2['quantity'];

//$Quantity--;
            
            
           

            $con = mysqli_connect("localhost", "root", "", "bookinfo");
            $query = "INSERT INTO sb (uid,sid,day) VALUES ('$id','$sid','$day') ";
            $query1 = "select * from (SELECT *  from sb) as result2 where uid=$id and sid=$sid";

           //$update_contact_query = "UPDATE bookdetails bookdetails.quantity= '$Quantity' WHERE bookdetails.uid=$id";
             $result2 = mysqli_query($con, $query1);
             $row = mysqli_fetch_assoc($result2);
             if($row){
                 echo "<p class='text-center bg-submit'><b>Already Inserted!!!</b></p>";
                  header("Refresh:0.5; url=index.php");

             }
            


             elseif (!empty($id) ) {
                $result = mysqli_query($con, $query);
                
                if ($result ) {
//mysqli_query($con, $update_contact_query);
                    $fk = 0;
                } else
                    echo "<p class='text-center bg-danger'>Not Inserted!</p>";
            } else
                echo "<p class='text-center bg-danger'>Error!</p>";

            if ($fk == 0) {
               echo "<p class='text-center bg-submit'><b>INSERTED SUCCESSFULLY</b></p>";
            header("Refresh:0.5; url=index.php");

            }
        }
        ?>
        
       


    </body>
</html>