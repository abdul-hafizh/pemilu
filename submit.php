<?php
    require_once("config.php");

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

    $data_update = [        
        'have_count' => $_POST["have_count"]+1,
        'id' => $_POST["user_id"]
    ];

    $sql_update = "UPDATE users SET have_count=:have_count WHERE id=:id";
    $stmt_update = $db->prepare($sql_update);
    $stmt_update->execute($data_update);
    
    // redirect
    echo '<script>alert("Pilihan Anda telah tersimpan, Terima Kasih...");window.location="polling.php"</script>';

?>