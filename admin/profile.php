
<?php include "includes/admin_header.php" ?>
<?php
    if(isset($_SESSION['user_name'])){
        $user_name = $_SESSION['user_name'];

        $query = "SELECT * FROM users WHERE user_name = '$user_name' ";

        $select_user_profile = mysqli_query($connection,$query);

        while($row = mysqli_fetch_array($select_user_profile)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
    }

?>
<?php 
if(isset($_POST['edit_user'])){
    $user_firstname =  escape($_POST['user_firstname']);
    $user_lastname =  escape($_POST['user_lastname']);


    // $post_image =  $_FILES['image']['name'];
    // $post_image_temp =  $_FILES['image']['tmp_name'];

    $user_name =  escape($_POST['user_name']);
    $user_email =  escape($_POST['user_email']);
    $user_password =  escape($_POST['user_password']);

    // $post_date = date('d-m-y');
    // $post_comment_count = 4;


    // move_uploaded_file($post_image_temp, "../images/$post_image");



        $query = "UPDATE users SET ";
        $query .="user_firstname = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_name = '{$user_name}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_password = '{$user_password}' ";
        $query .="WHERE user_name = '{$user_name}' ";

        $edit_user_query = mysqli_query($connection,$query);
        confirmQuery($edit_user_query);

    

}



?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $user_name ?></small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">    
     
     
                            <div class="form-group">
                                <label for="title">Firstname</label>
                                <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
                            </div>

                            <div class="form-group">
                                <label for="title">Lastname</label>
                                <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname">
                            </div>

                            <!-- <div class="form-group">
                                <label for="title">Post Author</label>
                                <input type="text" class="form-control" name="post_author">
                            </div> -->
                            
                            

                            <div class="form-group">
                                <label for="title">Username</label>
                                <input type="text" value="<?php echo $user_name ?>"  class="form-control" name="user_name" id="">
                            </div>
                            
                            
                            
                            <div class="form-group">
                                <label for="post_image">Email</label>
                                <input type="email" value="<?php echo $user_email ?>" class="form-control"  name="user_email">
                            </div>
                            
                            <div class="form-group">
                                <label for="post_tags">Password</label>
                                <input type="password" autocomplete="off" class="form-control" name="user_password">
                            </div>
                            
                            

                            <div class="form-group">
                                <input class="btn btn-primary" class="form-control" type="submit" name="edit_user" value="Update Profile">
                            </div>
                        </form>                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>    