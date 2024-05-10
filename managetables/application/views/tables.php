<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>tables</title>
<style>
	body{
	    background: linear-gradient(60deg, #bdc3c7 , #2c3e50);
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
	<div style="overflow-x: auto;position: absolute;top: 100px;left: 230px;">
		<table>
			<tr>
				<th style="width: 50px;">row</th>
				<th style="width: 100px;">table name</th>
			</tr>
		<?php

		$i=1;
		foreach($tables as $value){

			echo '<tr>';
			foreach($value as $row){
				if($row=='admins'){
					$i--;
					continue;
				}
				echo '<td>'.$i.'</td>';
				echo '<td><a href="'.base_url().'main/table/'.$row.'">'.$row.'</a></td>';

			}
			$i++;
			echo '</tr>';
		}

		?>

		</table>
	</div>
	<button onclick="window.location.href = '<?php echo base_url()?>main/dashbord/';">back to dashbord</button>
</body>
</html>