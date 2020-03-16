<?php
require "include/header.php";
if(isset($_SESSION['userid']))
{
	header("Location:index.php"); 
}

$status = 0; //0 = not logged in, 1 = logged in, 2 = invalid user/pass
$smsg = "<font color='red'>Email or password non corretti</font>.";


if(isset($_POST['email']))   // it checks whether the user clicked login button or not 
{
	$db = connectdb();
	$user = escapestringex($db,$_POST['email']);// escape their inputs
	$pass = escapestringex($db,$_POST['password']);
	
	$status = 2; //set it to 2 for now
	
	$return = myquery($db,"SELECT ID, email, name, userLevel FROM User WHERE email = ".$user." AND password = sha1(".$pass.")");
	
	if(!empty($return))  
	{  
		$status = 1; //User is good!
		$_SESSION['userid'] = $return[0]['ID'];
		$_SESSION['username'] = $return[0]['name'];
		$_SESSION['level'] = $return[0]['userLevel'];
		$_SESSION['email'] = $return[0]['email'];
		
		$smsg = "<font color='green'>Success! Redirecting to control panel in 2 seconds.</font>";
		header( "refresh:2;url=index.php" );
	}
	$db = null;
}
?>
<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login - School Management System</div>
      <div class="card-body">
        <form action="login.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input class="form-control" id="exampleInputEmail1" type="email" name="email" required="" aria-describedby="emailHelp" placeholder="Inserisci l'email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" type="password" name="password" required="" placeholder="Inserisci la tua Password">
          </div>

          <input class="btn btn-primary btn-block" type="submit" value="Login"></input>
        </form>
        <div class="text-center">
        <?php
          if($status == 0)
          {
            echo "";
          }
          else
          {	
            echo $smsg;
          }
        ?>
        </div>

        <div class="text-center">
          Forgot Password? contact admin!
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
