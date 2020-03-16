<?php require "include/header.php";
if(!isset($_SESSION['userid']))
{
	header("Location:login.php"); 
}
?>
<?php require "include/navbar.php" ?>
<?php
$db = connectdb();
if($_SESSION["level"]!=3) {header("Location:index.php");}
if(isset($_POST["saveChanges"]))
{

    $name = escapestringex($db,$_POST['name']);
    $class = escapestringex($db,$_POST['classSelect']);
    $date = escapestringex($db,$_POST['date']);
    $time = escapestringex($db,$_POST['time']);
    $myres = myquery($db, "UPDATE rooms SET description = ".$name.", class = ".$class.", time = ".$time.", date = ".$date." WHERE ID = ".$_GET["roomid"]."");
}
$classes = myquery($db, "SELECT * FROM rooms");

?>

  <div class="content-wrapper">
    <div class="container-fluid">
    <br><br>
    <?php
    if(!empty($classes))
    {
        echo '
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Prenotata per classe</th>
                    <th>Data/ora</th>';
                    if($_SESSION["level"]==3) echo '<th>Action</th>';
                echo'    
                </tr>
            </thead>
            <tbody>';
            foreach($classes as $list)
            {   
                echo '<tr>
                <td>'.$list["ID"].'</td>
                <td>'.$list["description"].'</td>';
                if($list["class"]=="-1")
                {
                    echo '<td>Libera</td><td>N/A</td>';
                }else{
                    $myres = myquery($db,  "SELECT name FROM Class");
                    echo '<td>'.$myres[0]["name"].'</td><td>'.$list["date"].' '.$list["time"].'</td>';
                }
                echo '<td><a href="edit_room.php?roomid='.$list["ID"].'"><font color="green"><i class="fa fa-pencil"></i></font></td></tr>';
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
