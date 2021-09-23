<?php
// include('includes/config.php');
include('config.php');
if (isset($_GET['sell_id'])) {
    $sell_id = $_GET['sell_id'];
    // header('location:manageemployee.php');
    // $sql = "SELECT * FROM sell_phone WHERE sell_id =: sell_id";
    // $query = $dbh->prepare($sql);
    // $query->bindParam(':sell_id', $sell_id, PDO::PARAM_STR);
    // $query->execute();
    // $results = $query->fetchAll(PDO::FETCH_OBJ);

    // echo "{$sell_id}";
    // $sql = "SELECT * FROM sell_phone WHERE sell_id =: sell_id";
    // $query = $dbh->prepare($sql);
    // $query->bindParam(':sell_id', $sell_id, PDO::PARAM_STR);
    // $query->execute();
    // $results = $query->fetchAll(PDO::FETCH_ASSOC);
    // foreach ($results as $result){
    //     echo "{$result['sell_name']}";
    // }





        // foreach ($results as $result) {
        //     echo "{$result->sell_name}";
        //     echo "test";
        // }
    $sql2 = "SELECT (sum_teacher) as 'total' FROM (
        SELECT sum(sell_amount*sell_price) as sum_teacher FROM sell_phone  WHERE sell_id = {$sell_id}) sum_tea;";


    $sql = "SELECT * FROM sell_phone WHERE sell_id = {$sell_id};";
    $res = $conn->query($sql);
    $res2 = $conn->query($sql2);
    $row = $res->fetch_assoc();
    $row2 =$res2->fetch_assoc();


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <link rel="stylesheet" href="css/print.css" media="print">
    <link rel="stylesheet" href="css/style.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Sarabun', sans-serif;
        }

        th {
            font-family: 'Sarabun', sans-serif;
            padding: 5px;
            text-align: center;

        }

        td {
            font-family: 'Sarabun', sans-serif;
            padding: 5px;
            text-align: left;
            font-size: 14px;

        }
    </style>

</head>

<body>
    <div class="center">
        <button id="print" onclick="window.print()">Print</button>
    </div>
    <div class="container">
        <header>
            <br><br><br>
            <h2>ใบเสร็จรับเงิน</h2>
            <br><br>
            <h4>ร้านโชกุน โมบาย 2</h4><br>
            <h5>ราษฎร์อุทิศ 1 ต.บ่อยาง อ.เมือง จ.สงขลา 90000</h5>
            <br>
            <h5>โทร 061-6989164 / 082-4592252</h5>
            <br><br><br>
        </header>
        <section>
            <div class="date">
                <p style="text-align: left;">&emsp;&emsp;&emsp;&emsp; วันที่ <?php echo $row['sell_date']; ?> <span id="datetime"></span></p>
            </div>
            <br>
            <div>
                <p  style="text-align: left;">
                &emsp;&emsp;&emsp;&emsp; ชื่อลูกค้า  <?php echo $row['sell_who']; ?> </p>
                <br>
            </div>
            <table style="width:85%">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รายการ</th>
                        <th>จำนวน</th>
                        <th>หน่วยละ</th>
                        <th>ราคารวม</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <!-- <td></td> -->
                        <td  style = "text-align: center;" >1</td>
                        <td style = "text-align: center;" class="price"><?php echo $row['sell_name']; ?></td>
                        <td  style = "text-align: center;" ><?php echo $row['sell_amount']; ?></td>
                        <td  style = "text-align: center;"  class="price"><?php echo $row['sell_price']; ?></td>
                        <td  style = "text-align: center;"  ><?php echo $row2['total']; ?></td>
                    </tr>
                </tbody>
            </table>
            <pre>

         ลงชื่อ ...............................................ผู้รับสินค้า                                                  ลงชื่อ ...............................................ผู้รับเงิน

    วันที่  (...................................................)                                                           วันที่  (...................................................)
                                                                                               

                                                                                               



</pre>
        </section>
    </div>
</body>

</html>