<?php require "include/header.php";
if(!isset($_SESSION['userid']))
{
	header("Location:login.php"); 
}
?>
<?php require "include/navbar.php" ?>
<?php
$db = connectdb();
if($_SESSION["level"]==0) {header("Location:index.php");}
if(isset($_POST["updatePresence"]))
{
    $userid = escapestringex($db,$_POST['userid']);
    $presence = $_POST['presence'];
}

?>
    <div class="content-wrapper">
        <div class="container-fluid">
        <br>
        
        <form method="POST" action="presence.php">
        <?php 
        $result = myquery($db, "SELECT * FROM User WHERE classID = (SELECT User.classID FROM User WHERE User.ID = ".$_SESSION["userid"].") AND userLevel = 0 ORDER BY User.ID DESC");
        if(!empty($result))
        {
            echo '
            <br><table class="table table-hover">
                <thead>
                    <tr>
                        <th>Studente</th>
                        <th>presente</th> 
                    </tr>
                </thead>
                <tbody>';
                foreach($result as $list)
                {
                    echo '<input type="hidden" name="userid" value="'.$list["ID"].'"/>';
                    $present="0";
                    $fetchpresences = myquery($db, "SELECT * FROM presence WHERE studentID = ".$list["ID"]." AND day(date) = ".date("d")." AND month(date) = ".date("m")."");
                    if(!empty($fetchpresences)) {$present = $fetchpresences[0]["presence"];}
                    $name = $list["name"]. " ".$list["surname"];    
                    if($present=="0") {echo '<tr><td>'.$name.'</td><td><input type="checkbox" name="presence" value="1"/></td>';}
                    else {echo '<tr><td>'.$name.'</td><td><input type="checkbox" name="presence" value="1" checked/></td>';}
                }
            echo '
                </tbody>
            </table>';
            echo '<br><button type="submit" name="updatePresence" class="btn btn-success">Aggiorna appello</button>';
        }
        
        echo'</form>';
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
