<?php require "include/header.php";
if(!isset($_SESSION['userid']))
{
	header("Location:login.php"); 
}
?>
<?php
$db = connectdb();
if($_SESSION["level"]!=0) {header("Location:index.php");}

$fetchData = myquery($db, "SELECT * FROM Note WHERE studentID = ".$_SESSION["userid"]."");

?>
<?php require "include/navbar.php" ?>
  <div class="content-wrapper">
    <div class="container-fluid">
    <br><br>
    <?php
    foreach($fetchData as $data)
    {

        $fetchStudent = myquery($db, "SELECT name, surname FROM User WHERE ID = ".$data["studentID"]."");
        $student = $fetchStudent[0]["name"]. " ".$fetchStudent[0]["surname"];
        $fetchTeacher = myquery($db, "SELECT name, surname FROM User WHERE ID = ".$data["teacherID"]."");
        $teacher = $fetchTeacher[0]["name"]. " ".$fetchTeacher[0]["surname"];

        echo '
        <div class="panel panel-default">
        <div class="panel-heading">Nota</div>    
                <div class="panel-body">
            <strong>Professore:</strong> '.$teacher.'<br>
            <strong>Studente:</strong> '.$student.' <br>
            <strong>Nota:</strong> '.$data["note"].' <br><br>
            </div>
        </div>   
        <hr>';
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
