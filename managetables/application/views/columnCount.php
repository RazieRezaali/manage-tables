<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>column count</title>
<style>
	body{
	    background: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);
		font-size: 20px;
	}
	form{
		position: absolute;
		top: 160px;
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
		background-color: #29323c;
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
  		color: white;
	}
	
</style>
</head>

<body>
	<form action="<?php echo base_url() ?>main/newTable/" method="post">

        <label style="background-color: rgb(110, 130, 150);padding: 5px;" for="tableColumn">The number of table columns</label>
        <input type="number" name="columnount"><br>
		<font color="black" style="text-shadow: 2px 2px 4px red;"><?php echo form_error('columnount') ?></font>
		<input id="sub" type="submit" name="submit" value="next step" >
    </form>
<button onclick="window.location.href = '<?php echo base_url()?>main/dashbord/';">back to dashbord</button>
</body>
</html>