<?php
    require_once("config.php");

    $data_update = [        
        'have_count' => $_POST["have_count"]+1,
        'id' => $_POST["user_id"]
    ];

    $sql_update = "UPDATE users SET have_count=:have_count WHERE id=:id";
    $stmt_update = $db->prepare($sql_update);
    $stmt_update->execute($data_update);
    
    // redirect
    session_start();
    $_SESSION["user"] = 0;
    echo '<script>alert("Terima Kasih atas Partisipasi Anda.");window.location="index.php"</script>';

?>