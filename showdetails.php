<?php
$con = mysqli_connect("localhost", "root", "", "bookinfo");
$id = $_GET['id'];
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
                    <h2>Details of : <?php echo $result['name']; ?></h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <form action="" method="post" class="col-md-12" enctype="multipart/form-data">
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">Name:   </label>
                        <input class="col-md-8" type="text" name="name"  value="<?php echo $result['name']; ?>">

                    </div>
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">author No: </label>
                        <input class="col-md-8" type="text" name="author"  value="<?php echo $result['author']; ?>">

                    </div>
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">Publisher: </label>
                        <input class="col-md-8" type="publisher" name="publisher"  value="<?php echo $result['publisher']; ?>">

                    </div>
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">Depertment:  </label>
                        <input class="col-md-8" type="text" name="depertment"  value="<?php echo $result['depertment']; ?>">
                    </div>
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">Available quantity:  </label>
                        <input class="col-md-8" type="text" name="quantity"  value="<?php echo $result['quantity']; ?>">
                    </div>
                    

                    <div class="sigle-input col-md-12 text-center submit-data">
                        <input class="col-md-2" type="submit" name="update" value="Update">
                        <input class="col-md-2" type="reset" name="reset" value="Reset">
                        <input class="col-md-2" type="submit" name="delete" value="Delete">
                       

                    </div>
                </form>
                <form action="addbs.php" method="get" class="col-md-12">
                <div class="sigle-input col-md-12 text-center submit-data">
                <input type="hidden" name="idd" value="<?php echo $id ?>"><input class="col-md-2" type="submit" value="Assign to a Student">
                </div>
                </form>
              
            </div>
        </div>

        <?php
        
        //Delete        
        
        if (isset($_POST['delete'])) {
             $delete_query = "delete from bookdetails where bookdetails.uid=$id";
              $delete_query1 = "delete from sb where sb.uid=$id";
           

            if (mysqli_query($con, $delete_query)) {
                mysqli_query($con, $delete_query1);
                
                echo "<p class='text-center bg-submit'><b>DELETED SUCCESSFULLY</b></p>";
                header("Refresh:0.5; url=index.php");
            } else {
                echo "<p class='text-center bg-danger'>Error</p>";
            }
            
        }
     
        // Update 

        if (isset($_POST['update'])) {
            $name = $_POST['name'];
            $author = $_POST['author'];
            $publisher = $_POST['publisher'];
             $Catagory = $_POST['depertment'];
            $Quantity = $_POST['quantity'];
          
          

            $update_contact_query = "UPDATE bookdetails SET bookdetails.name = '$name', bookdetails.author = '$author' , bookdetails.publisher = '$publisher',
            bookdetails.quantity= '$Quantity',bookdetails.depertment = '$Catagory' WHERE bookdetails.uid=$id";

            if (!empty($name)) {
                if (mysqli_query($con, $update_contact_query)) {
                    echo "<p class='text-center bg-submit'><b>UPDATED SUCCESSFULLY</b></p>";
                    header("Refresh:0.5; url=showdetails.php?id=$id");
                } else {
                    echo "<p class='text-center bg-danger'>Error</p>";
                }
            }
        }
        ?>


        <?php
        $b = 0;
        $d = 0;
        $i = 0;
        $c = 0;
        //$key = NULL;
        
            //$key = $_POST['name'];
            $con = mysqli_connect("localhost", "root", "", "bookinfo");
            $show_query = "select * from (SELECT *  from student natural join sb)  as result where uid=$id";
            $b = 1;

            $result = mysqli_query($con, $show_query);

            $c = mysqli_num_rows($result);


            while ($row = mysqli_fetch_assoc($result)) {
                $bookdetails[] = $row;
                $i++;
            }


            $serial_no = 0;
        
        ?>




         <!-- Show Data -->
        <div class="container text-center">
            <div class="row">
                <div class="show_data_area col-md-12">
                    <table class="table col-md-12">
                        <tr class="success">
                            <td>#</td>
                            <td>Student name</td>
                            <td>ID</td>
                            
                            <td>Depertment</td>

                            <td>Details</td>
                            <td>Action</td>
                        </tr>



                        <?php
                        if ($i != 0) {
                            foreach ($bookdetails as $book) {
                                $serial_no++;
                                ?>
                                <tr>
                                    <td><?php echo $serial_no; ?></td>                                
                                   
                                    <td align="left"><?php echo $book['sid']; ?></td>
                                    <td align="left"><?php echo $book['Name']; ?></td>
                                    <td align="left"><?php echo $book['Dept']; ?></td>
                                   
                                    
                                    <td><a class="btn btn-success" href="studentinfo.php?id=<?php echo $book['sid']; ?>">Show Details</a></td>
                                     <td><a class="btn btn-success" href="delete.php?id1=<?php echo $book['uid']; ?>&id2=<?php echo $book['sid']; ?>">Delete</a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>  
                    </table>
                </div>
            </div>
        </div>

    </body>
</html>
