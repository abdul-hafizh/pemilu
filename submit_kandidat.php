<?php
    require_once("config.php");

    // prepare sql and bind parameters
    $stmt = $db->prepare("INSERT INTO kandidat (nama_lengkap,nomor_urut) VALUES (:nama_lengkap, :nomor_urut)");
    $stmt->bindParam(':nama_lengkap', $nama_lengkap);
    $stmt->bindParam(':nomor_urut', $nomor_urut);

    $nama_lengkap = $_POST["nama_lengkap"];
    $nomor_urut = $_POST["nomor_urut"];
    $stmt->execute();
    
    // redirect
    echo '<script>alert("Data telah tersimpan");window.location="list_kandidat.php"</script>';

?>