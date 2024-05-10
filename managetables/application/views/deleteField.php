<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>delete field</title>
<style>
	body{
	    background: radial-gradient(circle at 10% 20%, rgb(90, 92, 106) 0%, rgb(32, 45, 58) 81.3%);
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
		padding: 10px;
	}
	th{
		padding: 10px;
		height: 70px;
  		background-color: #51bfa0;
  		color: white;
	}
	button{
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
</style>
</head>

<body>
	<table style="overflow-x: auto;position: absolute;top: 100px;left: 230px;">
		<tr>
			<th>row</th>
			<th>Column name</th>
			<th>delete</th>
		</tr>
	<?php
		
	$i=1;
	foreach($fileds as $value){
		
		echo '<tr>';	
		if($value['Key']=='PRI' or $value['Field']=='isDeleted'){
				continue;
		}
		echo '<td>'.$i.'</td>';
		echo '<td>'.$value['Field'].'</td>';
		echo '<td><a href="'.base_url().'main/deleteField2/'.$value['Field'].'/'.$tableName.'">delete</a></td>';
		$i++;
		echo '</tr>';
	}
	
	?>
	</table>
<button onClick="window.location.href = '<?php echo base_url()?>main/table/<?php echo $tableName ?>';">back to the table</button>
</body>
</html>