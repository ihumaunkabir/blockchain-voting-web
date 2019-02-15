<?php

		if(isset($_POST['login'])){

	

		//old
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"http://10.10.1.98:3000/auth/login");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		            "nid=".$_POST['nid']."&password=".$_POST['password']);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));


		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);

		$jsondata = json_decode($server_output,true);

				if($jsondata['reply'] == true ){
						header('location: voter/index.php');
					}
					else {
						header('location: index.php');
					}
			

	
			}



	?>



<!DOCTYPE html>
<html>
<head>


	<title>Voting 1.0</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	 
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
	 
	<link rel="stylesheet" href="styles.css" >
	 
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
	<center>

<header>

  <h1>Voting 1.0</h1>

</header>

<h1>Login</h1>

<?php if(isset($pass)) echo $pass;
	if(isset($passp)) echo $passp;
 ?>

<div class="content">
	<div class="row">

	<form method="post" class="form-horizontal col-md-6 col-md-offset-3" >
			<div class="form-group">
			    <label for="input1" class="col-sm-3 control-label">NID</label>
			    <div class="col-sm-7">
			      <input type="text" name="nid"  class="form-control" id="input1" placeholder="your NID" />
			    </div>
			</div>

			<div class="form-group">
			    <label for="input1" class="col-sm-3 control-label">Password</label>
			    <div class="col-sm-7">
			      <input type="password" name="password"  class="form-control" id="input1" placeholder="your password" />
			    </div>
			</div>



			<input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Login" name="login" />
		</form>
	</div>
</div>



<br><br>

<p><strong>If you don't have any account, <a href="signup.php">Signup</a> here</strong></p>

</center>
</body>
</html>