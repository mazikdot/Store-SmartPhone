<?php
include('includes/config.php');
$money = "SELECT SUM(phone_today_name) as total FROM phone_today;";
 $query_monney = $dbh->prepare($money);
//  $query->execute();
//  $results = $query->fetchAll(PDO::FETCH_OBJ);
//  foreach ($results as $result) {
$query_monney->execute();
$results = $query_monney->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result){
    $total_phone_name2 = $result->total;
    // echo "{$total}";
    $sql="INSERT INTO total_phone2(total_phone_name2) VALUES(:total_phone_name2);";
    $query = $dbh->prepare($sql);
    $query->bindParam(':total_phone_name2',$total_phone_name2,PDO::PARAM_STR);
    $query->execute();
    $sql2 = "delete from phone_today";
    $query2 = $dbh->prepare($sql2);
    $query2 -> execute();
    if ($sql) {
        
        echo "<script>alert('เคลียข้อมูลเรียบร้อยแล้ว')</script>";
        echo "<script>window.location.href='manage-list.php'</script>";
    } else {
        echo "<script>alert('ไม่สามารถเคลียข้อมูลนี้ได้')</script>";
        echo "<script>window.location.href='list-sell.php'</script>";
    }
    
}
?>