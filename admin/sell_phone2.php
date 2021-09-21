<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['add'])) {
        $sell_name = $_POST['sell_name'];
        $sell_price = $_POST['sell_price'];
        $echo_id = $_POST['echo_id'];
        $sell_who = $_POST['sell_who'];
        $sell_amount = $_POST['sell_amount'];

        $sql = "INSERT INTO sell_phone(sell_name,sell_price,sell_amount,echo_id,sell_who) VALUES(:sell_name,:sell_price,:sell_amount,:echo_id,:sell_who)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sell_name', $sell_name, PDO::PARAM_STR);
        $query->bindParam(':sell_price', $sell_price, PDO::PARAM_STR);
        $query->bindParam(':echo_id', $echo_id, PDO::PARAM_STR);
        $query->bindParam(':sell_who', $sell_who, PDO::PARAM_STR);
        $query->bindParam(':sell_amount', $sell_amount, PDO::PARAM_STR);

        $sql3 = "INSERT INTO money_today(money_today_name,amount_today) VALUES(:sell_price,:sell_amount);";
        $query3 = $dbh->prepare($sql3);
        $query3->bindParam(':sell_price', $sell_price, PDO::PARAM_STR);
        $query3->bindParam(':sell_amount', $sell_amount, PDO::PARAM_STR);
        $query3->execute();

        $sql4 = "INSERT INTO phone_today(phone_today_name) VALUES(:sell_amount);";
        $query4 = $dbh->prepare($sql4);
        $query4->bindParam(':sell_amount', $sell_amount, PDO::PARAM_STR);
        $query4->execute();
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "คุณได้ทำการขายโทรศัพท์มือถือเรียบร้อยแล้ว";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Add_Phone</title>

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
        <script type="text/javascript">
        </script>


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
                    <div class="page-title">กรอกข้อมูล</div>
                </div>
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <form id="example-form" method="post" name="addemp">
                                <div>
                                    <h3>ขายโทรศัพท์</h3>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m6">
                                                    <div class="row">
                                                        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>


                                                        <div class="input-field col  s12">
                                                            <label for="sell_name">ข้อมูลสินค้า</font></label>
                                                            <input name="sell_name" id="sell_name" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>
                                                            <span id="empid-availability" style="font-size:12px;"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col m6">
                                                    <div class="row">

                                                        <div class="input-field col m6 s12">
                                                            <select name="echo_id" autocomplete="off">
                                                                <option value="">ยี่ห้อโทรศัพท์มือถือ</option>
                                                                <?php $sql = "SELECT echo_id,echo_name from status_phone";
                                                                $query = $dbh->prepare($sql);
                                                                $query->execute();
                                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                $cnt = 1;
                                                                if ($query->rowCount() > 0) {
                                                                    foreach ($results as $result) {   ?>
                                                                        <option value="<?php echo htmlentities($result->echo_id); ?>"><?php echo htmlentities($result->echo_name); ?></option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m12 s12">
                                                            <label for="sell_amount">จำนวน</label>
                                                            <input id="sell_amount" name="sell_amount" type="text" autocomplete="off" required>
                                                        </div>

                                                        <div class="input-field col m12 s12">
                                                            <label for="sell_price">ราคาต่อเครื่อง</label>
                                                            <input id="sell_price" name="sell_price" type="text" autocomplete="off" required>
                                                        </div>
                                                        <div class="input-field col m12 s12">
                                                            <label for="sell_who">ข้อมูลผู้ซื้อ</label>
                                                            <input id="sell_who" name="sell_who" type="text" autocomplete="off">
                                                        </div>

                                                        <div class="input-field col s12">
                                                            <button type="submit" name="add" id="add" class="waves-effect waves-light btn indigo m-b-xs">ADD</button>

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
        <!-- <script src="../assets/js/pages/form_elements.js"></script>
         -->
    </body>

    </html>
<?php } ?>