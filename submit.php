<?php
    require_once("config.php");

    $stmt_del = $db->prepare("DELETE FROM result_polling WHERE user_id=" . $_POST["user_id"] );
    $stmt_del->execute();

    // prepare sql and bind parameters
    $stmt = $db->prepare("INSERT INTO result_polling (user_id,kandidat_id,created_date) VALUES (:user_id, :kandidat_id, :created_date)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':kandidat_id', $kandidat_id);
    $stmt->bindParam(':created_date', $created_date);


    foreach($_POST['kandidat_check'] as $kandidat_id) {
        // insert a row
        $user_id = $_POST["user_id"];
        $kandidat_id = $kandidat_id;
        $created_date = date('Y-m-d h:i:s');
        $stmt->execute();
    }
    
    // redirect
    echo '<script>alert("Pilihan Anda telah tersimpan, Terima Kasih...");window.location="polling_approve.php"</script>';

?>