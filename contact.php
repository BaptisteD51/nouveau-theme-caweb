<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

if(isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["objet"]) && isset($_POST["message"])){
    /*var_dump($_POST);*/
    $message = "Envoyé par : " . $_POST["email"] . "\nTéléphone : " . $_POST["tel"] . "\nObjet : ". $_POST["objet"] . "\n\n" . $_POST["message"];
    $entrees = $_POST;

    $erreurs = [];
    if(!isset($_POST["prenom"]) || $_POST["prenom"] == ""){
        $erreurs['prenom'] = 'Veuillez renseigner le champ prénom';
    }

    if(!isset($_POST["email"]) || $_POST["email"] == "" || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $erreurs['email'] = 'Veuillez renseigner le champ Email avec une adresse valide';
        $entrees['email'] = '';
    }

    if(!isset($_POST["objet"]) || $_POST["objet"] == ""){
        $erreurs['objet'] = 'Veuillez renseigner le champ objet';
    }

    if(!isset($_POST["message"]) || $_POST["message"] == ""){
        $erreurs['message'] = 'Veuillez renseigner le champ message';
    }

    /*var_dump($erreurs);*/
    session_start();

    if(!empty($erreurs)){
        $_SESSION['erreurs'] = $erreurs;
        $_SESSION['entrees'] = $entrees;
        header("Location: http://baptistedufour.fr/#s4");
    }else{
        $_SESSION['retour'] = 1;
        mail("dufourbaptiste08@gmail.com", $_POST["objet"], $message, "Reply-to:".$_POST["email"]);
        header("Location: http://baptistedufour.fr/#s4");
    }
    
    /*$retour = 
    if($retour){
        echo "<div class='retour'> <p><i class='fa-solid fa-check'></i> Votre message a bien été envoyé !</p> <a onclick='fermerRetour(this)'><i class='fa-solid fa-xmark'></i></a></div>";
    }*/
}