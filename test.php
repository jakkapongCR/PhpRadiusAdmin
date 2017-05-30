<?php 
	include"database.class.php";
	$db = new database();
	$show = $db->get_top10();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Document</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>

	<div id="wrapper">
	    <div id="page-wrapper">
        	<div class="container-fluid">
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
							if(!empty($show)){
								foreach($show as $user){
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
</body>
</html>