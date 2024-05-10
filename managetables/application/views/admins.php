<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>admins</title>
<style>
body {
	background: linear-gradient(99.6deg, rgb(112, 128, 152) 10.6%, rgb(242, 227, 234) 32.9%, rgb(234, 202, 213) 52.7%, rgb(220, 227, 239) 72.8%, rgb(185, 205, 227) 81.1%, rgb(154, 180, 212) 102.4%);
	font-family: sans-serif;
}
table,td,tr,th{
		border-collapse:collapse;
		background-color: #ffffff;
		border: 0.5px solid #555555;
		font-size: 20px;
	}
	td{
  		height: 70px;
		text-align: center;
		padding: 5px;
	}
	th{
		padding: 5px;
		height: 70px;
  		background-color: #51bfa0;
  		color: white;
	}
	#back{
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
	}
	#back:hover {
		background-color: #555555;
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
  		color: white;
	}
	#record{
   		background-color: #ffffff; 
  		border: 1px solid #555555;
  		color: white;
    	padding: 10px;
  		text-align: center;
  		display: inline-block;
  		font-size: 19px;
		transition-duration: 0.4s;
   		color: #080710;
    	font-weight: 600;
    	border-radius: 12px;
    	cursor: pointer;
		width: 200px;
	}
	#record:hover {
		background-color: rgb(178, 14, 14);
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
  		color: white;
	}
</style>
</head>

<body>
	<div style="position: absolute;left: 230px; top: 120px;">
	<table >
		<tr>
			<th>id</th>
			<th>first name</th>
			<th>last name</th>
			<th>email</th>
			<th>username</th>
			<th>password</th>
			<th>edit</th>
			<th>delete</th>
		</tr>
		<?php
		$i=1;
		foreach($info as $row){
			echo '<tr>';
			foreach($row as $key=>$value){	
				if($key=='isDeleted'){
					continue;
				}
				echo '<td>'.$value.'</td>';
				$i++;
				}
			$i+=2;
			echo '<td><a href="'.base_url().'main/editAdmin/'.$row['id'].'">edit</a></td>';
			echo '<td><a href="'.base_url().'main/deleteAdmin/'.$row['id'].'">delete</a></td>';
			echo '</tr>';
		}

		?>	
	<tr><td colspan="<?php echo $i ?>"><button id="record" onClick="window.location.href ='<?php echo base_url()?>main/insertNewAdmin/';">add admin</button></td></tr>
	</table>
	</div>
		<br><br>
<button id="back" onClick="window.location.href = '<?php echo base_url()?>main/dashbord/';">back to dashbord</button>	
</body>
</html>