<?php

    if(isset($_GET["approveid"]))
    {
        $user = $_GET["approveid"];
        myquery($db, "UPDATE User SET status = 1 WHERE ID = '$user'");
    }
    $fetchData = myquery($db, "SELECT * FROM notifications WHERE reciever = ".$_SESSION["userid"]." ORDER BY ID DESC LIMIT 10");

    $resultUsers = myquery($db, "SELECT * FROM User WHERE  userLevel = 0 ORDER BY User.ID DESC LIMIT 20");
    $resultUsers1 = myquery($db, "SELECT * FROM User WHERE userLevel = 3 ORDER BY User.ID DESC LIMIT 10");
    $resultUsers2 = myquery($db, "SELECT * FROM User WHERE userLevel = 0 AND status = 0 ORDER BY User.ID DESC LIMIT 10");



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

    if(empty($resultUsers)){ echo "<br><h2>Lista studenti</h2>";}
    else{
    echo '<h3>Lista Studenti</h3><table class="table table-hover">
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

    if(empty($resultUsers1)){ echo "<br><h2>Nessun admin</h2><br><br>";}
    else{
    echo '<h3>Lista Admin</h3><table class="table table-hover">
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

    if(empty($resultUsers2)){ echo "<br><h2>Nessun utente da approvare</h2><br><br>";}
    else{
    echo '<h3>Utenti da approvare</h3><table class="table table-hover">
    <thead>
        <tr>
        <th>Nome</th>
        <th>Cognome</th>
        <th>Email</th>
        <th>Data di nascita</th>
        <th>Azione</th>';
        echo'    
        </tr>
    </thead>
    <tbody>';
    foreach($resultUsers2 as $list)
    {
        
        echo '<tr class="danger"><td>'.$list["name"].'</td><td>'.$list["surname"].'</td><td>'.$list["email"].'</td><td>'.$list["dateOfBirth"].'</td>
        <td><a href="index.php?approveid='.$list["ID"].'"><button class="btn btn-success">Approva</button></a></td>';
    }
    echo '
    </tbody>
    </table><hr><br><br>';
    }
    
?>