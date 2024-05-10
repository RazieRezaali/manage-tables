<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>dashbord</title>
<style>
	#main{
		background: #51bfa0;
		width:50%;
		position: absolute;
		top: 0px;
		bottom: 0px;
		left: 0px;
	}
	#inside{
		height: 520px;
    	width: 400px;
    	background-color: rgba(255,255,255,0.13);
    	position: absolute;
    	transform: translate(-50%,-50%);
    	top: 50%;
    	left: 50%;
    	border-radius: 10px;
    	backdrop-filter: blur(10px);
    	border: 2px solid rgba(255,255,255,0.1);
	    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    	padding: 50px 35px;
	}
	body{
    	background-color: #2B2E2B;
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
    	width: 100%;
   		color: #080710;
    	font-weight: 600;
    	border-radius: 12px;
    	cursor: pointer;
	}
	button:hover {
		background-color: #555555;
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
  		color: white;
	}
</style>
</head>

<body>
	<div id="main"></div>
	<div id="inside">
		<button onclick="window.location.href = '<?php echo base_url()?>main/admins';">View admins</button>
		<button onclick="window.location.href = '<?php echo base_url()?>main/tables';">View tables</button>
		<button onclick="window.location.href = '<?php echo base_url()?>main/columnCount';">Create new table</button>
		<button onclick="window.location.href = '<?php echo base_url()?>main/';">Sign out</button>
	</div>
</body>
</html>