<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {
	

	public function index()
	{
		$this->load->library('form_validation');
		$data['true']=1;
		$this->load->view('login',$data);
	}
	
	public function login()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', 'username' , 'alpha_numeric|required',
        						array('required' => 'please enter your username',
									  'alpha_numeric' => 'Only integers and letters are allowed for this field'));
		
		$this->form_validation->set_rules('password', ' password ' , 'alpha_numeric|required',
        						array('required' => 'please enter your password',
									  'alpha_numeric' => 'Only integers and letters are allowed for this field'));
		
		if ($this->form_validation->run() == FALSE){
			$this->index();
        }
        else{
			$id=$this->dataModel->login($_POST);
			if($id==0){
				$data['true']=0;
				$this->load->view('login',$data);
			}
			else{
				$this->load->view('dashbord');
			}
	    }
	}
	
	public function dashbord()
	{
		$this->load->view('dashbord');
	}
	public function columnCount()
	{
		$this->load->library('form_validation');
		$this->load->view('columnCount');
	}
	
	public function newTable()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('columnount', 'columnount' , 'required',
										array('required' => 'Enter the number of columns in the table'));
		if ($this->form_validation->run() == FALSE){
			$this->load->view('columnCount');
        }
        else{
			$data['number']=$_POST['columnount'];
			$this->load->view('newTable',$data);
	    }
	}
	
	public function newTable2()
	{
		$this->load->library('form_validation');
		
		$tables=$this->dataModel->tables();

		$set=0;
		foreach($tables as $row){
			if($set==1) break;
			foreach($row as $tableName){
				
				if($tableName==$_POST['tableName']){
					$this->form_validation->set_rules('tableName', 'tableName' , 'max_length[9]|alpha_numeric|required|matches[]',
										array('matches' => 'There is a table with this name. Please choose another name',
											  'required' => 'Enter the name of the table',
											  'max_length' => 'The maximum length of the table name is 9 characters',
											  'alpha_numeric' => 'Only letters and numbers are allowed for the table name'));
					$set=1;
				}
			}
		}
		
		if($set==0){
			$this->form_validation->set_rules('tableName', 'tableName' , 'max_length[9]|alpha_numeric|required',
										array('required' => 'Enter the name of the table',
											  'max_length' => 'The maximum length of the table name is 9 characters',
											  'alpha_numeric' => 'Only letters and numbers are allowed for the table name'));
		}

		$i=$_POST['number'];
		for($j=1;$j<=$i;$j++){
			$a[$j]=$_POST['name'.$j];
		}
		$sett=0;
		for ($k=1;$k<=$i;$k++) {
  			for ($l=$k+1;$l<=$i;$l++) {
				if($a[$l]==$a[$k]){
					$this->form_validation->set_rules('name'.$k, 'name'.$k , 'max_length[9]|alpha_numeric|required|matches[]',
								array('matches' => 'Column names must be different',
									  'required' => 'Enter the column name',
									  'max_length' => 'The maximum length of the column name is 9 characters',
									  'alpha_numeric' => 'Only letters and numbers are allowed for this column'));
					$sett=1;
					break;
				}	
  			}
			if($sett==1){
				$sett=0;
				continue;
			}
			$this->form_validation->set_rules('name'.$k, 'name'.$k , 'max_length[9]|alpha_numeric|required',
								array('required' => 'Enter the column name',
									  'max_length' => 'The maximum length of the column name is 9 characters',
									  'alpha_numeric' => 'Only letters and numbers are allowed for this column'));
		}
		
		$this->form_validation->set_rules('name'.$i, 'name'.$i , 'max_length[9]|alpha_numeric|required',
							array('required' => 'Enter the column name',
								  'max_length' => 'The maximum length of the column name is 9 characters',
								  'alpha_numeric' => 'Only letters and numbers are allowed for this column'));
		
		
		for ($k=1;$k<=$i;$k++) {
			if($_POST['type'.$k]=='varchar'){
				$this->form_validation->set_rules('varchar'.$k, 'varchar'.$k , 'required',
						array('required' => 'Specify the number of characters in this field'));
			}		
		}
		
		if ($this->form_validation->run() == FALSE){
			$data['number']=$_POST['number'];
			$this->load->view('newTable',$data);
        }
        else{
			$this->dataModel->newTable($_POST);
			$this->tables();
	    }
		
	}
	
	public function tables()
	{
		$data['tables']=$this->dataModel->tables();
		$this->load->view('tables',$data);
	}
	
	public function table($name)
	{
		$return=$this->dataModel->table($name);
		$data['table']=$return['records'];
		$data['key']=$return['key'];
		$data['tableName']=$name;
		$this->load->view('table',$data);
	}
	
	public function editRecord($tableName,$key,$record)
	{
		$this->load->library('form_validation');
		$a=$this->dataModel->editRecord($tableName,$key,$record);
		$data['record']=$a['record'];
		$data['fields']=$a['fields'];
		$data['tableName']=$tableName;
		$this->load->view('edit',$data);
	}
	
	public function editRecord2()
	{	
		$this->load->library('form_validation');
		
		$fields=$this->dataModel->insertNewRecord($_POST['tableName']);
		foreach($fields as $row){
			if($row['Field']=='isDeleted'){
				continue;
			}
			if($row['Key']=='PRI'){
				$key=$row['Field'];	
				continue;
			}
			if($row['Type']=='int'){
				$this->form_validation->set_rules($row['Field'], $row['Field'] , 'integer|max_length[9]',
						array('max_length' => 'The maximum acceptable length for this field is 9 digits',
							  'integer' => 'Only integers are allowed for this column'));
			}
			else{
				$n=$this->dataModel->getVarcharFieldLength($_POST['tableName'],$row['Field']);
				$this->form_validation->set_rules($row['Field'], $row['Field'] , 'alpha_numeric|max_length['.$n[0]		['CHARACTER_MAXIMUM_LENGTH'].']',
							array('max_length' => 'The maximum acceptable length for this field is '.$n[0]['CHARACTER_MAXIMUM_LENGTH'].' character',
								  'alpha_numeric' => 'Only letters and numbers are allowed for this column'));
			}
		}
				
		if ($this->form_validation->run() == FALSE){
			$a=$this->dataModel->editRecord($_POST['tableName'],$key,$_POST[$key]);
			$data['record']=$a['record'];
			$data['fields']=$a['fields'];
			$data['tableName']=$_POST['tableName'];
			$this->load->view('edit',$data);
        }
        else{
			$this->dataModel->editRecord2($_POST);
			$this->table($_POST['tableName']);
	    }
	}
	
	public function deleteRecord($tableName,$key,$record)
	{
		$this->dataModel->deleteRecord($tableName,$key,$record);
		$this->table($tableName);
	}
	
	public function insertNewRecord($tableName)
	{
		$this->load->library('form_validation');
		$data['fields']=$this->dataModel->insertNewRecord($tableName);
		$data['tableName']=$tableName;
		$this->load->view('insertNewRecord',$data);
	}
	
	public function insertNewRecord2()
	{
		$this->load->library('form_validation');
		
		$fields=$this->dataModel->insertNewRecord($_POST['tableName']);
		foreach($fields as $row){
			if($row['Field']=='isDeleted'){
					continue;
				}
			if($row['Key']=='PRI'){
					if($row['Type']=='int'){
						$this->form_validation->set_rules($row['Field'], $row['Field'] , 'integer|required|max_length[9]|is_unique['.$_POST['tableName'].'.'.$row['Field'].']',
        						array('max_length' => 'The maximum acceptable length for this field is 9 digits',
									  'required' => 'This field is the primary key of the table and it is necessary to fill it',
									  'integer' => 'Only digits are allowed for this field',
									 'is_unique' => 'This field is the primary key and its value must be unique'));
					}
					else{
						$n=$this->dataModel->getVarcharFieldLength($_POST['tableName'],$row['Field']);
						$this->form_validation->set_rules($row['Field'], $row['Field'] , 'required|is_unique['.$_POST['tableName'].'.'.$row['Field'].']|max_length['.$n[0]['CHARACTER_MAXIMUM_LENGTH'].']|alpha_numeric',
        						array('max_length' => 'The maximum acceptable length for this field is '.$n[0]['CHARACTER_MAXIMUM_LENGTH'].' character',
									  'required' => 'This field is the primary key of the table and it is necessary to fill it',
									  'alpha_numeric' => 'Only letters and numbers are allowed for this field',
									  'is_unique' => 'This field is the primary key and its value must be unique'));
					}
				}
			
			else{
				if($row['Type']=='int'){
						$this->form_validation->set_rules($row['Field'], $row['Field'] , 'integer|max_length[9]',
        						array('max_length' => 'The maximum acceptable length for this field is 9 digits',
									  'integer' => 'Only integers are allowed for this column'));
						
					}
				else{
					$n=$this->dataModel->getVarcharFieldLength($_POST['tableName'],$row['Field']);
					$this->form_validation->set_rules($row['Field'], $row['Field'] , 'alpha_numeric|max_length['.$n[0]['CHARACTER_MAXIMUM_LENGTH'].']',
        						array('max_length' => 'The maximum acceptable length for this field is '.$n[0]['CHARACTER_MAXIMUM_LENGTH'].' character',
									  'alpha_numeric' => 'Only letters and numbers are allowed for this field'));
				}
			}
		}
		
		
		if ($this->form_validation->run() == FALSE){
			$data['fields']=$this->dataModel->insertNewRecord($_POST['tableName']);
			$data['tableName']=$_POST['tableName'];
			$this->load->view('insertNewRecord',$data);
        }
        else{
			$this->dataModel->insertNewRecord2($_POST);
			$this->table($_POST['tableName']);
	    }
	}
	
	
	
	public function editTable($tableName)
	{
		$this->load->library('form_validation');
		$data['fields']=$this->dataModel->editTable($tableName);
		$data['tableName']=$tableName;
		$this->load->view('editTable',$data);
	}
	
	public function editTable2()
	{
		$this->load->library('form_validation');
		
		$tables=$this->dataModel->tables();

		$set=0;
		foreach($tables as $row){
			if($set==1)
				break;
			foreach($row as $tableName){
				if($tableName==$_POST['tableNewName'] and $_POST['tableOldName']!=$_POST['tableNewName']){
					$this->form_validation->set_rules('tableNewName', 'tableNewName' , 'max_length[9]|alpha_numeric|required|matches[]',
										array('matches' => 'There is a table with this name. Please choose another name',
											  'required' => 'Enter the table name',
											  'max_length' => 'The maximum length of the table name is 9 characters',
											  'alpha_numeric' => 'Only letters and numbers are allowed for this field'));
					$set=1;
				}
			}
		}
		
		if($set==0){
			$this->form_validation->set_rules('tableNewName', 'tableNewName' , 'max_length[9]|alpha_numeric|required',
										array('required' => 'Enter the table name',
											  'max_length' => 'The maximum length of the table name is 9 characters',
											  'alpha_numeric' => 'Only letters and numbers are allowed for this field'));
		}

		$fields=$this->dataModel->editTable($_POST['tableOldName']);
		$i=count($fields)-1;
		for($j=0;$j<$i;$j++){
			$a[$j]=$fields[$j]['Field'];
		}
		$sett=0;
		for ($k=0;$k<$i;$k++) {
  			for ($l=$k+1;$l<$i;$l++) {
				$this->form_validation->set_rules($a[$k], $a[$k] , 'max_length[9]|alpha_numeric|required|differs['.$_POST[$a[$l]].']',
							array('differs' => 'Column names must be different',
								  'required' => 'Enter the column name',
								  'max_length' => 'The maximum length of the column name is 9 characters',
								  'alpha_numeric' => 'Only letters and numbers are allowed for this field'));
				$sett=1;
				break;	
  			}
			if($sett==1){
				$sett=0;
				continue;
			}
			$this->form_validation->set_rules( $a[$k] , $a[$k] , 'max_length[9]|alpha_numeric|required' ,
								array('required' => 'Enter the column name',
									  'max_length' => 'The maximum length of the column name is 9 characters',
									  'alpha_numeric' => 'Only letters and numbers are allowed for this field'));
		}

		if ($this->form_validation->run() == FALSE){
			$data['fields']=$fields;
			$data['tableName']=$_POST['tableOldName'];
			$this->load->view('editTable',$data);
        }
        else{
			$this->dataModel->editTable2($_POST);
			$this->table($_POST['tableNewName']);
	    }
	}
	
	public function deleteTable($tableName){
		$this->dataModel->deleteTable($tableName);
		echo '<script>alert("Your selected table has been successfully deleted!");window.location= "'.base_url().'main/tables/"</script>';
	}
	
	public function insertNewField($tableName)
	{
		$this->load->library('form_validation');
		$data['tableName']=$tableName;
		$this->load->view('insertNewField',$data);
	}
	
	public function insertNewField2()
	{
		$this->load->library('form_validation');
		$fields=$this->dataModel->editTable($_POST['tableName']);
		$i=count($fields)-1;
		for($j=0;$j<$i;$j++){
			$a[$j]=$fields[$j]['Field'];
		}
		$sett=0;
		for($j=0;$j<$i;$j++){
  			if($a[$j]==$_POST['name']){
				$this->form_validation->set_rules('name', 'name' , 'max_length[9]|alpha_numeric|required|matches[]',
							array('matches' => 'There is a column with this name, please choose another name',
								  'required' => 'Enter the column name',
								  'max_length' => 'The maximum length of the column name is 9 characters',
								  'alpha_numeric' => 'Only letters and numbers are allowed for this field'));
				$sett=1;
				break;	
  			}
		}
		
		if($sett==0){
			$this->form_validation->set_rules('name' , 'name' , 'max_length[9]|alpha_numeric|required' ,
						array('required' => 'Enter the column name',
							  'max_length' => 'The maximum length of the column name is 9 characters',
							  'alpha_numeric' => 'Only letters and numbers are allowed for this field'));
		}
		
		if($_POST['type']=='varchar'){
			$this->form_validation->set_rules('varchar', 'varchar', 'required',
					array('required' => 'Specify the number of characters in this field'));
		}		

		if ($this->form_validation->run() == FALSE){
			$data['tableName']=$_POST['tableName'];
			$this->load->view('insertNewField',$data);
        }
        else{
			$this->dataModel->insertNewField($_POST);
			$this->table($_POST['tableName']);
	    }
		
	}
	
	public function deleteField($tableName)
	{
		$data['fileds']=$this->dataModel->deleteField($tableName);
		$data['tableName']=$tableName;
		$this->load->view('deleteField',$data);
	}
	
	public function deleteField2($fieldName,$tableName)
	{
		$this->dataModel->deleteField2($fieldName,$tableName);
		echo '<script>alert("Your selected column has been successfully deleted!");window.location= "'.base_url().'main/table/'.$tableName.'/"</script>';
	}
	
	public function admins(){
		$data['info']=$this->dataModel->admins();
		$this->load->view('admins',$data);
	}
	
	public function insertNewAdmin(){
		$this->load->library('form_validation');
		$this->load->view('insertNewAdmin');
	}
	
	public function insertNewAdmin2(){
		$this->load->library('form_validation');
				
		$this->form_validation->set_rules('fname', 'fname' , 'max_length[20]|alpha_numeric',
        						array('max_length' => 'The maximum number of characters in the admin\' first name is 20 characters',
									  'alpha_numeric' => 'Only letters and numbers are allowed for this field'));
		$this->form_validation->set_rules('lname', 'lname' , 'max_length[20]|alpha_numeric',
        						array('max_length' => 'The maximum number of characters in the admin\' last name is 20 characters',
									  'alpha_numeric' => 'Only letters and numbers are allowed for this field'));
		$this->form_validation->set_rules('email', 'email' , 'max_length[40]|valid_email',
								array('max_length' => 'The maximum length of the email is 40 characters',
									  'valid_email' => 'The entered email is invalid'));
		$this->form_validation->set_rules( 'username' , 'username' , 'max_length[15]|alpha_numeric|required' ,
								array('required' => 'It is necessary to fill in the username field',
									  'max_length' => 'The maximum length of the username is 15 characters',						 'alpha_numeric' => 'Only letters and numbers are allowed for the username'));
		$this->form_validation->set_rules( 'password' , 'password' , 'exact_length[8]|alpha_numeric_spaces' ,
								array('exact_length' => 'The length of the password must be exactly 8 characters',						  'alpha_numeric_spaces' => 'Only letters and numbers and empty passwords are allowed'));
		 
		if ($this->form_validation->run() == FALSE){
			$this->load->view('insertNewAdmin');
        }
        else{
			$this->dataModel->insertNewAdmin($_POST,$_FILES);
			$this->admins();
	    }
	}
	
	public function editAdmin($id){
		$this->load->library('form_validation');
		$data['info']=$this->dataModel->editAdmin($id);	
		$this->load->view('editAdmin',$data);
	}
	
	public function editAdmin2(){
		$this->load->library('form_validation');
				
		$this->form_validation->set_rules('fname', 'fname' , 'max_length[20]|alpha_numeric',
        						array('max_length' => 'The maximum number of characters in admin\'s first name is 20 characters',
									  'alpha_numeric' => 'Only letters and numbers are allowed for this field'));
		$this->form_validation->set_rules('lname', 'lname' , 'max_length[20]|alpha_numeric',
        						array('max_length' => 'The maximum number of characters in the admin\' last name is 20 characters',
									  'alpha_numeric' => 'Only letters and numbers are allowed for this field'));
		$this->form_validation->set_rules('email', 'email' , 'max_length[40]|valid_email',
								array('max_length' => 'The maximum length of the email is 40 characters',
									  'valid_email' => 'The entered email is invalid'));
		$this->form_validation->set_rules( 'username' , 'username' , 'max_length[15]|alpha_numeric|required' ,
								array('required' => 'It is necessary to fill in the username field',
									  'max_length' => 'The maximum length of the username is 15 characters',						'alpha_numeric' => 'Only letters and numbers are allowed for the username'));
		$this->form_validation->set_rules( 'password' , 'password' , 'exact_length[8]|alpha_numeric_spaces' ,
								array('exact_length' => 'The length of the password must be exactly 8 characters',						  'alpha_numeric_spaces' => 'Only letters and numbers and empty passwords are allowed'));
		 
		if ($this->form_validation->run() == FALSE){
			$data['info']=$this->dataModel->editAdmin($_POST['id']);	
			$this->load->view('editAdmin',$data);
        }
        else{
			$this->dataModel->editAdmin2($_POST);	
			$this->admins();
	    }
	}
	
	public function deleteAdmin($id){
		$this->dataModel->deleteAdmin($id);	
		$this->admins();
	}
	
	
	
	
	
	
}
