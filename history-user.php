<?php
    include"database.class.php";
    $db = new Database();
    $user_history_user = $db->get_history_user();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ประวัติผู้ใช้งานทั้งหมด</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <?php include"template/navbar.html"; ?>

        <!-- Navigation -->

        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Statistics Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> ประวัติของผู้ใช้งานทั้งหมด</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                       <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>ชื่อผู้ใช้งาน</th>
                                                <th>ดาวน์โหลด</th>
                                                <th>อัปโหลด</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                                $i = 1;
                                                if(!empty($user_history_user)){
                                                    foreach($user_history_user as $user){
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i?></td>
                                                        <td><?php echo $user['username']?></td>
                                                        <td><?php
                                                                //echo "echo :" . $user['download'] . "++++";
                                                                $user_download[] = $db->convert_banwidth($user['download']);
                                                                echo number_format($user_download[$i-1][0],'2','.','') . " " . $user_download[$i-1][1];
                                                            ?>
                                                        </td>
                                                        <td><?php
                                                                //echo "echo :" . $user['download'] . "++++";
                                                                $user_upload[] = $db->convert_banwidth($user['upload']);
                                                                echo number_format($user_upload[$i-1][0],'2','.','') . " " . $user_upload[$i-1][1];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                
                                            <?php
                                                    $i++;
                                                    }
                                                }else{
                                                    echo "<tr><td colspan='5'>ไม่พบข้อมูล</td></tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>