<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>new table</title>
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
</head>

<body>
	<form action="<?php echo base_url() ?>main/newTable2/" method="post">

        <label style="background-color: #BA990C; padding: 5px;" for="tableName">Name of the table</label>
        <input type="text" name="tableName"  value="<?php echo set_value('tableName'); ?>">
		<font color="black" style="text-shadow: 2px 2px 4px red;"><?php echo form_error('tableName'); ?></font><br><br>
		<br><br><hr><br>

		<?php
		
		if($number>0){
			for($i=1;$i<=$number;$i++){
				echo
					'
					<label id="i" for="name'.$i.'">Column name '.$i.'</label>
					<input type="text" name="name'.$i.'" value="'.set_value('name'.$i).'">
					<font color="black" style="text-shadow: 2px 2px 4px red;">'.form_error('name'.$i).'</font><br><br>
					<label id="i" for="type">Column type:</label>
					<label id="i" for="type'.$i.'">int</label>
					<input type="radio" name="type'.$i.'" value="int" checked="checked" >
					<label id="i" for="type'.$i.'">varchar</label>
					<input type="radio" name="type'.$i.'" value="varchar">
					<font color="black" style="text-shadow: 2px 2px 4px red;">'.form_error('type'.$i).'</font><br><br>
					<input type="number" name="varchar'.$i.'" value="'.set_value('varchar'.$i).'">
					<font color="black" style="text-shadow: 2px 2px 4px red;">'.form_error('varchar'.$i).'</font><br><br>
					<br><br>
					<label id="i" for="field'.$i.'">primary key</label>
					<input type="radio" name="key" value="'.$i.'" ';
					if($i==1){
						echo 'checked="checked"';
					}
					echo '>
					<br><br><hr><br><br>
					';	
			}
			
		}
		  
		 echo '<input type="hidden" name="number" value="'.$number.'">';
		?>
		
		
		<input id="sub" type="submit" name="submit" value="create">
    </form>
<button onclick="window.location.href = '<?php echo base_url()?>main/columnCount/';">Return to the previous step</button>
</body>
</html>