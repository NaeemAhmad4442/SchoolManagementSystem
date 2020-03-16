<?php
    $fetchData = myquery($db, "SELECT * FROM notifications WHERE reciever = ".$_SESSION["userid"]." ORDER BY ID DESC LIMIT 10");
    $fetchData1 = myquery($db, "SELECT * FROM Note WHERE studentID = ".$_SESSION["userid"]." ORDER BY ID DESC LIMIT 10");

    $result = myquery($db, "SELECT * FROM Test
    WHERE Test.classID = (SELECT User.classID FROM User WHERE User.ID = ".$_SESSION["userid"].") AND date > CURDATE() ORDER BY Test.ID DESC LIMIT 10");
    if(!empty($result))
    {
        echo '
        <h3>Verifiche in vicinanza</h2>    
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Data</th>
                    <th>Durata</th>
                    <th>Classe</th>
                    <th>Professore</th>
                    <th>Punteggio</th>';
                echo'    
                </tr>
            </thead>
            <tbody>';
            foreach($result as $list)
            {
                $fetchclass = myquery($db, "SELECT name FROM Class WHERE ID = ".$list["classID"]."");
                $class = $fetchclass[0]["name"];
                
                $fetchclass = myquery($db, "SELECT name, surname FROM User WHERE ID = ".$list["teacherID"]."");
                $name = $fetchclass[0]["name"]. " ".$fetchclass[0]["surname"];    
                
                $fetchMarks = myquery($db, "SELECT * FROM test_registrations WHERE testID=".$list["ID"]." AND studentID = ".$_SESSION["userid"]."");

                $points = "Non disponibile";
                if(!empty($fetchMarks)) {$points = $fetchMarks[0]["vote"];}

                echo '<tr><td>'.$list["subject"].'</td><td>'.$list["date"].'</td><td>'.$list["duration"].' minuti</td><td>'.$class.'</td><td>'.$name.'</td>
                <td>'.$points.'</td>';
            }
        echo '
            </tbody>
        </table><hr><br><br>';
    }
    else{
        echo "<h3>Nessuna verifica in vicinanza</h2><hr><br><br>";
    }


    if(empty($fetchData)){ echo "<br><h2>Nessuna notifica</h2>";}
    else{
    echo '<h2>Lista notifiche recenti</h2><table class="table table-hover">
    <thead>
        <tr>
            <th>Da</th>
            <th>Data/Ora</th>
            <th>Messaggio</th>';
        echo'    
        </tr>
    </thead>
    <tbody>';
    foreach($fetchData as $data)
    {

        $fetchStudent = myquery($db, "SELECT name, surname FROM User WHERE ID = ".$data["sender"]."");
        $student = $fetchStudent[0]["name"]. " ".$fetchStudent[0]["surname"];
        echo '
        <tr><td>'.$student.'</td><td>'.$data["message"].'</td><td>'.$data["timestamp"].'</td></tr>';
    }
    echo '
    </tbody>
    </table><hr><br><br>';
    }

    if(empty($fetchData)){ echo "<br><h2>Nessuna Nota</h2>";}
    else{
    echo '<h2>Lista Note recenti</h2><table class="table table-hover">
    <thead>
        <tr>
            <th>Professore</th>
            <th>Nota</th>';
        echo'    
        </tr>
    </thead>
    <tbody>';
    foreach($fetchData1 as $data)
    {
        $fetchTeacher = myquery($db, "SELECT name, surname FROM User WHERE ID = ".$data["teacherID"]."");
        $teacher = $fetchTeacher[0]["name"]. " ".$fetchTeacher[0]["surname"];
        echo '
        <tr><td>'.$teacher.'</td><td>'.$data["note"].'</td></tr>';
    }
    echo '
    </tbody>
    </table><hr><br><br>';
    }
    
?>