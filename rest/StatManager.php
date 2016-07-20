<?php
include 'vendor/autoload.php';
require_once("Db/BDManager.php");
header("Access-Control-Allow-Origin: *");


class StatManager extends BDManager
{

    public function GetPercentByCategorie()
    {
        $reponse = $this->executeList("select cat.libelle as label, count(*) as data,cat.color as color 
            from categorie cat, utilisateur u where u.statut=cat.libelle group by cat.libelle");
        return $reponse;
    }


    public function StatAll()
    {
        $reponse = $this->executeList("SELECT * From (SELECT COUNT(*) as nbrfemmes FROM utilisateur where civilite='F') as tabFemmes,
 (SELECT COUNT(*) as nbrhommes FROM utilisateur where civilite='M') as tabHommes ,
  (SELECT COUNT(*) as nbrEtudiants FROM utilisateur where statut='Etudiant')
 as tabEtudiants, (SELECT COUNT(*) as totalthiantacones FROM utilisateur) as tabThiantas");
        return $reponse;
    }

}

use RestService\Server;

Server::create('/', new StatManager)
    ->addGetRoute('StatAll', 'StatAll')
    ->addGetRoute('GetPercentByCategorie', 'GetPercentByCategorie')
    ->run();