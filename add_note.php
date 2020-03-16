<?php require "include/header.php";
if(!isset($_SESSION['userid']))
{
	header("Location:login.php"); 
}
?>
<?php
$db = connectdb();
if($_SESSION["level"]!=2) {header("Location:index.php");}

$db = connectdb();
$fetchStudents = myquery($db, "SELECT * FROM User WHERE classID = (SELECT User.classID FROM User WHERE User.ID = ".$_SESSION["userid"].") AND userLevel = 0 ORDER BY User.ID DESC");

if(isset($_POST["addNote"]))
{
    $note = escapestringex($db,$_POST['note']);   
    $student = escapestringex($db,$_POST['StudentSelect']);
    
    $myres = myquery($db, "INSERT INTO Note(studentID, teacherID, note) VALUES (".$student.", ".$_SESSION["userid"].", ".$note.")");
    $msg = "<font color='green'>Nota aggiunta con successo. reindirizzamento in corso...</font>";
    header( "refresh:2;url=index.php");
}

?>
<?php require "include/navbar.php" ?>
  <div class="content-wrapper">
    <div class="container-fluid">
    <br><br><br>
    <form action="add_note.php" method="POST">
    <div style="margin-left:400px"><div class="form-group">
        
    <?php
        echo'
        Seleziona lo Studente:
        <div class="form-group">
        <select name="StudentSelect" class="form-control" style="width:50%">';
        foreach($fetchStudents as $student)
        {
            $class = "Nessuna classe";
            $fetchclass = myquery($db, "SELECT name FROM Class WHERE ID = ".$student["classID"]."");
            if(!empty($fetchclass)) {$class = $fetchclass[0]["name"];}
            echo '<option value='.$student["ID"].'>'.$student["name"].' '.$student["surname"].' - ('.$class.')</option>';
        }
        echo'
        </select>
        </div>';
    ?>
    <label for="note">Nota</label>
    <textarea style="width:50%" type="text" placeholder="Inserisci la nota" name="note" required="" class="form-control" id="note"> </textarea>
    </div>
    <button type="submit" style="width:50%" class="form-control btn btn-success" name="addNote">Aggiungi Nota</button>
    </form><br>
    <?php
    if(isset($msg)) {echo $msg;}
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
