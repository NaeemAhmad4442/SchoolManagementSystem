<?php
    $fetchData = myquery($db, "SELECT * FROM notifications WHERE reciever = ".$_SESSION["userid"]." ORDER BY ID DESC LIMIT 10");

    $classes = myquery($db, "SELECT * FROM Class");

    $resultUsers = myquery($db, "SELECT * FROM User WHERE taxStatus = 0 AND userLevel = 0 ORDER BY User.ID DESC LIMIT 10");
    $resultUsers1 = myquery($db, "SELECT * FROM User WHERE status = 0 AND userLevel = 0 ORDER BY User.ID DESC LIMIT 10");
    if(!empty($classes))
    {
        echo '<h3>Lista Classi</h3>
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
        </table><br><br>';
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

    if(empty($resultUsers)){ echo "<br><h2>Tutti i studenti hanno pagato le tasse!</h2>";}
    else{
    echo '<h3>Studenti che non hanno pagato le tasse</h3><table class="table table-hover">
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
        
        echo '<tr class="warning"><td>'.$list["name"].'</td><td>'.$list["surname"].'</td><td>'.$list["email"].'</td><td>'.$list["dateOfBirth"].'</td>';
    }
    echo '
    </tbody>
    </table><hr><br><br>';
    }

    if(empty($resultUsers1)){ echo "<br><h2>Nessun Utente in attesa di approvazione</h2><br><br>";}
    else{
    echo '<h3>Utenti in attesa di approvazione</h3><table class="table table-hover">
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
    foreach($resultUsers1 as $list)
    {
        
        echo '<tr class="danger"><td>'.$list["name"].'</td><td>'.$list["surname"].'</td><td>'.$list["email"].'</td><td>'.$list["dateOfBirth"].'</td>';
    }
    echo '
    </tbody>
    </table><hr><br><br>';
    }
    
?>