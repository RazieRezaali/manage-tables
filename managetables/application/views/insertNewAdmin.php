<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>insert new admin</title>
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
		 width: 100px;
	}
	#sub:hover {
		background-color: rgb(178, 14, 14);
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
  		color: white;
	}
</style>
</head>

<body>
	<form method="post" action="<?php echo base_url()?>main/insertNewAdmin2/">
		<lable id="i" >first name</lable>
		<input type="text" name="fname" value="<?php echo set_value('fname') ?>"><br><br>
		<font color="black" style="text-shadow: 2px 2px 4px red;"><?php echo form_error('fname') ?></font>
		<lable id="i">last name</lable>
		<input type="text" name="lname" value="<?php echo set_value('lname') ?>"><br><br>
		<font color="black" style="text-shadow: 2px 2px 4px red;"><?php echo form_error('lname') ?></font>
		<lable id="i">email</lable>
		<input type="email" name="email" value="<?php echo set_value('email') ?>"><br><br>
		<font color="black" style="text-shadow: 2px 2px 4px red;"><?php echo form_error('email') ?></font>
		<lable id="i">username</lable>
		<input type="text" name="username" value="<?php echo set_value('username') ?>"><br><br>
		<font color="black" style="text-shadow: 2px 2px 4px red;"><?php echo form_error('username') ?></font>
		<lable id="i">password</lable>
		<input type="password" name="password" value="<?php echo set_value('password') ?>"><br><br>
		<font color="black" style="text-shadow: 2px 2px 4px red;"><?php echo form_error('password') ?></font>
		<!--<lable>image </lable>
		<input type="file" name="image"><br><br>-->
		
		<input id="sub" type="submit" name="submit" value="insert"><br>
		
	</form>
<button onClick="window.location.href = '<?php echo base_url()?>main/admins/';">back</button>
</body>
</html>