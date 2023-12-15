<?php
require_once 'templates/header.php';
include '../activity1/index.php';
?>

<?php

$host = 'localhost'; // Because MySQL is running on the same computer as the web server
$database = 'PHP_connect'; // Name of the database you use (you need first to CREATE DATABASE in MySQL)
$user = 'root'; // Default username to connect to MySQL is root
$password = ''; // Default password to connect to MySQL is empty

try {
    $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully";
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
    exit;
}
// TO DO: CREATE CONNECTION TO DATABASE
// Read file: https://www.w3schools.com/php/php_mysql_connect.asp
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['username']) && !empty($_POST['message'])):
    $username = $_POST['username'];
    $message = $_POST['message'];
    $staterment = $db->query("SELECT id,name FROM posts WHERE id=1;");
    $userList = $staterment->fetchAll();
    print_r($userList);

endif;

?>

<?php
// TO DO: SELECT ALL POSTS FROM DATABASE
$posts = $db->query("SELECT * FROM posts;");
foreach ($posts as $post):
    ?>
    <div class="card">
        <div class="card-header">
            <span>
                <span>
                    <?php
                    echo $post['name'] ?>
                </span>
                <hr>
            </span>
        </div>
        <div class="card-body">
            <p class="card-text">
                <?php
                // TO DO: display the message for this post 
                echo $post['message'];
                ?>
            </p>
        </div>
    </div>
    <hr>
    <?php
endforeach;
?>

<form action="#" method="post">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username">
        </div>
    </div>

    <div class="mb-3">
        <textarea name="message" placeholder="Enter message" class="form-control"></textarea>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Add new post</button>
    </div>
</form>

<?php
require_once 'templates/footer.php';
?>