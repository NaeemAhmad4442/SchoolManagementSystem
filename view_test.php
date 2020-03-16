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
if(!isset($_GET["testid"])) {header("Location:tests.php");}
if(isset($_GET["mark"]))
{
    $fetchMarks = myquery($db, "SELECT * FROM test_registrations WHERE testID=".$_GET["testid"]." AND studentID = ".$_GET["userid"]."");
    if(!empty($fetchMarks))
    {
        $updateMarks = myquery($db, "UPDATE test_registrations SET vote=".$_GET["mark"]." WHERE testID=".$_GET["testid"]." AND studentID = ".$_GET["userid"]."");
    }
    else
    {
        myinsert($db, "INSERT INTO test_registrations(testID, vote, studentID) VALUES (".$_GET["testid"].", ".$_GET["mark"].", ".$_GET["userid"].")");
    }
}



$fetchTestData = myquery($db, "SELECT * FROM Test WHERE ID = ".$_GET["testid"]."");
$fetchclass = myquery($db, "SELECT name FROM Class WHERE ID = ".$fetchTestData[0]["classID"]."");
$className = $fetchclass[0]["name"];

$fetchclass = myquery($db, "SELECT name, surname FROM User WHERE ID = ".$fetchTestData[0]["teacherID"]."");
$teacherName = $fetchclass[0]["name"]. " ".$fetchclass[0]["surname"];

$fetchStudentsList = myquery($db, "SELECT User.ID, name, surname, email FROM User, Test WHERE Test.ID = ".$_GET["testid"]." AND Test.classID = User.classID");

?>
<?php require "include/navbar.php" ?>
  <div class="content-wrapper">
    <div class="container-fluid">
    <br><br>
    <strong>Materia:</strong> <?php echo $fetchTestData[0]["subject"] ?><br>
    <strong>Descrizione:</strong> <?php echo $fetchTestData[0]["description"] ?><br>
    <strong>Data e ora:</strong> <?php echo $fetchTestData[0]["date"] ?><br>
    <strong>Durata</strong> <?php echo $fetchTestData[0]["duration"] ?><br>
    <strong>Classe:</strong> <?php echo $className ?><br>
    <strong>Professore</strong> <?php echo $teacherName ?><br><br><br>
    Lista studenti iscritti:
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th>email</th>
                <th>Voto</th>    
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($fetchStudentsList as $list)
            {
                $fetchMarks = myquery($db, "SELECT * FROM test_registrations WHERE testID=".$_GET["testid"]." AND studentID = ".$list["ID"]."");
                if(empty($fetchMarks)) $marks = -1;
                else {$marks = $fetchMarks[0]["vote"];}
                echo '<tr><td>'.$list["name"].' '.$list["surname"].'</td><td>'.$list["email"].'</td>';
                if($marks==-1) {echo '<td><form action="view_test.php" method="GET"><input type="hidden" name="userid" value="'.$list["ID"].'"/><input type="hidden" name="testid" value="'.$_GET["testid"].'"/>Inserisci il voto: <input type="number" max="100" min="0" name="mark" style="width:40px; height:40px" placeholder="voto"/> <button type="submit" class="btn btn-success">Conferma</button></form></td>';}
                else {echo '<td>'.$marks.'</td>';}
            }
        ?>
        </tbody>
    </table>
    
    
    
    
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
