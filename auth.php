<?php 

    require_once("config.php");

    $username = filter_input(INPUT_POST, 'rand_code', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username=:username";
    $stmt = $db->prepare($sql);
    
    $params = array(
        ":username" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($user){
        
        // buat Session
        session_start();
        $_SESSION["user"] = $user['id'];
        $_SESSION["nama"] = $user['nama_lengkap'];
        $_SESSION["have_count"] = $user['have_count'];

        // login sukses, alihkan ke halaman timeline
        header("Location: polling.php");

    } else {

        header("Location: index.php");
    }


?>