<?php require "include/header.php";
if(!isset($_SESSION['userid']))
{
	header("Location:login.php"); 
}
?>
<?php require "include/navbar.php" ?>
<?php
$db = connectdb();
if($_SESSION["level"]==0 || $_SESSION["level"]==1) {header("Location:index.php");}
$classes = myquery($db, "SELECT * FROM Class");

?>

  <div class="content-wrapper">
    <div class="container-fluid">
    <br><br>
    <?php
    if($_SESSION["level"]==3) echo '<a href="add_class.php"><button class="btn btn-success">Aggiungi classe</button></a><br><br>';
    if(!empty($classes))
    {
        echo '
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrizione classe</th>
                    <th>Studenti</th>';
                    if($_SESSION["level"]==3) echo '<th>Action</th>';
                echo'    
                </tr>
            </thead>
            <tbody>';
            foreach($classes as $list)
            {   
                $studentiCount = myquery($db, "SELECT COUNT(*) AS n FROM User WHERE classID = ".$list["ID"]."");
                echo '<tr><td>'.$list["ID"].'</td><td>'.$list["name"].'</td><td>'.$studentiCount[0]["n"].'/'.$list["MaxStudents"].'</td>';
                if($_SESSION["level"]==3) echo '<td><a href="classes.php?deleteID='.$list["ID"].'"><font color="red"><i class="fa fa-trash"></i></font></a><a href="edit_class.php?classid='.$list["ID"].'"><font color="green"><i class="fa fa-pencil"></i></font></td></tr>';
            }
        echo '
            </tbody>
        </table>';
    }
    ?>
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
