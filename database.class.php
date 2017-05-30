<?php
class Database {
 
       private $host = 'localhost'; //ชื่อ Host 
	   private $user = 'root'; //ชื่อผู้ใช้งาน ฐานข้อมูล
	   private $password = ''; // password สำหรับเข้าจัดการฐานข้อมูล
	   private $database = 'radius'; //ชื่อ ฐานข้อมูล

	//function เชื่อมต่อฐานข้อมูล
	protected function connect(){
		
		$mysqli = new mysqli($this->host,$this->user,$this->password,$this->database);
			
			//$mysqli->set_charset("utf8");

			//if ($mysqli->connect_error) {
			if ($mysqli->connect_errno) {

			    die('Connect Error: ' . $mysqli->connect_error);
			}

		return $mysqli;
	}
	
	//function เรื่ยกดูข้อมูลผู้ใช้งทั้งหมด
	public function get_userall(){
		
		$db = $this->connect();
		$sql = "SELECT COUNT(username) FROM radcheck";
		$get_userall = $db->query($sql);

		//while($user = $get_userall->fetch_assoc()){
			$result = $get_userall->fetch_assoc();
		//}
		
		if(!empty($result)){
			return $result;
		}
	}
	//function เรื่ยกดูข้อมูลผู้ใช้ออนไลน์
	public function get_useronline(){
		
		$db = $this->connect();
		$sql = "SELECT COUNT(radacctid) FROM radacct WHERE acctstoptime IS NULL";
		$get_useronline = $db->query($sql);

		//while($user = $get_useronline->fetch_assoc()){
			$result = $get_useronline->fetch_assoc();
		//}
		
		if(!empty($result)){
			return $result;
		}
	}
	
	//function เรื่ยกดูข้อมูลผู้ใช้งานไปแล้ว
	public function get_useruse(){
		
		$db = $this->connect();
		$sql = "SELECT COUNT(DISTINCT(username)) AS useruse FROM radacct";
		$get_useruse = $db->query($sql);

		//while($user = $get_useruse->fetch_assoc()){
			$result = $get_useruse->fetch_assoc();
		//}
		
		if(!empty($result)){
			return $result;
		}
	}
	//function เรื่ยกดูข้อมูลผู้ใช้ออนไลน์ 
	public function get_userreject(){
		
		$db = $this->connect();
		$sql = "SELECT COUNT(id) FROM radpostauth WHERE reply = 'Access-Reject' AND date(authdate) = curdate()";
		$get_userreject = $db->query($sql);

		//while($user = $get_userreject->fetch_assoc()){
			$result = $get_userreject->fetch_assoc();
		//}
		
		if(!empty($result)){
			return $result;
		}
	}
	// function แสดงผู้ใช้งานที่มีการดาวน์โหลดเยอะที่สุด
	public function get_top10(){

		$db = $this->connect();
		$sql = "SELECT username,SUM(acctoutputoctets) AS download, SUM(acctinputoctets) AS upload,acctstarttime FROM radacct GROUP BY username HAVING acctstarttime >= date_add(curdate(),interval -7 day) ORDER BY SUM(acctoutputoctets) DESC LIMIT 10";
		$get_top10 = $db->query($sql);

		while($top10 = $get_top10->fetch_assoc()){
			$result[] = $top10;
		}
		
		if(!empty($result)){
			return $result;
		}
		$db->close();
	}
	// function แสดงประวัติผู้ใช้งานทั้งหมด
	public function get_history_user(){

		$db = $this->connect();
		$sql = "SELECT username,SUM(acctoutputoctets) AS download, SUM(acctinputoctets) AS upload,acctstarttime FROM radacct GROUP BY username HAVING acctstarttime >= date_add(curdate(),interval -7 day) ORDER BY SUM(acctoutputoctets) DESC";
		$get_history = $db->query($sql);

		while($history = $get_history->fetch_assoc()){
			$result[] = $history;
		}
		
		if(!empty($result)){
			return $result;
		}
		$db->close();
	}
	// function คำนวณ Mb / Gb
	public function convert_banwidth($banwidth){

		if ($banwidth > 1073741824) {
			$result[] = $banwidth / 1073741824 ;
			$result[] = "Gb";
		}
		else{
			$result[] = $banwidth / 1048576 ;
			$result[] = "Mb";
		}

		if (!empty($result)) {

			return $result;
		}	
	}
	// function แสดงโปรไฟล์ทั้งหมด
	public function get_profile(){

		$db = $this->connect();
		$sql1 = "SELECT radusergroup.id_group,radusergroup.name_group,radgroupcheck.attribute AS att_check,radgroupcheck.groupcheck_value AS values_check FROM radusergroup LEFT JOIN radgroupcheck ON radusergroup.id_group=radgroupcheck.id_group ORDER BY radusergroup.id_group";
		$sql2 = "SELECT radusergroup.id_group,radusergroup.name_group,radgroupreply.attribute AS att_reply,radgroupreply.value AS values_reply FROM radusergroup LEFT JOIN radgroupreply ON radusergroup.id_group=radgroupreply.id_group ORDER BY radusergroup.id_group";

		$get_profile1 = $db->query($sql1);
		$get_profile2 = $db->query($sql2);

		while($profile = $get_profile1->fetch_assoc()){
			$result[] = $profile;
		}

		if(!empty($result)){
			return $result;
		}		
	}
}
?>
