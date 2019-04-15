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

        <!-- Input Part -->
        <form action="" method="post" class="col-md-12" enctype="multipart/form-data">
            <div class="sigle-input col-md-12 text-center submit-data">
                <input class="col-md-2" type="submit"  name="add_button" value="Add New Book">
                <input class="col-md-2" type="submit"  name="adds_button" value="Add New Student">
                 <input class="col-md-2" type="submit"  name="s_button" value="Student List">
                 <input class="col-md-2" type="submit"  name="b_button" value="Borrowed List">
                <input class="col-md-2" type="submit" name="search_button" value="Search">
            </div>

        </form>

        <?php
        $con = mysqli_connect("localhost", "root", "", "bookinfo");
        $show_query = "SELECT * FROM bookdetails";

        $result = mysqli_query($con, $show_query);
        $i = 0;
        $c = mysqli_num_rows($result);

        if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages = ceil($c / $no_of_records_per_page);
 $show_query1 = "select * from bookdetails LIMIT $offset, $no_of_records_per_page";

$result2 = mysqli_query($con, $show_query1);
            while ($row = mysqli_fetch_assoc($result2)) {
                $books[] = $row;
                $i++;
            }

        $serial_no = 0;


        if (isset($_POST['add_button'])) {
            header('Location: addnew.php');
        }
        if (isset($_POST['adds_button'])) {
            header('Location: adds.php');
        }
         if (isset($_POST['s_button'])) {
            header('Location: students.php');
        }
        if (isset($_POST['b_button'])) {
            header('Location: borrow.php');
        }

        if (isset($_POST['search_button'])) {
            header('Location: search.php');
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
                            <td>Author</td>
                            <td>Publisher</td>
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
                                    <td align="left"><?php echo $book['name']; ?></td>
                                    <td align="left"><?php echo $book['author']; ?></td>
                                    <td align="left"><?php echo $book['publisher']; ?></td>
                                    <td align="left"><?php echo $book['depertment']; ?></td>
                                    <td align="left"><?php echo $book['quantity']; ?></td>
                                    
                                    <td><a class="btn btn-success" href="showdetails.php?id=<?php echo $book['uid']; ?>">Show Details</a></td>
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
        <ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>

        

    </body>
</html>
