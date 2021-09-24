<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $phone_id = ($_GET['phone_id']);
    if (isset($_POST['update'])) {

        $phone_name = $_POST['phone_name'];
        $sell_who = $_POST['sell_who'];
        $phone_amount = $_POST['phone_amount'];
        $phone_price = $_POST['phone_price'];
        $echo_id = $_POST['echo_id'];
        $sql = "update tbphone set phone_amount=phone_amount - :phone_amount  where phone_id=:phone_id";
        $sql2 = "INSERT INTO sell_phone(sell_name,sell_amount,sell_who,echo_id,sell_price,list_id) VALUES(:phone_name,:phone_amount,:sell_who,:echo_id,:phone_price,1)";
        $query = $dbh->prepare($sql);
        $query2 = $dbh->prepare($sql2);
        // $query->bindParam(':phone_name',$phone_name,PDO::PARAM_STR);
        // $query->bindParam(':sell_who',$sell_who,PDO::PARAM_STR);
        $query->bindParam(':phone_amount', $phone_amount, PDO::PARAM_STR);
        // $query->bindParam(':echo_id',$echo_id,PDO::PARAM_STR);
        // $query->bindParam(':status_id',$status_id,PDO::PARAM_STR);
        $query->bindParam(':phone_id', $phone_id, PDO::PARAM_STR);

        $query2->bindParam(':phone_name', $phone_name, PDO::PARAM_STR);
        $query2->bindParam(':phone_amount', $phone_amount, PDO::PARAM_STR);
        $query2->bindParam(':sell_who', $sell_who, PDO::PARAM_STR);
        $query2->bindParam(':echo_id', $echo_id, PDO::PARAM_STR);
        $query2->bindParam(':phone_price', $phone_price, PDO::PARAM_STR);
        $sql3 = "INSERT INTO money_today(money_today_name,amount_today) VALUES(:phone_price,:phone_amount);";
        $query3 = $dbh->prepare($sql3);
        $query3->bindParam(':phone_price', $phone_price, PDO::PARAM_STR);
        $query3->bindParam(':phone_amount', $phone_amount, PDO::PARAM_STR);

        $sql4 = "INSERT INTO phone_today(phone_today_name) VALUES(:phone_amount);";
        $query4 = $dbh->prepare($sql4);
        $query4->bindParam(':phone_amount', $phone_amount, PDO::PARAM_STR);
        $query->execute();
        $query2->execute();
        $query3->execute();
        $query4->execute();

        $msg = "ขายโทรศัพท์เรียบร้อยแล้ว";
        if ($query) {
            echo "<script>alert ('ขายโทรศัพท์ เรียบร้อยแล้ว')</script>";
            echo "<script>window.location.href='dashboard.php'</script>";
        } else {
            echo "<script>alert('ไม่สามารถอัพเดตข้อมูลนี้ได้')</script>";
            echo "<script>window.location.href='dashboard.php'</script>";
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Smart-Phone-Shop</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
        <!-- font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped&display=swap" rel="stylesheet">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai+Looped&display=swap');
        </style>
        <style>
            body {
                font-family: 'IBM Plex Sans Thai Looped', sans-serif;
            }
        </style>

        <!-- icon -->
        <link rel="icon" type="image/png" href="assets/images/icon.png" />




    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <?php include('includes/sidebar.php'); ?>
        <main class="mn-inner">
            <div class="row">
                <div class="col s12">
                    <div class="page-title">ขายโทรศัพท์</div>
                </div>
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <form id="example-form" method="post" name="updatemp">
                                <div>
                                    <h3>ขายโทรศัพท์</h3>
                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m6">
                                                    <div class="row">
                                                        <?php
                                                        $eid = intval($_GET['phone_id']);
                                                        $sql = "SELECT * from  tbphone where phone_id=:phone_id";
                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':phone_id', $eid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {               ?>
                                                                <div class="input-field col  s12">
                                                                    <label for="phone_name">โทรศัพท์มือถือ</label>
                                                                    <input name="phone_name" id="phone_name" value="<?php echo htmlentities($result->phone_name); ?>" type="text" autocomplete="off" required>
                                                                    <span id="empid-availability" style="font-size:12px;"></span>
                                                                </div>


                                                                <div class="input-field col m6 s12">
                                                                    <label for="phone_price">ราคา</label>
                                                                    <input id="phone_price" name="phone_price" value="<?php echo htmlentities($result->phone_price); ?>" type="text" required>
                                                                </div>

                                                                <div class="input-field col m6 s12">
                                                                    <label for="phone_amount">จำนวนเครื่องที่ขาย</label>
                                                                    <input id="phone_amount" name="phone_amount" value="" type="text" autocomplete="off" required>
                                                                </div>


                                                    </div>
                                                </div>

                                                <div class="col m6">
                                                    <div class="row">


                                                        <div class="input-field col m6 s12">
                                                            <select name="echo_id" autocomplete="off">
                                                                <?php $sql = "SELECT * from status_phone";
                                                                $query = $dbh->prepare($sql);
                                                                $query->execute();
                                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                if ($query->rowCount() > 0) {
                                                                    foreach ($results as $resultt) {
                                                                        $selected = ($resultt->echo_id == $result->echo_id) ? "selected" : "";
                                                                        echo "<option  value = '{$resultt->echo_id}' {$selected}>{$resultt->echo_name}</option>";

                                                                ?>
                                                                        <!-- <option value="<?php echo htmlentities($resultt->echo_id); ?>"><?php echo htmlentities($resultt->echo_name); ?></option> -->
                                                                <?php }
                                                                } ?>
                                                            </select>

                                                        </div>


                                                <?php }
                                                        } ?>
                                                <div class="input-field col m12 s12">
                                                    <label for="sell_who">ข้อมูลผู้ซื้อ / ไม่กรอกก็ได้</label>
                                                    <input id="sell_who" name="sell_who" type="text" autocomplete="off">
                                                </div>
                                                <div class="input-field col s12">
                                                    <button type="submit" name="update" id="update" class="waves-effect waves-light btn indigo m-b-xs">ขาย</button>

                                                </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>


                                    </section>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
        <div class="left-sidebar-hover"></div>

        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <!-- <script src="../assets/js/pages/form_elements.js"></script> -->

    </body>

    </html>
<?php } ?>