<?php 
	include"database.class.php";
	$db = new database();
	$show = $db->get_user_all();
	echo "<pre>";
	print_r($show);
	echo "</pre>";
?>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <table class="table table-bordered table-hover table-striped">
       <thead>
            <tr>
                <th>ลำดับกลุ่ม</th>
                <th>ชื่อกลุ่ม</th>
                <th>แอคทริบิวด์</th>
                <th>ค่า</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($show)){
                    foreach($show as $user){
            ?>
                    <tr>
                        <td><?php echo $user['id_group']?></td>
                        <td><?php echo $user['name_group']; ?></td>
                        <td><?php echo $user['att_check']; ?></td>
                        <td><?php echo $user['values_check']; ?></td>
                    </tr>
            <?php
                    }
                }else{
                    echo "<tr><td colspan='5'>ไม่พบข้อมูล</td></tr>";
                }
            ?>
        </tbody>
    </table>