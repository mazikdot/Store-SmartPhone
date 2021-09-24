<?php
// include('includes/config.php');
include('config.php');
    $sql2 = "SELECT (sum_teacher) as 'total' FROM (
        SELECT sum(sell_amount*sell_price) as sum_teacher FROM sell_phone  WHERE list_id = 2) sum_tea;";


    $sql = "SELECT * FROM sell_phone WHERE list_id = 2;";
    $res = $conn->query($sql);
    $res4 = $conn->query($sql);
    $res2 = $conn->query($sql2);
    $num = $res->num_rows;
    if($num == 0){
        echo "<script>alert ('โปรดเลือกรายการก่อนการพิมพ์')</script>";
        echo "<script>window.location.href='list-sell.php'</script>";
    }
    // $row = $res->fetch_assoc();
    // $row2 =$res2->fetch_assoc();
   
    while($rowss = mysqli_fetch_assoc($res)){
        $row1 = $rowss['sell_date'];
        $row_who = $rowss['sell_who'];
    }
    while($sel = mysqli_fetch_assoc($res2)){
        $total = $sel['total'];
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
                <p style="text-align: left;">&emsp;&emsp;&emsp;&emsp; วันที่ <?php echo $row1 ?> <span id="datetime"></span></p>
            </div>
            <br>
            <div>
                <p  style="text-align: left;">
                &emsp;&emsp;&emsp;&emsp; ชื่อลูกค้า  <?php echo $row_who ?> </p>
                <br>
            </div>
            <table style="width:85%">
                <thead>
                   
                    <tr>
                        <th>ลำดับ</th>
                        <th>รายการ</th>
                        <th>จำนวน</th>
                        <th>เครื่องละ</th>
                      
                    </tr>
                </thead>
      
                <tbody>
                <?php
                $cn = 1;
                        while($rowtable = mysqli_fetch_assoc($res4)){
                    ?>
                    <tr>
                        <!-- <td></td> -->
                        <td  style = "text-align: center;" ><?php echo "{$cn}"; ?></td>
                        <td style = "text-align: center;" class="price"><?php echo $rowtable['sell_name']; ?></td>
                        <td  style = "text-align: center;" ><?php echo $rowtable['sell_amount']; ?></td>
                        <td  style = "text-align: center;"  class="price"><?php echo $rowtable['sell_price'] ?></td>
                        
                    </tr>
                    <?php
                    $cn++;
                        }
                    ?>
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style = "text-align: center;"  >รวมเป็นเงิน : <?php echo $total ?></td>
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