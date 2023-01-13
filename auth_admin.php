<?php 

    require_once("config.php");

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM admin WHERE username=:username AND password=:password";
    $stmt = $db->prepare($sql);
    
    $params = array(
        ":username" => $username,
        ":password" => $password
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($user){
        
        // buat Session
        session_start();
        $_SESSION["admin"] = $user['id'];

        // login sukses, alihkan ke halaman timeline
        header("Location: dashboard.php");

    } else {

        header("Location: admin.php");
    }


?>