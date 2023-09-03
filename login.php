<?php
session_start();
include("connection.php");
include("function.php");
//$user_data = check_login($con);
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];
	if(!empty($user_name) && !empty($password) &&  !is_numeric($user_name)){
		//read from  database
		$user_id = random_num(20);
		$query = "select * from users where user_name='$user_name' limit 1";
		$result = mysqli_query($con,$query);

			if($result && mysqli_num_rows($result) > 0){

				$user_data = mysqli_fetch_assoc($result);

				if($user_data['password'] === $password){
					$_SESSION['user_name'] = $user_data['user_name'];
					header("location: index.php");
					die;
				}
			}
			echo "Wrong username or Password!";

		}else{
		echo "Please enter some valid information";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Login Page</title>
	 <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  	<a class="navbar-brand" href="#">Logo</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		 <span class="navbar-toggler-icon"></span>
		 </button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
			    <li class="nav-item active">
			        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			    </li>
			    <li class="nav-item">
			        <a class="nav-link" href="#">Contact Us</a>
			    </li>
			    <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Category
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Cat 1</a>
			          <a class="dropdown-item" href="#">Cat 2</a>
			          <div class="dropdown-divider">Cat 3</div>
			          <a class="dropdown-item" href="#">Cat 4</a>
			        </div>
			    </li>
		    </ul>
		    <form class="form-inline my-2 my-lg-0">
		      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		    </form>
		    <ul  class="navbar-nav">
			    <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="singup.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Register
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="logout.php">Logout</a>
			        </div>
			    </li>
		    </ul>
	  </div>
</nav>
	<div id="box">
		<form method="post">
			<div style="font-size: 20px; margin:10px;">Login </div>
			<input id="text" type="text" name="user_name" value="user_name"><br><br>
			<input id="text" type="text" name="password" value="password"><br><br>
			<input   type="submit" value="login"><br><br>
			<span><a href="singup.php">Signup</a></span>
			<span class="pull-right"><a href="singup.php">Logout</a></span>
		</form>
	</div>
<?php include("footer.php");?>