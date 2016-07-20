<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *");

class InscriptionManager extends BDManager {

    public function stockAvatar() {

        $dossier = $_POST['dossier'] . "/";
        $fichier = basename($_FILES['icone']['name']);
        $nom = $_POST['nom'];

        var_dump($fichier);

        $fichier = strtr($fichier, 'À�?ÂÃÄÅÇÈÉÊËÌ�?Î�?ÒÓÔÕÖÙÚÛÜ�?àáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
        if (move_uploaded_file($_FILES['icone']['tmp_name'], $dossier . $nom)) {
            echo '';
        } else {

            echo 'Echec de l\'upload !';
        }
    }


}

use RestService\Server;

Server::create('/', new InscriptionManager)
        ->addPostRoute('stockAvatar', 'stockAvatar')
        ->run();
