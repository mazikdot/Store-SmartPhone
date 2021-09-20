<?php
include('includes/config.php');
$money = "SELECT (sum_teacher) as 'total' FROM (
    SELECT sum(money_today_name*amount_today) as sum_teacher FROM money_today ) sum_tea;";
 $query_monney = $dbh->prepare($money);
//  $query->execute();
//  $results = $query->fetchAll(PDO::FETCH_OBJ);
//  foreach ($results as $result) {
$query_monney->execute();
$results = $query_monney->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result){
    $total_phone_name = $result->total;
    // echo "{$total}";
    $sql="INSERT INTO total_phone(total_phone_name) VALUES(:total_phone_name);";
    $query = $dbh->prepare($sql);
    $query->bindParam(':total_phone_name',$total_phone_name,PDO::PARAM_STR);
    $query->execute();
    $sql2 = "delete from money_today";
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