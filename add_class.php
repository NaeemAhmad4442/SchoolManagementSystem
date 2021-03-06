<?php require "include/header.php";
if(!isset($_SESSION['userid']))
{
	header("Location:login.php"); 
}
?>
<?php
$db = connectdb();
if($_SESSION["level"]!=3) {header("Location:index.php");}

$status=0;
if(isset($_POST["register"]))
{
    $db = connectdb();

    $desc = escapestringex($db,$_POST['description']);
    $maxStudents = escapestringex($db,$_POST['maxStudents']);
    $myres = myinsert($db, "INSERT INTO Class (name, MaxStudents) VALUES (".$desc.", ".$maxStudents.")");
    $status = 1;
    header( "Location:classes.php");
}

?>
<?php require "include/navbar.php" ?>
  <div class="content-wrapper">
    <div class="container-fluid">
    <br><br><br><br>
    <form action="add_class.php" method="POST">
    <div style="margin-left:400px"><div class="form-group">
        <label for="Descrizione">Descrizione</label>
        <input style="width:50%" placeholder="Inserisci la Descrizione" name="description" type="text" required="" class="form-control" id="Descrizione">

        <label for="surname">Numero massimo di studenti</label>
        <input style="width:50%" type="number" placeholder="Inserisci il numero" min="0" max="100" name="maxStudents" required="" class="form-control" id="surname">

    </div>
    <button type="submit" style="width:50%" class="form-control btn btn-success" name="register">Aggiungi Classe</button>
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
