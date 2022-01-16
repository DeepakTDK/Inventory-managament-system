<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wholesaler</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <?php require_once('../include/ws.php'); ?>

    <?php
    if(isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>
    <div class="container">
    <?php 
    $mysqli = new mysqli('localhost', 'root', '', 'ims') or die(mysqli_error($mysqli));
    $result = $mysqli->query("select * from wholesaler") or die($mysqli->error);
    //pre_r( $result );
    ?>

    <div class="justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

            <?php 
            while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['w_id']; ?></td>
                <td><?php echo $row['w_name']; ?></td>
                <td><?php echo $row['w_number']; ?></td>
                <td><?php echo $row['w_address']; ?></td>
                <td>
                    <a href="../dist/wholesaler.php?edit=<?php echo $row['w_id']; ?>"
                        class="btn btn-info">Edit</a>
                    <a href="../include/ws.php?delete=<?php echo $row['w_id']; ?>"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>


<?php   
    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
?>



    <h3 class="h3">wholesaler Details</h3>
        <div class="justify-content-center">
        <form action="../include/ws.php" method="POST">
            <div class="form-group">
                <label>w_id: </label>
                <input type="text" name="wid" class="form-control" value="<?php echo $wid; ?>">
            </div>
            <div class="form-group">
                <label>w_name: </label>
                <input type="text" name="wname" class="form-control" value="<?php echo $wname; ?>">
            </div>
            <div class="form-group">
                <label>w_number: </label>
                <input type="text" name="wnumber" class="form-control" value="<?php echo $wnumber; ?>">
            </div>
            <div class="form-group">
                <label>w_address: </label>
                <input type="text" name="waddress" class="form-control" value="<?php echo $waddress; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="save">
            </div>            
        </form>
        </div>
</div>
    
</body>
</html>

