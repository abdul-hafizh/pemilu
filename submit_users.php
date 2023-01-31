<?php
    require_once("config.php");

    // prepare sql and bind parameters
    $stmt = $db->prepare("INSERT INTO users (nama_lengkap,nomor_hp, have_count, username) VALUES (:nama_lengkap, :nomor_hp, :have_count, :username)");
    $stmt->bindParam(':nama_lengkap', $nama_lengkap);
    $stmt->bindParam(':nomor_hp', $nomor_hp);
    $stmt->bindParam(':have_count', $have_count);
    $stmt->bindParam(':username', $username);

    $nama_lengkap = $_POST["nama_lengkap"];
    $nomor_hp = $_POST["nomor_hp"];
    $have_count = 0;
    $username = random_int(154361, 987651);
    $stmt->execute();
    
    // redirect
    echo '<script>alert("Data telah tersimpan");window.location="list_users.php"</script>';

?>