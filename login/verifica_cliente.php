
<?php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['id'])){
    header("Location: /mini-sistema/nortrek/login/login.php");
    exit();
}
?>