<?php

if(isset($_POST['create_user'])){
    $user_firstname =  escape($_POST['user_firstname']);
    $user_lastname =  escape($_POST['user_lastname']);

    $user_role =  escape($_POST['user_role']);

    // $post_image =  $_FILES['image']['name'];
    // $post_image_temp =  $_FILES['image']['tmp_name'];

    $user_name =  escape($_POST['user_name']);
    $user_email =  escape($_POST['user_email']);
    $user_password =  escape($_POST['user_password']);

    // $post_date = date('d-m-y');
    // $post_comment_count = 4;


    // move_uploaded_file($post_image_temp, "../images/$post_image");
    $user_password = password_hash($user_password, PASSWORD_BCRYPT,array('cost'=>10));
    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, user_name, user_email, user_password) ";
    $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$user_name}','{$user_email}','{$user_password}') ";

    $create_user_query = mysqli_query($connection, $query);

    confirmQuery($create_user_query);

    echo "User Created: " . " " . "<a href='users.php'>View Users</a> ";
}

?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
     <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
     </div>

    <div class="form-group">
        <label for="title">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select name="user_role" id="post_category">
            <option value="subscriber">SELECT OPTIONS</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div> -->
     
     

    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="user_name" id="">
     </div>
     
     
     
    <div class="form-group">
        <label for="post_image">Email</label>
        <input type="email" class="form-control"  name="user_email">
    </div>
     
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
     
     

    <div class="form-group">
        <input class="btn btn-primary" class="form-control" type="submit" name="create_user" value="Add User">
    </div>
</form>