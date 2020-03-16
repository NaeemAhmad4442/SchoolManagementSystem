<?php
    $fetchData = myquery($db, "SELECT * FROM notifications WHERE reciever = ".$_SESSION["userid"]." ORDER BY ID DESC LIMIT 10");

    $result = myquery($db, "SELECT * FROM Test
    WHERE Test.classID = (SELECT User.classID FROM User WHERE User.ID = ".$_SESSION["userid"].") AND date > CURDATE() ORDER BY Test.ID DESC LIMIT 10");

    $resultUsers = myquery($db, "SELECT * FROM User
    WHERE User.classID = (SELECT User.classID FROM User WHERE User.ID = ".$_SESSION["userid"].") ORDER BY User.ID DESC LIMIT 10");
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
                    <th>Azione</th>';
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

                echo '<tr><td>'.$list["subject"].'</td><td>'.$list["date"].'</td><td>'.$list["duration"].' minuti</td><td>'.$class.'</td><td>'.$name.'</td>
                <td><a href="view_test.php?testid='.$list["ID"].'"><button type="button" class="btn btn-primary">Gestisci</button></a></td>';
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

    if(empty($fetchData)){ echo "<br><h2>Nessun studente</h2>";}
    else{
    echo '<h2>Lista studenti</h2><table class="table table-hover">
    <thead>
        <tr>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Email</th>
        <th>Data di nascita</th>';
        echo'    
        </tr>
    </thead>
    <tbody>';
    foreach($resultUsers as $list)
    {
        
        echo '<tr><td>'.$list["name"].'</td><td>'.$list["surname"].'</td><td>'.$list["email"].'</td><td>'.$list["dateOfBirth"].'</td>';
    }
    echo '
    </tbody>
    </table><hr><br><br>';
    }
    
?>