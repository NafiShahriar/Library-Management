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
                        <label class="col-md-3">Book Name: <font color="teal"><i>*(required)</i></font></label>
                        <input class="col-md-8" type="text" name="Name" placeholder="Name of the book">
                    </div>
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">Author : <font color="teal"><i>*(required)</i></font></label>
                        <input class="col-md-8" type="text" name="Author" placeholder="Writer of the book">
                    </div>
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">Publisher : </label>
                        <input class="col-md-8" type="text" name="Publisher" placeholder="Publisher name">
                    </div>
                    <div class="sigle-input col-md-12">
                        <label class="col-md-3">Department : </label>
                        <select name="depertment">
                        <option value="CSE">CSE</option>
                        <option value="EEE">EEE</option>
                        <option value="ME">ME</option>
                        <option value="BBA">BBA</option>
                        <option value="English">English</option>
                        <option value="IPE">IPE</option>
                        <option value="Others">Others</option>
                        </select>
                        <br>
                    </div>
                     <div class="sigle-input col-md-12">
                        <label class="col-md-3">Available quantity : </label>
                        <input class="col-md-8" type="text" name="quantity" >
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
            $Name = $_POST['Name'];
            $Author = $_POST['Author'];
            $Publisher = $_POST['Publisher'];
            $Catagory = $_POST['depertment'];
            $Quantity = $_POST['quantity'];
            

            $con = mysqli_connect("localhost", "root", "", "bookinfo");
            $query = "INSERT INTO bookdetails (name,author,publisher,depertment,quantity) VALUES ('$Name','$Author','$Publisher','$Catagory','$Quantity')";
          


             if (!empty($Name) ) {
                $result = mysqli_query($con, $query);
               
                if ($result) {

                    $fk = 0;
                } else
                    echo "<p class='text-center bg-danger'>Not Inserted!</p>";
            } else
                echo "<p class='text-center bg-danger'>Error!</p>";

            if ($fk == 0) {
                header('Location: ' . $_SERVER['REQUEST_URI'] . '?submit=true');
            }
        }
        ?>
        
        <?php
        $v_submit = isset($_GET["submit"]);
        if ($v_submit == 'true') {
            echo "<p class='text-center bg-submit'><b>INSERTED SUCCESSFULLY</b></p>";
            header("Refresh:0.5; url=addnew.php");
        }
        ?>


    </body>
</html>