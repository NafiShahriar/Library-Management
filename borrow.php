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


    

        <?php
        $con = mysqli_connect("localhost", "root", "", "bookinfo");
        $show_query = "SELECT sid,Name,Dept,count(sid) FROM sb natural join student group by sid";

        $result = mysqli_query($con, $show_query);
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
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
                            <td>ID</td>
                            
                            <td>Depertment</td>
                            <td>Quantity</td>



                            <td>Action</td>
                        </tr>


                        <?php
                        if ($i != 0) {
                            foreach ($books as $book) {
                                $serial_no++;
                                ?>
                                <tr>
                                    <td><?php echo $serial_no; ?></td>                                
                                    <td align="left"><?php echo $book['Name']; ?></td>
                                    <td align="left"><?php echo $book['sid']; ?></td>
                                   
                                    <td align="left"><?php echo $book['Dept']; ?></td>
                                    <td align="left"><?php echo $book['count(sid)']; ?></td>
                                    
                                    <td><a class="btn btn-success" href="studentinfo.php?id=<?php echo $book['sid']; ?>">Show Details</a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?> 	
                    </table>
                </div>
            </div>
        </div>

        <script src="js/jquery-1.12.0.min.js"></script>
        <script src="js/scrolltop.js"></script>
        <script src="css/bootstrap/bootstrap.min.js"></script>

    </body>
</html>
