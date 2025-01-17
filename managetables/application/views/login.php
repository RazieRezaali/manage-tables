<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>login</title>
	
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
		#1e4d40,
        #51bfa0
        
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #d099c5,
        #5d3f57
    );
    right: -30px;
    bottom: -80px;
}
form{
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
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
.submit{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}

    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="<?php echo base_url() ?>main/login/" method="post">
		<h1 style="text-align: center">login</h1>
		<br><br>
		<font color="black" style="text-shadow: 2px 2px 4px red; font-size: 20px; text-align: center; background-color: red; align-content: center; position: absolute; right: 55px;" ><?php if($true==0) echo'Username or password is not correct' ?></font>
		
        <label for="username">username</label>
        <input type="text" id="username" name="username" autocomplete="off" value="<?php echo set_value('username') ?>">
		<font color="black" style="text-shadow: 2px 2px 4px red;"><?php echo form_error('username') ?></font>

        <label for="password">password </label>
        <input type="password" id="password" name="password" autocomplete="off">
		<font color="black" style="text-shadow: 2px 2px 4px red;"><?php echo form_error('password') ?></font>

		<input type="submit" name="submit" value="login" class="submit">
    </form>
</body>
</html>