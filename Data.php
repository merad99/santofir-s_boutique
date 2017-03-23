<?php 
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
               
      $register_username = (isset($_POST["register_username"]) ? $_POST["register_username"] : null);
      $register_email = (isset($_POST["register_email"]) ? $_POST["register_email"] : null);
      $register_password = (isset($_POST["register_password"]) ? $_POST["register_password"] : null);

      $login_username = (isset($_POST["login_username"]) ? $_POST["login_username"] : null);
      $login_password = (isset($_POST["login_password"]) ? $_POST["login_password"] : null);
      
      $req2 = $bdd->query("SELECT * FROM register_modpizza WHERE register_username = '$login_username' AND register_password = '$login_password'") or die(print_r($bdd->errorInfo()));
      if ($donnees2 = $req2->fetch()) 
            {
                  echo " Bonjour " . $donnees2["register_username"] . '<a href="">Logout</a>';    
            }
      else 
            {
                  echo '<a href="" data-toggle="modal" data-target="#login-modal">Login/Register</a>';
            }

            

      $req1 = $bdd->prepare("INSERT INTO register_modpizza(register_username, register_email, register_password) VALUES(?, ?, ?)") or die(print_r($bdd->errorInfo()));
      $req1->execute(array($register_username, $register_email, $register_password)); 

      $req1->closeCursor();
      
            

?>