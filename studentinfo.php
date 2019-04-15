<?php
$con = mysqli_connect("localhost", "root", "", "bookinfo");
$id = $_GET['id'];
$show_user = "select * from (SELECT *  from student) as result where sid=$id";
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
                    <h2>Details of :<?php echo $result['Name']; ?></h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <form action="" method="post" class="col-md-12" enctype="multipart/form-data">
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">Name:   </label>
                        <input class="col-md-8" type="text" name="name"  value="<?php echo $result['Name']; ?>">

                    </div>
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">ID: </label>
                        <input class="col-md-8" type="text" name="id"  value="<?php echo $result['sid']; ?>">

                    </div>
                   
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">Depertment:  </label>
                        <input class="col-md-8" type="text" name="depertment"  value="<?php echo $result['Dept']; ?>">
                    </div>
                   
                    

                    <div class="sigle-input col-md-12 text-center submit-data">
                        <input class="col-md-2" type="submit" name="update" value="Update">
                        <input class="col-md-2" type="reset" name="reset" value="Reset">
                        <input class="col-md-2" type="submit" name="delete" value="Delete">
                       

                    </div>
               
              
            </div>
        </div>

        <?php
        
        //Delete        
        
        if (isset($_POST['delete'])) {
             $delete_query = "delete from student where student.sid=$id";
             $delete_query1 = "delete from sb where sb.sid=$id";
           

            if (mysqli_query($con, $delete_query)) {
                
                echo "<p class='text-center bg-submit'><b>DELETED SUCCESSFULLY</b></p>";
                header("Refresh:0.5; url=index.php");
            } else {
                echo "<p class='text-center bg-danger'>Error</p>";
            }
            
        }
     
        // Update 

        if (isset($_POST['update'])) {
            $name = $_POST['name'];
            $id = $_POST['id'];
            
             $Catagory = $_POST['depertment'];
       
          
          

            $update_contact_query = "UPDATE student SET student.Name = '$name', student.sid = '$id' , 
            student.Dept = '$Catagory' WHERE student.sid=$id";

            if (!empty($name)) {
                if (mysqli_query($con, $update_contact_query)) {
                    echo "<p class='text-center bg-submit'><b>UPDATED SUCCESSFULLY</b></p>";
                    header("Refresh:0.5; url=studentinfo.php?id=$id");
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
            $show_query = "select * from (SELECT *  from bookdetails natural join sb)  as result where sid=$id";
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
                            <td>Name</td>
                            <td>Author</td>
                            <td>Publisher</td>
                            <td>Depertment</td>
                            

<td>details</td>

                            <td>Action</td>
                        </tr>



                        <?php
                        if ($i != 0) {
                            foreach ($bookdetails as $book) {
                                $serial_no++;
                                ?>
                                   <tr>
                                    <td><?php echo $serial_no; ?></td>                                
                                    <td align="left"><?php echo $book['name']; ?></td>
                                    <td align="left"><?php echo $book['author']; ?></td>
                                    <td align="left"><?php echo $book['publisher']; ?></td>
                                    <td align="left"><?php echo $book['depertment']; ?></td>
                                    
                                    
                                    <td><a class="btn btn-success" href="showdetails.php?id=<?php echo $book['uid']; ?>">Show Details</a></td>
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
