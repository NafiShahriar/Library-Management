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
                <div class="input_area col-md-12">
                    <form method="post" action="">
                        <button type="submit" name="refresh_btn">Refresh</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST['refresh_btn'])) {
            header('Location: students.php');
        }
        ?>

        <div class="container text-center">
            <div class="row">
                <div class="head_page col-md-10" align="left">
                    <div class="txt" ><h3>Search By Name: </h3></div>
                </div>
            </div>
        </div>


        <div class="container text-center">
            <div class="row">
                <div class="input_area col-md-12">
                    <form method="post" action="">
                        <input class="col-md-4" type="text" name="name">
                        <button type="submit" name="search_btn1">Search</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row">
                <div class="head_page col-md-12" align="left" >
                    <div class="txt" ><h3>Search By ID: </h3></div>
                </div>
            </div>
        </div>

        <div class="container text-center">
            <div class="row">
                <div class="input_area col-md-12">
                    <form method="post" action="">
                        <input class="col-md-4" type="text" name="author">
                        <button type="submit" name="search_btn2">Search</button>
                    </form>
                </div>
            </div>
        </div>
       
       

        <?php
        $b = 0;
        $d = 0;
        $i = 0;
        $c = 0;
        $key = NULL;
        $rec_limit = 10;

        if (isset($_POST['search_btn1'])) {
            $key = $_POST['name'];
            $con = mysqli_connect("localhost", "root", "", "bookinfo");
            $show_query = "select * from (SELECT *  from student ) as result where name LIKE '%{$key}%'";
            $b = 1;

            $result = mysqli_query($con, $show_query);

            $c = mysqli_num_rows($result);
            


            while ($row = mysqli_fetch_assoc($result)) {
                $bookdetails[] = $row;
                $i++;
            }


            $serial_no = 0;
        }
       
        

        if (isset($_POST['search_btn2'])) {
            $key = $_POST['author'];

            $con = mysqli_connect("localhost", "root", "", "bookinfo");
            $show_query = "select * from (SELECT *  from student ) as result where sid LIKE '%{$key}%'";
            $d = 1;


            if ($result = mysqli_query($con, $show_query)) {
                $c = mysqli_num_rows($result);
                while ($row = mysqli_fetch_assoc($result)) {
                    $bookdetails[] = $row;
                    $i++;
                }
            }


            $serial_no = 0;
        }
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

                            
                            <td>Action</td>
                        </tr>



                        <?php
                       
                        if ($i != 0) {
                            foreach ($bookdetails as $book) {
                                $serial_no++;
                                ?>
                                <tr>
                                    <td><?php echo $serial_no; ?></td>                                
                                    <td align="left"><?php echo $book['Name']; ?></td>
                                    <td align="left"><?php echo $book['sid']; ?></td>
                                   
                                    <td align="left"><?php echo $book['Dept']; ?></td>
                                    
                                    
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
        <?php
        if ($c == NUll && ($key != NULL)) {
            echo "<p class='text-center bg-danger'>Not Found!</p>";
            header("Refresh:0.5; url=students.php");
        }
        ?>
    </body>
</html>