<?php require "include/header.php";
if(!isset($_SESSION['userid']))
{
	header("Location:login.php"); 
}
?>
<?php
$db = connectdb();
if($_SESSION["level"]!=2) {header("Location:index.php");}

$status=0;
$db = connectdb();
$fetchClasses = myquery($db, "SELECT * FROM Class");

if(isset($_POST["addTest"]))
{

  $subject = escapestringex($db,$_POST['subject']);
  $description = escapestringex($db,$_POST['description']);
  $date = $_POST['date'];
  $time = $_POST['time'];
  description
  $datetime = $date. " " .$time;
  $duration = escapestringex($db,$_POST['duration']);
  $class = escapestringex($db,$_POST['classSelect']);
  $myres = myquery($db, "INSERT INTO Test(subject, date, duration, classID, teacherID, description) VALUES (".$subject.", '".$datetime."', ".$duration.", ".$class.", ".$_SESSION["userid"].", '$description')");
  header( "Location:tests.php");
}

?>
<?php require "include/navbar.php" ?>
  <div class="content-wrapper">
    <div class="container-fluid">
    <br><br><br>
    <form action="add_test.php" method="POST">
    <div style="margin-left:400px"><div class="form-group">
        <label for="subject">Materia</label>
        <input style="width:50%" placeholder="Inserisci la materia" name="subject" type="text" required="" class="form-control" id="name">

        <label for="subject">Descrizione</label>
        <input style="width:50%" placeholder="Inserisci la descrizione" name="description" type="text" required="" class="form-control" id="name">

        <label for="date">Data</label>
        <input style="width:50%" type="date" placeholder="Inserisci la data del compito" name="date" required="" class="form-control" id="date">

        <label for="time">Ora</label>
        <input style="width:50%" type="time" name="time" placeholder="Inserisci l'orario" required="" class="form-control" id="time">

        <label for="duration">Durata compito</label>
        <input style="width:50%" type="number" name="duration" placeholder="Inserisci la durate del compito" required="" class="form-control" id="duration">

    </div>
    <?php 

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
    ?>
    <button type="submit" style="width:50%" class="form-control btn btn-success" name="addTest">Aggiungi Compito</button>
    </form><br>
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
