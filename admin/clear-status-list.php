<?php
    include('includes/config.php');
    $sql = "UPDATE sell_phone SET list_id = 1 WHERE list_id = 2";
    // $sql = "update notes set note_name=:note_name  where note_id=:note_id";
    $query = $dbh->prepare($sql);
    $query->execute();
    if ($query) {
        // echo "<script>alert ('เลือกรายการนี้เรียบร้อยแล้ว')</script>";
        echo "<script>window.location.href='list-sell.php'</script>";
    } else {
        echo "<script>alert('ไม่สามารถอัพเดตข้อมูลนี้ได้')</script>";
        echo "<script>window.location.href='list-sell.php'</script>";
    }
?>