<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <p>Bonjour 
            <?php 
            require_once __DIR__ . '/vendor/autoload.php';
            session_start();
            $fb = new Facebook\Facebook([
              'app_id' => '753567141463897',
              'app_secret' => '5de7a54596e18c03b41e138bef9ca937',
              'default_graph_version' => 'v2.5',
             ]);
 
            $helper = $fb->getRedirectLoginHelper();
 
            try 
            {
                $accessToken = $helper->getAccessToken();
            } 
            catch(Facebook\Exceptions\FacebookResponseException $e) 
            {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } 
            catch(Facebook\Exceptions\FacebookSDKException $e) 
            {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
 
           if (! isset($accessToken)) {
              if ($helper->getError()) {
                 header('HTTP/1.0 401 Unauthorized');
                 echo "Error: " . $helper->getError() . "\n";
                 echo "Error Code: " . $helper->getErrorCode() . "\n";
                 echo "Error Reason: " . $helper->getErrorReason() . "\n";
                 echo "Error Description: " . $helper->getErrorDescription() . "\n";
              } 
              else {
                 header('HTTP/1.0 400 Bad Request');
                 echo 'Bad request';
                   }
              exit;
            }
 
             // Logged in
             // The OAuth 2.0 client handler helps us manage access tokens
            $oAuth2Client = $fb->getOAuth2Client();
 
            // Get the access token metadata from /debug_token
            $tokenMetadata = $oAuth2Client->debugToken($accessToken);
 
            // Get user’s Facebook ID
            $userId = $tokenMetadata->getField('user_id');

            try 
            {
               // Returns a `Facebook\FacebookResponse` object
               $response = $fb->get('/me?fields=id,name', $accessToken);
            } 
            catch(Facebook\Exceptions\FacebookResponseException $e) 
            {
               echo 'Graph returned an error: ' . $e->getMessage();
               exit;
            } 
            catch(Facebook\Exceptions\FacebookSDKException $e) 
            {
               echo 'Facebook SDK returned an error: ' . $e->getMessage();
               exit;
            }
 
             $user = $response->getGraphUser();
 
             $userId = $user['id']; // Retrieve user Id
             $userName = $user['name']; // Retrieve user name
            

              if (isset($_GET["prenom"]) AND isset($_GET["nom"])) // On a le nom et le prénom 
                { 
                   echo "Bonjour " . $_GET["prenom"] . " " . $_GET["nom"] . " !"; 
                } 
              else // Il manque des paramètres, on avertit le visiteur 
                { 
                   echo "Il faut renseigner un nom et un prénom !"; 
                } 
                
            ?> 
            <div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>
        </p>
        <p>Bonjour !</p>
        <p>Je sais comment tu t’appelles, hé hé. Tu t’appelles 
            <?php echo $_POST["pseudo"] . " " . $_POST["pass"] . " " . $_POST["message"] ; ?> 
        </p> 
        <p>Si tu veux changer de prénom, <a href="index.php">clique ici</a> </p>
        <?php // Testons si le fichier a bien été envoyé et s’il n’y a pas d’erreur 
            if (isset($_FILES["monfichier"]) AND $_FILES["monfichier"]["error"] == 0) 
            {
                 if ($_FILES["monfichier"]["size"] <= 1000000) 
                 {
                     $infosfichier = pathinfo($_FILES["monfichier"]["name"]); 
                     $extension_upload = $infosfichier["extension"]; 
                     $extensions_autorisees = array("txt"); 
                     if (in_array($extension_upload, $extensions_autorisees)) 
                     {
                          echo "L’envoi a bien été effectué !";

                     }

                 
                 }

            } 
            ?>
            <?php
            if (isset($_POST["admin"]) AND isset($_POST["cle"])) 
            {
                 if ($_POST["cle"] == "kangourou") 
                 {
                     echo "<p>Voici les codes d’accès</p>
                     <p><strong>CRD5-GTFT-CK65-JOPM-V29N-24G1-HH28-LLFV</strong></p>
                     <p> Cette page est réservée au personnel de la NASA. N’oubliez pas de la visiter régulièrement car les codes d’accès sont changés toutes les semaines.<br /> 
                     La NASA vous remercie de votre visite. </p>";


                 }
                 else
                 {
                     echo "mot de passe invalid";
                 }

            } 
           
            ?>
            <pre> 
            <?php 
            setcookie("pseudo", $_POST["admin"], time() + 365*24*3600, null, null, false, true); 
            setcookie("password", $_POST["cle"], time() + 365*24*3600, null, null, false, true); 
            setcookie("text", $monfichier, time() + 365*24*3600, null, null, false, true); 
            //print_r($_GET); 
            print_r($_POST);
            //echo ($_SERVER["REMOTE_ADDR"]); 
            //print_r($_ENV); 
            echo $_COOKIE["pseudo"] . " " . $_COOKIE["password"] . " " . $_COOKIE["text"] ;
            print_r ($_SESSION);
            //print_r($_FILES);
            //print_r($_REQUEST);    
            
            ?> 
            <?php 
                          if($_SESSION['logged']==true){ 
                              //echo $_SESSION["username"];
                              echo '<a href="#">Logout</a>';
                              }
                          elseif($_SESSION['logged']==false) 
                              echo '<a href="#">Login/Register</a>';
                    

            ?>
            </pre>
            


    <body>
</html>
     
