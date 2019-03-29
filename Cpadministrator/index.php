<?php
session_start();
if($_SESSION){
	header("Location: user.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="images/png" href="../images/icon.png">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login System</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background-image:url(../images/img_bg_2.jpg);
			height: 100%;
			width: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		.row {
			margin:100px auto;
			width:300px;
			text-align:center;
		}
		.login {
			background-color:#fff;
			padding:20px;
			margin-top:20px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<h2>Log In</h2>
			<div class="login">			
				<?php
				if(isset($_POST['login'])){
					include("../admin/koneksi.php");					
					$username	= $_POST['username'];
					$password	= base64_encode($_POST['password']);			
					$query = mysql_query( "SELECT * FROM users WHERE username='$username' AND password='$password'");
    				if(mysql_num_rows($query) == 0){
        				echo '<div class="alert alert-danger">Username/Password salah!!</div>';
    				}else{
        				$row = mysql_fetch_assoc($query);
        				$_SESSION['username']=$row['username'];
        				$_SESSION['level'] = $row['level'];
        
        				if($row['level'] == "1"){            
            			header("Location: ../admin");
        				}else if($row['level'] =="2")
        				{
            			header("Location: ../mh");
       					}
        			else if($row['level'] == "3")
        				{
            			header("Location: ../gudang");
        				}
        				else
        				{
            			echo '<div class="alert alert-danger">Upss...!!! Login gagal.</div>';
        				}
    				}
				}           
				?>
				<form role="form" action="" method="post">
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username" required autofocus />
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required autofocus />
					</div>									
					<div class="form-group">
						<input type="submit"  name="login" class="btn btn-primary btn-block" value="Log me in" />
					</div>
				</form>
			</div>			
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>