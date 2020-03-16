<?php require "include/header.php";
if(!isset($_SESSION['userid']))
{
	header("Location:login.php"); 
}
?>
<?php
$db = connectdb();

if(isset($_POST["submit"])){
  $msg = escapestringex($db,$_POST['msg']);
  if(isset($_POST["classSelect"])){
    $receiver = escapestringex($db,$_POST['classSelect']);
    myinsert($db, "INSERT INTO notifications (`sender`, `reciever`, `message`) VALUES (".$_SESSION['userid'].", $receiver, $msg)");
  }
  else{
    if(isset($_POST["admin"]))
    {
      $admins = myquery($db, "SELECT ID FROM User WHERE userLevel = 3");
      foreach($admins as $admin){
        myinsert($db, "INSERT INTO notifications (`sender`, `reciever`, `message`) VALUES (".$_SESSION['userid'].",  ".$admin['ID'].", $msg)");
      }
    }
    if(isset($_POST["prin"]))
    {
      $admins = myquery($db, "SELECT ID FROM User WHERE userLevel = 4");
      foreach($admins as $admin){
        myinsert($db, "INSERT INTO notifications (`sender`, `reciever`, `message`) VALUES (".$_SESSION['userid'].", ".$admin['ID'].", $msg)");
      }
    }
  }
  header("Location: index.php");

}
?>
<?php require "include/navbar.php" ?>
  <div class="content-wrapper">
    <div class="container-fluid">
    <br><br><br><br>
    <?php 
    if($_GET["type"]==0)
    {
        require "modules/contact/student_contact.php";
    }
    if($_GET["type"]==1)
    {
        require "modules/contact/parent_contact.php";
    }
    if($_GET["type"]==2)
    {
        require "modules/contact/teacher_contact.php";
    }
    if($_GET["type"]==3)
    {
        require "modules/contact/admin_contact.php";
    }
    if($_GET["type"]==4)
    {
        require "modules/contact/principle_contact.php";
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
