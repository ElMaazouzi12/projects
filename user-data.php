<?php
require './connection.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('location:connection.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <!-- bootsrap link -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style_listgreenworks.css">

    <!-- font awesome cdn linl -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>

<body>

    <?php
    $id = $_SESSION['user'];
    $sql = $conn->prepare("SELECT * FROM `user` WHERE `id`='$id'");
    $sql->execute();
    $fetch = $sql->fetch();
    ?>
    <script>
        (function() {
            // removing the message 3 seconds after the page load
            setTimeout(function() {
                document.getElementById('welcome').remove();
            }, 2000)
        })();
    </script>
    <div class="container">
        <div class="user">
            <h3 id="welcome">Welcome</h3>
            <h4><?php echo $fetch['username']?></h4>
        </div>
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg">
                <?php echo $_SESSION['message']['text'] ?></div>
            <script>
                (function() {
                    // removing the message 3 seconds after the page load
                    setTimeout(function() {
                        document.querySelector('.msg').remove();
                    }, 3000)
                })();
            </script>
        <?php
        endif;
        // clearing the message
        unset($_SESSION['message']);
        ?>


</body>
<style>
    
</style>