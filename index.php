<?php
	session_start();
	error_reporting(0);
	include("controller/databaseConnection.php");

	if(isset($_REQUEST['login'])){
		
		$username= $_REQUEST['username'];
		$pwd= $_REQUEST['pwd'];

		if(!empty($username) && !empty($pwd)){

			$query = mysql_query("SELECT username,pwd FROM admin");
			$result = mysql_fetch_assoc($query);

			if($username == $result['username'] && $pwd == $result['pwd']){
				
				$_SESSION['username'] = "admin";

				header("location: controller/home.php");
			}
			else{
				$errorMsg = "Invalid User....";
			}
		}
		else{
			$errorMsg = "Enter in empty field...";
		}
	}

	if(isset($_REQUEST['savePwdBtn'])){

		$regEmail = $_REQUEST['regEmail'];

		$query = mysql_query("SELECT email FROM admin");
		$result = mysql_fetch_assoc($query);

		if($regEmail == $result['email']){

			$npwd = $_REQUEST['npwd'];
			$cpwd = $_REQUEST['cpwd'];

			if($npwd == $cpwd){
				$query = mysql_query("UPDATE admin SET pwd = '$npwd' WHERE email = '$regEmail'");

				if(!empty($query)){
					header("location: index.php");
					//$errorMsg = "Password successfully changed.";
				}
			}
			else{
				//header("location: index.php?activity=forgetpwd");
				$errorMsg = "Password must be same.";
			}
		}
		else{
			//header("location: index.php?activity=forgetpwd");
			$errorMsg = "Please ! Enter authorised's user email.";
		}

	}

?>



<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/styleIndex.css">
	</head>
	<body>
		<div class="container">
		<?php
			$activity = $_REQUEST['activity'];

			if($activity == 'forgetpwd'){
				//include("controller/forgetpwd.php");
			?>
				<form class="loginPage">
					<div class="formInput">
						<input type="email" name="regEmail" required autofocus placeholder="Your Registered Email">
					</div>
					<div class="formInput">
						<input type="password" name="npwd" required autofocus placeholder="New Password">
					</div>
					<div class="formInput">
						<input type="password" name="cpwd" required autofocus placeholder="Confirm New Password" >
					</div>
						<input type="submit" name="savePwdBtn" value="Save" class="btnSavePwd">
						<br >
						<a class="backLink" href="index.php">Back</a>
				</form>
		
			<?php	
			}
			else{

			?>
			
				<form class="loginPage">
					<div class="formInput">
						<input type="text" name="username" required autofocus placeholder="Username" >
					</div>
					<div class="formInput">
						<input type="password" name="pwd" required autofocus placeholder="password" >
					</div>
						<input type="submit" name="login" value="Log In" class="btnLogin">
						<br >
						<a class="forgetPwd" href="index.php?activity=forgetpwd">Forget Password?</a>
				</form>

			<?php
			}	
			?>
			<?php
		        if(isset($errorMsg)){
		            ?>
		            <div class="errorMsg"><?php echo $errorMsg; ?></div>
	                <?php	
	        	}
		    ?>
		    </div>
	</body>
</html>
