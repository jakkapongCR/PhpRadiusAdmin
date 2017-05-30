<?php
    include"database.class.php";
    $db = new Database();
    $user_all = $db->get_user_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

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
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> บัญชีผู้ใช้งานทั้งหมด</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                       <thead>
                                            <tr>
                                                <th width="3%"><center><input type="checkbox" aria-label="..."></center></th>
                                                <th align="center" width="5%">ลำดับ</th>
                                                <th width="20%">ชื่อผู้ใช้งาน</th>
                                                <th width="30%">รายละเอียด</th>
                                                <th width="27%">กลุ่ม / โปรไฟล์</th>
                                                <th width="15%">การจัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                if(!empty($user_all)){
                                                    foreach($user_all as $userall){
                                            ?>
                                                    <tr>
                                                        <td align="center"><input type="checkbox" aria-label="..."></td>
                                                        <td align="center"><?php echo $i?></td>
                                                        <td><?php echo $userall['username']?></td>
                                                        <td></td>
                                                        <td><?php echo $userall['name_group']?></td>
                                                        <td><span><a class="glyphicon glyphicon-pencil"></a><a class="glyphicon glyphicon-trash"></a></span></td>
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