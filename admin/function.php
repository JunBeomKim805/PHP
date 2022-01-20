<?php   

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection,trim($string));
}

function users_online(){

    if(isset($_GET['onlineusers'])){

    global $connection;

    if(!$connection){
        session_start();
        include("../includes/db.php");

        $session = session_id();
        
        $time = time();
        
        $time_out_in_seconds = 10;
        
        $time_out = $time - $time_out_in_seconds;
        
        
        $query = "SELECT * FROM users_online WHERE users_online_session = '$session'";
        
        $send_query = mysqli_query($connection, $query);
        
         $count = mysqli_num_rows($send_query);
        
        
        if ($count == NULL) {
            
            
            mysqli_query($connection, "INSERT INTO users_online(users_online_session, users_online_time) VALUES('$session','$time')");
            
        } else {
            
            mysqli_query($connection, "UPDATE users_online SET users_online_time = '$time' WHERE users_online_session = '$session'");
            
        }
        
        
        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE users_online_time > '$time_out'");
        
        echo $count_user = mysqli_num_rows($users_online_query);
    }

}
}
users_online();


function confirmQuery($result) {
    global $connection;
    if(!$result){
        die("QUERY FAILED ." . mysqli_error($connection));
    }
}


function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        }
        else{
            $stmt =mysqli_prepare($connection,"INSERT INTO categories(cat_title) Value(?) ");

            mysqli_stmt_bind_param($stmt, 's', $cat_title);

            mysqli_stmt_execute($stmt);

            if(!$stmt){
                die('QUERY FAILED'. mysqli_error($connection));
            }
        }
        mysqli_stmt_close($stmt);
    }
}

function findAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories_query = mysqli_query($connection, $query);
    while($row =mysqli_fetch_assoc($select_categories_query)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title']; 
        
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteCategories(){
    global $connection;

    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php");
    }
}

function recordCount($table){
    global $connection;
    $query = "SELECT *FROM " . $table;
    $select_all_post = mysqli_query($connection,$query);

    $result =  mysqli_num_rows($select_all_post);

    confirmQuery($result);

    return $result;
}
function checkStatus($table,$column,$status){
    global $connection;
    $query = "SELECT *FROM $table WHERE $column = '$status' ";
    $result = mysqli_query($connection,$query);
    return mysqli_num_rows($result); 
}

function checkUserRole($table,$column,$role){
    global $connection;
    $query = "SELECT *FROM $table WHERE $column = '$role' ";
    $result = mysqli_query($connection,$query);
    return mysqli_num_rows($result); 
}
function get_user_name(){

    return isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;

}
function is_admin($username=''){
    
    
    global $connection;
    
    
    $query = "SELECT user_role FROM users WHERE user_name = '$username'";
    
    $result    = mysqli_query($connection, $query);
    
    ConfirmQuery($result);
    
    $row = mysqli_fetch_array($result);
    
    if($row['user_role'] == 'admin'){
        
        return true;
        
    }else{
        
        return false;
    }
    
}
function username_exists($user_name){
    global $connection;

    $query = "SELECT user_name FROM users WHERE user_name = '$user_name' ";

    $result = mysqli_query($connection,$query);

    confirmQuery($result);

    if(mysqli_num_rows($result)>0){
        return true;
    }
    else{
        return false;
    }
}
function email_exists($user_email){
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email= '$user_email' ";

    $result = mysqli_query($connection,$query);

    confirmQuery($result);

    if(mysqli_num_rows($result)>0){
        return true;
    }
    else{
        return false;
    }
}

function redirect($location){
    header("Location:" . $location);
    exit;   
}
function ifItIsMethod ($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
}
function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}
function checkIfUserIsLoggedInAndRedirect($redirectLocation){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}

function register_user($username,$email,$password){
    global $connection;

        $username = mysqli_real_escape_string($connection,$username); 
        $email = mysqli_real_escape_string($connection, $email);
        $password= mysqli_real_escape_string($connection, $password);

        $password = password_hash($password,PASSWORD_BCRYPT,array('cost' => 12));

    
        // $query = "SELECT randSalt FROM users ";
        // $select_randsalt_query =mysqli_query($connection,$query);

    
        // if(!$select_randsalt_query){
        //     die("QUERY FAILED" . mysqli_error($connection));
        // }
    
        // $row = mysqli_fetch_array($select_randsalt_query);
        // $salt = $row['randSalt'];
    
        // $password = crypt($password, $salt);

        $query = "INSERT INTO users (user_name, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber' ) ";
        $register_user_query = mysqli_query($connection,$query);
        if(!$register_user_query){
            die("QUERY FAILED" . mysqli_error($connection) . ' ' . mysqli_errno($connection));
        }
    
}

function login_user($user_name, $password){
    global $connection;
    $user_name = trim($user_name);
    $password = trim($password);

    $user_name = mysqli_real_escape_string($connection,$user_name);
    $password = mysqli_real_escape_string($connection,$password);

    $query = "SELECT * FROM users WHERE user_name = '{$user_name}' ";
    $select_user_query = mysqli_query($connection,$query);
    if(!$select_user_query){
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query)){
        $db_user_id = $row['user_id'];
        $db_user_name = $row['user_name'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        if(password_verify($password, $db_user_password)){
            if (session_status() == PHP_SESSION_NONE) session_start();
            $_SESSION['user_name'] = $db_user_name;
            $_SESSION['user_firstname'] = $db_user_firstname;
            $_SESSION['user_lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;  
            redirect("/cms2/admin");
        }
        else{
            return false;
        }   
    }
    return true;
    // $password = crypt($password, $db_user_password);


}
function currentUser(){
    global $connection;
    if (isset($_SESSION['username'])) {
        
        return $_SESSION['username'];
    }
        return false;
}
function imagePlaceHolder($image=''){
    if(!$image){
        return 'image_4.jpg';
    }
    else{
        return $image;
    }
}

function query($query){
    global $connection;
    return mysqli_query($connection,$query);
}

function loggedInUserId(){
    if(isLoggedIn()){
        $result = query("SELECT * FROM users WHERE user_name='". $_SESSION['user_name'] ."'");
        confirmQuery($result);
        $user = mysqli_fetch_array($result);
        if(mysqli_num_rows($result)>=1){
            return $user['user_id'];
        }
    }
    return false;
}
function userLikedThisPost($post_id = ''){
    $result = query("SELECT * FROM likes WHERE user_id=" .loggedInUserId() . " AND post_id=$post_id");
    confirmQuery($result);
     if(mysqli_num_rows($result) >=1) {
        return true;} else{return false;}
}
function getPostlikes($post_id){
    $result = query("SELECT * FROM likes WHERE post_id=$post_id");
    confirmQuery($result);
    echo mysqli_num_rows($result);
}
?>