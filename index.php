
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
    <title>Notre première instruction : echo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" , →
    /> 
</head>

<body>
    <form method="post" action="index.php">
          <label for="Pseudo">Pseudo</label> : <input type="text" name="Pseudo" id="¨Pseudo" /><br />  
          <label for="Message">Message</label> : <input type="text" name="Message" id="Message" /><br />  
          <input type="submit" value="Envoyer" /> 

    </form>

    <?php
            require_once __DIR__ . '/vendor/autoload.php';
            session_start();
            $fb = new Facebook\Facebook([
            'app_id' => '753567141463897',
            'app_secret' => '5de7a54596e18c03b41e138bef9ca937',
            'default_graph_version' => 'v2.5',
             ]);
 
            $helper = $fb->getRedirectLoginHelper();
 
            $permissions = []; // Optional information that your app can access, such as 'email'
            $loginUrl = $helper->getLoginUrl('http://localhost/tests/ModPizza/Bonjour.php', $permissions);
 
            echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook</a>';
 
            
            try
            {
                // On se connecte à MySQL
                $bdd = new PDO("mysql:host=localhost;dbname=ModPizza", "root", "124578");
            }
            
            catch (Exception $e) 
            { 
                // En cas d’erreur, on affiche un message et on arrête tout
                die("Erreur : " . $e->getMessage()); 
            } 
            
            $register_username = (isset($_POST['register_username']) ? $_POST['register_username'] : null);
            $register_email = (isset($_POST['register_email']) ? $_POST['register_email'] : null);
            $register_password = (isset($_POST['register_password']) ? $_POST['register_password'] : null);
            $req = $bdd->prepare("INSERT INTO register_modpizza(register_username, register_email, register_password) VALUES(?, ?, ?)") or die(print_r($bdd->errorInfo()));
            $req->execute(array($register_username, $register_email, $register_password)); 
            
            /*$req = $bdd->prepare("INSERT INTO mini_chat(pseudo, message) VALUES(?, ?)") or die(print_r($bdd->errorInfo()));
            $req->execute(array($_POST["Pseudo"], $_POST["Message"] ));*/

            $reponse1 = $bdd->query("SELECT * FROM mini_chat ORDER BY ID DESC LIMIT 0, 10 ") or die(print_r($bdd->errorInfo()));
            while($donnees1 = $reponse1->fetch()){
                echo '<strong>'  .  $donnees1["pseudo"]  .  '</strong> : '  .  $donnees1["message"]  .  $donnees1["date_creation"]  .  '<br />';  
            }
    ?>
    <div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>
    <h2>Affichage de texte avec PHP</h2>
    <p>
        Cette ligne a été écrite entièrement en HTML.<br />
        <a href="bonjour.php?nom=Dupont&amp;prenom=Jean">Dis-moi bonjour !</a>
        <?php 
        
        $visitor_age = 10;
        $prenom = array("François", "Michel", "Nicole", "Véronique", "Benoît");
        function calculCube($num)
        {
            echo $num*3;
        }
        for ($i = 0 ; $i < 5; $i++ ){
            echo 'Bonjour' . $prenom[$i] . '<br />';

        }
        calculCube($visitor_age);
        echo "the visitor's age is $visitor_age";
        "<br />" ;
        if ($visitor_age <= 12){
            echo " you are not autorised to enter this site !<br />";
        }
        else
        {
            echo " welcome <br />";
        }
        ?><br />

        <?php echo "Celle-ci a été écrite entièrement en PHP."; ?> <br />
        <?php include("menu.php"); ?> 
        <?php 
            
            $monfichier = fopen("fichier.txt", "r+");
            fputs($monfichier, "Texte à écrire"); 
            $pages_vues = fgets($monfichier); // On lit la première ligne 
            $pages_vues++; // On augmente de 1 ce nombre de pages vues
            fseek($monfichier, 0); // On remet le curseur au début du fichier
            fclose($monfichier); 
             // On ajoute une entrée dans la table jeux_video 
            //$bdd->exec("INSERT INTO jeux_video VALUES('51', 'Battlefield 1942', 'Patrick', 'PC', 45, 50, '2nde guerre mondiale')") or die(print_r($bdd->errorInfo()));
            //echo "Le jeu a bien été ajouté ! <br />";
            //$bdd->exec("UPDATE jeux_video SET prix = 10, nbre_joueurs_max = 32 WHERE nom = 'Battlefield 1942'") or die(print_r($bdd->errorInfo()));
            //$bdd->exec("DELETE FROM jeux_video WHERE nom='Battlefield 1942'") or die(print_r($bdd->errorInfo()));
            // On récupère tout le contenu de la table jeux_video
            //$bdd->exec("UPDATE jeux_video SET ID_proprietaire = 1 WHERE possesseur = 'Florent'") or die(print_r($bdd->errorInfo()));
            //$bdd->exec("UPDATE jeux_video SET ID_proprietaire = 2 WHERE possesseur = 'Patrick'") or die(print_r($bdd->errorInfo()));
            //$bdd->exec("UPDATE jeux_video SET ID_proprietaire = 3 WHERE possesseur = 'Michel'") or die(print_r($bdd->errorInfo()));
            //$bdd->exec("UPDATE jeux_video SET ID_proprietaire = 4 WHERE possesseur = 'Mathieu'") or die(print_r($bdd->errorInfo()));
            //$bdd->exec("UPDATE jeux_video SET ID_proprietaire = 5 WHERE possesseur = 'Sebastien'") or die(print_r($bdd->errorInfo()));
            //$bdd->exec("UPDATE jeux_video SET ID_proprietaire = 6 WHERE possesseur = 'Corentin'") or die(print_r($bdd->errorInfo()));           
            $reponse3 = $bdd->query("SELECT j.nom nom_jeu, p.prenom prenom_proprietaire FROM proprietaires p INNER JOIN jeux_video j ON j.ID_proprietaire = p.ID WHERE j.console = 'PC'ORDER BY prix DESC LIMIT 0, 10") or die(print_r($bdd->errorInfo()));
            while ($donnees3 = $reponse3->fetch()) 
            {
    
               echo $donnees3["nom_jeu"] . " " . $donnees3["prenom_proprietaire"] . " <br />";
            }
            /*$reponse2 = $bdd->query("SELECT * FROM jeux_video ORDER BY prix") or die(print_r($bdd->errorInfo())); 
            // On affiche chaque entrée une à une 
            while ($donnees2 = $reponse2->fetch()) 
            {
    
               echo $donnees2["nom"] . " coûte " . $donnees2["prix"] . " EUR<br />";
            }*/
            /*$reponse3 = $bdd->query("SELECT AVG(prix) AS prix_moyen, console FROM jeux_video GROUP BY console HAVING prix_moyen <= 10 ");
            while ($donnees3 = $reponse3->fetch()) 
            {
    
               echo $donnees3["prix_moyen"] . " Moyen par console " . $donnees3["console"] . " <br />";
            }*/
            $reponse3->closeCursor(); // Termine le traitement de la requête
           
        ?>
        

    </p>
    <form method="post" action="Bonjour.php">
          <input type="text" name="pseudo" /><br /> 
          <input type="password" name="pass" /><br /> 
          <textarea name="message" rows="8" cols="45"> Votre message ici. </textarea><br /> 
          <input type="submit" value="Valider" /> 

    </form>
    <form action="Bonjour.php" method="post" enctype="multipart/form-data"> 
        <p>
            Formulaire d’envoi de fichier :<br /> 
            <input type="file" name="monfichier" /><br /> 
            <input type="submit" value="Envoyer le fichier" />
        </p>
 </form>
 <form method="post" action="Bonjour.php">
          <input type="text" name="admin" /><br /> 
          <input type="password" name="cle" /><br /> 
          <input type="submit" value="Valider" /> 

    </form>

    
    <div id="corps"> 
        <h1>Mon super site</h1>
        <p> 
          Bienvenue sur mon super site !<br /> Vous allez adorer ici, c’est un site génial qui va parler de...
          , euh... Je cherche encore un peu le thème de mon site. :-D 
        </p> 
    </div>
    <?php
    print_r($_SESSION);

    if($_SESSION)
    { 
        //echo $_SESSION["username"];
        echo '<a href="#">Logout</a>';
    }
    else
        echo '<a href="#">Login/Register</a>';
    ?>



</body>

</html>