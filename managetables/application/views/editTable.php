<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Table</title>
</head>
<style>
	body{
	    background: radial-gradient(circle at 10% 20%, rgb(90, 92, 106) 0%, rgb(32, 45, 58) 81.3%);
		font-size: 20px;
	}
	form{
		position: absolute;
		top: 120px;
		left: 230px;
		text-align: center;
	}
	input{
		padding: 5px;
	}
	#i{
		background-color: #A7BFE8;
		color: #000000;
		padding: 5px;
	}
	button {
   		background-color: #ffffff; 
  		border: 1px solid #555555;
  		color: white;
    	padding: 15px 0;
  		text-align: center;
  		display: inline-block;
  		font-size: 19px;
		transition-duration: 0.4s;
		margin-top: 50px;
    	width: 180px;
   		color: #080710;
    	font-weight: 600;
    	border-radius: 12px;
    	cursor: pointer;
		position: absolute;
		left: 40px;
	}
	button:hover {
		background-color: #555555;
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
  		color: white;
	}
	 #sub{
   		background-color: #ffffff; 
  		border: 1px solid #555555;
  		color: white;
    	padding: 10px;
  		text-align: center;
  		display: inline-block;
  		font-size: 19px;
		transition-duration: 0.4s;
		margin-top: 50px;
   		color: #080710;
    	font-weight: 600;
    	border-radius: 12px;
    	cursor: pointer;
	}
	#sub:hover {
		background-color: rgb(178, 14, 14);
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
  		color: white;
	}
	
</style>
<body>
	<form action="<?php echo base_url() ?>main/editTable2/" method="post">

        <label style="background-color: #BA990C; padding: 5px;" for="tableName">Name of the table</label>
		
		<input type="hidden" name="tableOldName" value="<?php echo $tableName ?>">
        <input type="text" name="tableNewName" value="<?php echo $tableName ?>"><br><br><br>
		<font color="black" style="text-shadow: 2px 2px 4px red;"><?php echo form_error('tableNewName'); ?></font><br><br>
		<br>

		<?php
			
			foreach($fields as $row){
				if($row['Field']=='isDeleted'){
					continue;
				}
				echo
					'
					<label id="i" for="'.$row['Field'].'">Column name</label>
					<input type="text" name="'.$row['Field'].'" value="'.$row['Field'].'">
					<font color="black" style="text-shadow: 2px 2px 4px red;">'.form_error($row['Field']).'</font><br><br>
					<br><br>
					';	
			}
		?>
		
		
		<input id="sub" type="submit" name="submit" value="apply changes">
    </form>
<button onClick="window.location.href = '<?php echo base_url()?>main/table/<?php echo $tableName ?>';">Back to the table</button>
</body>
</html>