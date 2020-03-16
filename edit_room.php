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
$db = connectdb();

if(isset($_GET["roomid"]))
{
    $fetchClasses = myquery($db, "SELECT * FROM Class");
    $fetchuser = myquery($db, "SELECT * FROM rooms WHERE ID = ".$_GET["roomid"]."");
    
}


?>
<?php require "include/navbar.php" ?>
  <div class="content-wrapper">
    <div class="container-fluid">
    <br><br><br>
    <form <?php echo 'action="manage_rooms.php?roomid='.$_GET["roomid"].'"'; ?> method="POST">
    <div style="margin-left:400px"><div class="form-group">
        <label for="name">Nome</label>
        <input style="width:50%" placeholder="Inserisci il nome della classe" name="name" type="text" value="<?php echo $fetchuser[0]["description"] ?>" required="" class="form-control" id="name">

        <label for="pob">Seleziona la classe da associare:</label>
        <div class="form-group">
        <select name="classSelect" class="form-control" style="width:50%">
        <option value="-1">No class</option>';
        <?php
        foreach($fetchClasses as $class)
        {
            echo '<option value='.$class["ID"].'>'.$class["name"].'</option>';
        }
        ?>
        </select>
        </div>
    
        <label for="maxStudents">Data</label>
        <input style="width:50%" type="date" name="date" required=""  class="form-control" id="surname">

        <label for="maxStudents">Ora</label>
        <input style="width:50%" type="time" name="time" required=""  class="form-control" id="surname">
    
    </div>
    <button type="submit" style="width:50%" class="form-control btn btn-success" name="saveChanges">Salva</button>
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
