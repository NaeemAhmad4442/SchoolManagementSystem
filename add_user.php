<?php require "include/header.php";
if(!isset($_SESSION['userid']))
{
	header("Location:login.php"); 
}
?>
<?php
$db = connectdb();
if($_SESSION["level"]!=3 && $_SESSION["level"]!=4) {header("Location:index.php");}

$status=0;
$err = "<font color='red'>L'email inserita e' gia' in uso!</font>";
$fetchClasses = myquery($db, "SELECT * FROM Class");
if(isset($_POST["register"]))
{
    $db = connectdb();
    $email = escapestringex($db,$_POST['email']);
    $emailCheck = myquery($db, "SELECT * FROM User where email = ".$email."");
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
        $classSelect = escapestringex($db,$_POST['classSelect']);
        if(!isset($_POST["classSelect"])) $classSelect = -1;
        $userlevel = $_POST["type"];
        $myres = myinsert($db, "INSERT INTO User (name, surname, email, password, dateOfBirth, placeOfBirth, userLevel, classID, status) VALUES (".$name.", ".$surname.", ".$email.", sha1(".$pwd."), ".$dob.", ".$pob.", '$userlevel', '$classSelect', '0')");
        
        if($_POST["type"]==0)
        {
          echo "<br>";
          $sonid = myquery($db, "SELECT ID FROM User ORDER BY ID DESC LIMIT 1");
          $sonidEx = $sonid;
          $namep = escapestringex($db,$_POST['namep']);
          $surnamep = escapestringex($db,$_POST['surnamep']);
          $dobp = escapestringex($db,$_POST['dobp']);
          $pobp = escapestringex($db,$_POST['pobp']);
          $emailp = escapestringex($db,$_POST['emailp']);
          $pwdp = escapestringex($db,$_POST['pwdp']);
          $classSelect = -1;
          $userlevel = 1;
          $myres = myinsert($db, "INSERT INTO User (name, surname, email, password, dateOfBirth, placeOfBirth, userLevel, classID, status, sonid) VALUES (".$namep.", ".$surnamep.", ".$emailp.", sha1(".$pwdp."), ".$dobp.", ".$pobp.", '$userlevel', $classSelect, '$sonidEx')");
        }
        $status = 2;
        header( "refresh:2;url=users.php?type=".$_POST["type"]."");
        $err = "<font color='green'>Utente aggiunto con successo! reindirizzamente in corso...</font>";
    }
}

?>
<?php require "include/navbar.php" ?>
  <div class="content-wrapper">
    <div class="container-fluid">
    <br><br>
    <form action="add_user.php" method="POST">
    <div style="margin-left:400px"><div class="form-group">
        <label for="name">Nome</label>
        <input style="width:50%" placeholder="Inserisci il nome" name="name" type="text" required="" class="form-control" id="name">

        <label for="surname">Cognome</label>
        <input style="width:50%" type="text" placeholder="Inserisci il cognome" name="surname" required="" class="form-control" id="surname">

        <label for="email">Email</label>
        <input style="width:50%" type="email" name="email" placeholder="Inserisci l'Email" required="" class="form-control" id="email">

        <label for="dob">Data di nascita</label>
        <input style="width:50%" type="date" name="dob" placeholder="Inserisci la Data di nascita" required="" class="form-control" id="dob">

        <label for="pob">Luogo di nascita</label>
        <input style="width:50%" type="text" name="pob" placeholder="Inserisci il Luogo di nascita" required="" class="form-control" id="pob">
        <input type="hidden" name="type" value="<?php echo $_GET["type"]  ?>"/>
        
        <?php if($_GET["type"]==2 || $_GET["type"]==0){
        echo'
        <label for="pob">Seleziona la classe da associare:</label>
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
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input style="width:50%" type="password" name="pwd" placeholder="Inserisci la password" required="" class="form-control" id="pwd">
    </div>
    <br>
    <?php if($_GET["type"]==0){
        echo '
        <strong>Dettagli genitore:</strong><hr>
        <div class="form-group">
        <label for="name">Nome</label>
        <input style="width:50%" placeholder="Inserisci il nome" name="namep" type="text" required="" class="form-control" id="name">

        <label for="surname">Cognome</label>
        <input style="width:50%" type="text" placeholder="Inserisci il cognome" name="surnamep" required="" class="form-control" id="surname">

        <label for="email">Email</label>
        <input style="width:50%" type="email" name="emailp" placeholder="Inserisci l\'Email" required="" class="form-control" id="email">

        <label for="dob">Data di nascita</label>
        <input style="width:50%" type="date" name="dobp" placeholder="Inserisci la Data di nascita" required="" class="form-control" id="dob">

        <label for="pob">Luogo di nascita</label>
        <input style="width:50%" type="text" name="pobp" placeholder="Inserisci il Luogo di nascita" required="" class="form-control" id="pob">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input style="width:50%" type="password" name="pwdp" placeholder="Inserisci la password" required="" class="form-control" id="pwd">
        </div>';
    }
    ?>
    <button type="submit" style="width:50%" class="form-control btn btn-success" name="register">Aggiungi utente</button>
    </form><br>
    <?php
        if($status != 0)
        {
        echo $err;
        }
    ?>
    </div><br><br><br><br><br><br><br><br><br>
        
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
