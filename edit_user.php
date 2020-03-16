<?php require "include/header.php";
if(!isset($_SESSION['userid']))
{
	header("Location:login.php"); 
}
?>
<?php
$db = connectdb();
if($_SESSION["level"]!=3 &&  $_SESSION["level"]!=4) {header("Location:index.php");}

$status=0;
$err = "<font color='red'>L'email inserita e' gia' in uso!</font><br><br>";
$db = connectdb();

if(isset($_GET["userid"]))
{
    $fetchuser = myquery($db, "SELECT * FROM User WHERE ID = ".$_GET["userid"]."");
    $fetchClasses = myquery($db, "SELECT * FROM Class");
}

if(isset($_POST["saveChanges"]))
{
    $email = escapestringex($db,$_POST['email']);
    $emailCheck = myquery($db, "SELECT * FROM User where email = ".$email." and ID != ".$_GET["userid"]."");
    if(!empty($emailCheck))
    {
      $status = 1;
    }
    else{
        $name = escapestringex($db,$_POST['name']);
        $surname = escapestringex($db,$_POST['surname']);
        $dob = escapestringex($db,$_POST['dob']);
        $pob = escapestringex($db,$_POST['pob']);
        $pwd = escapestringex($db,$_POST['pwd']);   
        $class = escapestringex($db,$_POST['classSelect']);
        if(!empty($pwd)){
            $myres = myquery($db, "UPDATE User SET name = ".$name.", surname = ".$surname.", email = ".$email.", password = sha1(".$pwd."), dateOfBirth = ".$dob.", placeOfBirth = ".$pob.", classID = ".$class." WHERE ID = ".$_GET["userid"]."");
        }
        else{
            $myres = myquery($db, "UPDATE User SET name = ".$name.", surname = ".$surname.", email = ".$email.", dateOfBirth = ".$dob.", placeOfBirth = ".$pob.", classID = ".$class." WHERE ID = ".$_GET["userid"]."");
        }

        $status = 2;
        header( "Location:users.php?type=".$_GET["type"]."");
    }
}

?>
<?php require "include/navbar.php" ?>
  <div class="content-wrapper">
    <div class="container-fluid">
    <br><br><br>
    <form <?php echo 'action="edit_user.php?userid='.$_GET["userid"].'&type='.$_GET["type"].'"'; ?> method="POST">
    <div style="margin-left:400px"><div class="form-group">
        <label for="name">Nome</label>
        <input style="width:50%" placeholder="Inserisci il nome" name="name" type="text" value="<?php echo $fetchuser[0]["name"] ?>" required="" class="form-control" id="name">

        <label for="surname">Cognome</label>
        <input style="width:50%" type="text" placeholder="Inserisci il cognome" name="surname" required="" value="<?php echo $fetchuser[0]["surname"] ?>" class="form-control" id="surname">

        <label for="email">Email</label>
        <input style="width:50%" type="email" name="email" placeholder="Inserisci l'Email" required="" value="<?php echo $fetchuser[0]["email"] ?>" class="form-control" id="email">

        <label for="dob">Data di nascita</label>
        <input style="width:50%" type="date" name="dob" placeholder="Inserisci la Data di nascita" required="" value="<?php echo $fetchuser[0]["dateOfBirth"] ?>" class="form-control" id="dob">

        <label for="pob">Luogo di nascita</label>
        <input style="width:50%" type="text" name="pob" placeholder="Inserisci il Luogo di nascita" required="" value="<?php echo $fetchuser[0]["placeOfBirth"] ?>" class="form-control" id="pob">

    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input style="width:50%" type="password" name="pwd" placeholder="Inserisci la nuova password" class="form-control" id="pwd">
    </div>

    <?php 
    if($fetchuser[0]["userLevel"]==0)
    {
        echo'
        Seleziona la classe da associare:
        <div class="form-group">
        <select name="classSelect" class="form-control" style="width:50%">
        <option value="-1">No class</option>';
        foreach($fetchClasses as $class)
        {
            echo '<option value='.$class["ID"].'>'.$class["name"].'</option>';
        }
        echo'
        </select>
        </div>';
    }
    ?>
    <button type="submit" style="width:50%" class="form-control btn btn-success" name="saveChanges">Salva utente</button>
    </form><br>
    <?php
        if($status != 0)
        {
        echo $err;
        }
    ?>
    </div><br>
        
    </div>
</div>
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © School Management System</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
