<?php
class dataModel extends CI_Model{
	
	function login($data){
		$sql="select id from admins where username='".$data['username']."' and password='".$data['password']."' and isDeleted=0 ";
		$query=$this->db->query($sql);
		if( $query->num_rows()==1 ){
			$ret=$query->result_array();
			return $ret[0]['id'];
		}
		else{
			return 0;
		}
	}
	
	function newTable($data){
		$sql="CREATE TABLE ".$data['tableName']." (";
		
		
		for($i=1;$i<=$data['number'];$i++){
			
			if($data['key']==$i){
				$key=$data['name'.$i];
			}
			
			$sql2=$data['name'.$i]." ".$data['type'.$i];
			if($data['type'.$i]=="varchar"){
				$sql2=$sql2."(".$data['varchar'.$i].") , ";
			}
			else{
				$sql2=$sql2." , ";
			}
			$sql=$sql.$sql2;
		}
		
		$sql=$sql."isDeleted tinyint  DEFAULT 0 ,PRIMARY KEY (".$key.") )";
		
		$query=$this->db->query($sql);
		
		$sql2="SHOW COLUMNS FROM ".$data['tableName']." FROM managetables";
		$query2=$this->db->query($sql2);
		$COLUMNS=$query2->result_array();
		
		$sql3="insert into ".$data['tableName']."(";
		foreach($COLUMNS as $value){
			if($value['Field']=='isDeleted'){
				break;
			}
			$sql3=$sql3.$value['Field'].",";
		}
		$sql3=$sql3."isDeleted) values(";
		foreach($COLUMNS as $value){
			if($value['Field']=='isDeleted'){
				break;
			}
			$sql3=$sql3."'0', ";
		}
		$sql3=$sql3."'0')";
		$query3=$this->db->query($sql3);
		
	}
	
	
	function tables(){
		$sql="SELECT TABLE_NAME 
			FROM INFORMATION_SCHEMA.TABLES
			WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='managetables'";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	function table($name){
		$sql="SELECT * FROM ".$name." where isDeleted=0";
		$query=$this->db->query($sql);
		$sql2="SHOW index FROM ".$name." WHERE Key_name = 'PRIMARY';";
		$query2=$this->db->query($sql2);
		$data['records']=$query->result_array();
		$a=$query2->result_array();
		$data['key']=$a[0]['Column_name'];
		return $data;
	}
	
	function editRecord($name,$key,$record){
		$sql="select * from ".$name." where ".$key."='".$record."'";
		$query=$this->db->query($sql);
		$sql2="SHOW COLUMNS FROM ".$name." FROM managetables";
		$query2=$this->db->query($sql2);
		$data['record']=$query->result_array();
		$data['fields']=$query2->result_array();
		return $data;
	}
	
	function editRecord2($data){
		$sql2="SHOW COLUMNS FROM ".$data['tableName']." FROM managetables";
		$query2=$this->db->query($sql2);
		$COLUMNS=$query2->result_array();
		$sql="update ".$data['tableName']." set ";
		foreach($COLUMNS as $value){
			if($value['Field']=='isDeleted'){
				$sql=$sql.$value['Field']."='0'";
				break;
			}
			if($value['Key']=='PRI'){
				$k=$value['Field'];
				continue;
			}
			$sql=$sql.$value['Field']."='".$data[$value['Field']]."', ";
		}
		$sql=$sql."where ".$k."='".$data[$k]."'";
		$query=$this->db->query($sql);
	}
	
	function deleteRecord($name,$key,$record){
		$sql="update ".$name." set isDeleted=1 where ".$key."='".$record."'";
		$query=$this->db->query($sql);
	}
	
	function insertNewRecord($name){
		$sql="SHOW COLUMNS FROM ".$name." FROM managetables";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	function insertNewRecord2($data){
		$sql2="SHOW COLUMNS FROM ".$data['tableName']." FROM managetables";
		$query2=$this->db->query($sql2);
		$COLUMNS=$query2->result_array();
		$sql="insert into ".$data['tableName']."(";
		foreach($COLUMNS as $value){
			if($value['Field']=='isDeleted'){
				break;
			}
			$sql=$sql.$value['Field'].",";
		}
		$sql=$sql."isDeleted) values(";
		foreach($COLUMNS as $value){
			if($value['Field']=='isDeleted'){
				break;
			}
			$sql=$sql."'".$data[$value['Field']]."', ";
		}
		$sql=$sql."0)";
		$query=$this->db->query($sql);
	}
	
	public function editTable($tableName){
		$sql="SHOW COLUMNS FROM ".$tableName." FROM managetables";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	public function editTable2($data){
		//rename table
		$sql="ALTER TABLE ".$data['tableOldName']." RENAME ".$data['tableNewName'];
		$query=$this->db->query($sql);
		//rename fields
		$sql2="SHOW COLUMNS FROM ".$data['tableNewName']." FROM managetables";
		$query2=$this->db->query($sql2);
		$COLUMNS=$query2->result_array();
		$sql3="ALTER TABLE ".$data['tableNewName'];
		foreach($COLUMNS as $value){
			if($value['Field']=='isDeleted'){
				break;
			}
			$sql3=$sql3." RENAME COLUMN ".$value['Field']." TO ".$data[$value['Field']]." , ";
		}
		$sql3=$sql3." RENAME COLUMN isDeleted to isDeleted ";
		$query3=$this->db->query($sql3);
		
	}
	
	public function insertNewField($data){
		$sql="ALTER TABLE ".$data['tableName']."
  			ADD ".$data['name'];
		if($data['type']=='int'){
			$sql=$sql." int ";
		}
		else{
			$sql=$sql." varchar(".$data['varchar'].") ";
		}
		$sql=$sql."AFTER isDeleted ";
		$query=$this->db->query($sql);
		$sql2=" ALTER TABLE ".$data['tableName']." MODIFY COLUMN isDeleted int AFTER ".$data['name'];
		$query=$this->db->query($sql2);
	}
	
	public function deleteField($tableName){
		$sql="SHOW COLUMNS FROM ".$tableName." FROM managetables";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	public function deleteField2($fieldName,$tableName){
		$sql="ALTER TABLE ".$tableName." DROP COLUMN ".$fieldName;
		$query=$this->db->query($sql);
	}
	
	public function admins(){
		$sql="select * from admins where isDeleted='0' order by id";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	public function insertNewAdmin($data,$image){
		//$sql="INSERT INTO admins(fname, lname, email, username, password, image, isDeleted) VALUES ('".$data['fname']."', '".$data['lname']."', '".$data['email']."', '".$data['username']."' , '".md5($data['password'])."', '".$image['image']['name']."', 0);";
		$sql="INSERT INTO admins(fname, lname, email, username, password, isDeleted) VALUES ('".$data['fname']."', '".$data['lname']."', '".$data['email']."', '".$data['username']."' , '".md5($data['password'])."',0);";
		$query=$this->db->query($sql);
		//move_uploaded_file($image['image']['tmp_name'],'images/'.$data['username'].'.png');

	}
	
	public function editAdmin($id){
		$sql="select * from admins where id=".$id ;
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	public function editAdmin2($data){
		$sql="update admins set fname='".$data['fname']."' , lname='".$data['lname']."' , email='".$data['email']."' , username='".$data['username']."' , password='".md5($data['password'])."' where id=".$data['id'];
		$query=$this->db->query($sql);
	}
	
	public function deleteAdmin($id){
		$sql="update admins set isDeleted='1' where id=".$id;
		$query=$this->db->query($sql);
	}
	
	public function deleteTable($tableName){
		$sql="drop table ".$tableName;
		$query=$this->db->query($sql);
	}
	
	public function getVarcharFieldLength($tableName,$fieldName){
		$sql="SELECT CHARACTER_maximum_length from information_schema.columns WHERE TABLE_schema='managetables' and TABLE_NAME='".$tableName."' and COlUmn_name='".$fieldName."' and DATA_type='varchar'";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	
}