<?php require "include/header.php";
if(!isset($_SESSION['userid']))
{
	header("Location:login.php"); 
}
?>
<?php require "include/navbar.php" ?>
<?php
$db = connectdb();
$result = myquery($db, "SELECT * FROM User WHERE classID = (SELECT User.classID FROM User WHERE User.ID = ".$_SESSION["userid"].") AND userLevel = 0 ORDER BY User.ID DESC");
if($_SESSION["level"]!=0 && $_SESSION["level"]!=2) {header("Location:index.php");}
if(isset($_POST["submit"]))
{
  $index1=0;
  foreach($result as $list)
  {
    $index1++;
    $userid = escapestringex($db,$_POST['userid'.$index1.'']);
    $presence = $_POST['stato'.$index1.''];
    myquery($db, "INSERT INTO presence (studentID, `presence`) VALUES ($userid, $presence)");
  }
    
}
?>
    <div class="content-wrapper">
        <div class="container-fluid">
        <br>
        <?php 
        if(!empty($result))
        {
            echo '
            <br><table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Studente</th>
                        <th>presente</th> 
                        <th>Assente</th>
                        <th>Giustificato</th> 
                    </tr>
                </thead>
                <tbody>
                <form method="post" action="presence.php">
                ';
                $index=0;
                foreach($result as $list)
                {
                    $index++;
                    echo '<input type="hidden" name="userid'.$index.'" value="'.$list["ID"].'"/>';
                    $present="0";
                    $name = $list["name"]. " ".$list["surname"]; 
                    echo '<tr>
                    <td>'.$name.'</td>
                    <td><input type="radio" name="stato'.$index.'" value="1"></td>
                    <td><input type="radio" name="stato'.$index.'" value="0"></td>
                    <td><input type="radio" name="stato'.$index.'" value="-1"></td>';
                }
            echo '
                </tbody>
            </table>
            <button class="btn btn-primary" name="submit" type="submit">Aggiorna</button>
            </form>';
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
