<?php
	$i=0;
	foreach($table as $row){
		foreach($row as $keys=>$value){
			if($keys=='isDeleted'){
				continue;
			}
			$i++;
		}
		$i+=2;
		break;
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>table</title>
<style>
	body{
	    background: linear-gradient(60deg, #4D4855 , #A399B2);
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
		padding: 5px;
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
		position: absolute;
		left: 40px;
	}
	#back:hover {
		background-color: #555555;
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
  		color: white;
	}
	
	#record{
		height: 60px;
		width: <?php echo $i*40 ?>px;
   		background-color: #ffffff;
  		text-align: center;
  		display: inline-block;
  		font-size: 19px;
		transition-duration: 0.4s;
   		color: #080710;
    	font-weight: 600;
    	cursor: pointer;
		border: none;
	}
	#record:hover {
		background-color: #787878;
  		color: white;
	}
	
</style>
</head>

<body>
	<div style="overflow-x: auto;position: absolute;top: 100px;left: 230px;">
	<table>
		<tr><td colspan="<?php echo $i?>"><button id="record" onClick="window.location.href ='<?php echo base_url()?>main/insertNewField/<?php echo $tableName ?>';">Add column</button></td></tr>
		<tr><td colspan="<?php echo $i?>"><button id="record" onClick="window.location.href ='<?php echo base_url()?>main/deleteField/<?php echo $tableName ?>';">delete column</button></td></tr>
		<tr><td colspan="<?php echo $i?>"><button id="record" onClick="window.location.href = '<?php echo base_url()?>main/editTable/<?php echo $tableName ?>';">edit table</button></td></tr>
		<tr><td colspan="<?php echo $i?>"><button id="record" onClick="window.location.href = '<?php echo base_url()?>main/deleteTable/<?php echo $tableName ?>';">delete the table</button></td></tr>
		<!--<tr><td colspan="<?php echo $i?>"><button id="record" onClick="print()">print</button></td></tr>-->
		<tr><td style="background-color: #000000; color: #ffffff" colspan="<?php echo $i?>"><h3><?php echo $tableName ?></h3></td></tr>
			<?php
			$i=0;
			foreach($table as $row){
				foreach($row as $keys=>$value){
					if($keys=='isDeleted'){
						continue;
					}
					echo '<th>'.$keys.'</th>';
					$i++;
				}
				$i+=2;
				echo '<th>edit</th>';
				echo '<th>delete</th>';
				break;
			}
			?>
		</tr>
		<?php
		foreach($table as $row){
			echo '<tr>';
			if($row[$key]=='0'){
					continue;
			}
				foreach($row as $k=>$value){
					if($k=='isDeleted'){
						continue;
					}

					echo '<td>'.$value.'</td>';
				}

				echo '<td><a style="color: cadetblue" href="'.base_url().'/main/editRecord/'.$tableName.'/'.$key.'/'.$row[$key].'">edit</a></td>';
				echo '<td><a style="color: darkslateblue" href="'.base_url().'/main/deleteRecord/'.$tableName.'/'.$key.'/'.$row[$key].'">delete</a></td>';
			echo '</tr>';
			}			
		?>
		<tr><td colspan="<?php echo $i?>"><button id="record" onClick="window.location.href ='<?php echo base_url()?>main/insertNewRecord/<?php echo $tableName ?>';">insert new record</button></td></tr>
	</table>
</div>
<button id="back" onClick="window.location.href = '<?php echo base_url()?>main/tables/<?php echo $tableName ?>';">back to tables page</button>
</body>
</html>