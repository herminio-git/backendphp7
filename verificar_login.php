<?php 

    // session_start();
    if(!$_SESSION['db_usuario']){
        header('Location: login.php');
        exit();
    }

?>