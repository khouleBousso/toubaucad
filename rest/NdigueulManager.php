<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
// require_once("entities/ClassEleve.php");
header("Access-Control-Allow-Origin: *");

class NdigueulManager extends BDManager {

    public function getKurels() {
        $reponse = $this->executeList("SELECT k.id, k.nom, concat(u.prenom,' ',u.nom) as dieuwrigne, count(i.id) as nbthiantacones  FROM kurel k left outer join utilisateur u on u.id = k.dieuwrigne "
                . "left outer join inscrit_kurel i on  i.id_kurel = k.id group by k.id");
        return $reponse;
    }

    public function getKurelById($kurelId) {
        $reponse = $this->executeList("SELECT k.* from kurel k  where k.id='$kurelId'");
        return $reponse;
    }

    public function getNdigueulById($ndigueulId) {
        $reponse = $this->executeList("SELECT id, nom,collecteur,DATE_FORMAT(date_debut,'%d/%m/%Y') as date_debut,DATE_FORMAT(date_fin,'%d/%m/%Y') as date_fin From ndigueul  where id='$ndigueulId'");
        return $reponse;
    }

    public function getUserInscritsKurel($kurelId) {
        $reponse = $this->executeList("SELECT u.id as id_user, u.nom as nom_user, u.prenom, u.email, u.profile_id, k.nom from kurel k ,utilisateur u , inscrit_kurel ik where  ik.id_kurel = k.id and ik.id_utilisateur = u.id and  k.id='$kurelId' order by u.profile_id asc");
        return $reponse;
    }

    public function addKurel() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $nom = $request->nom;
        $dieuwrigne = $request->dieuwrigne;
        $this->executeUpdate("Insert into kurel (nom, dieuwrigne) values ( '$nom', '$dieuwrigne')");
        $id_kurel = $this->GetLastKurel()[0]['id_kurel'];
        $this->executeUpdate("Insert into inscrit_kurel (id_kurel, id_utilisateur) values ( '$id_kurel', '$dieuwrigne')");
    }

    public function modKurel() {


        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $nom = $request->nom;
        $id_kurel = $request->id;
        $this->executeUpdate("Update kurel set nom='$nom' where id='$id_kurel'");
    }

    public function archiveNdigueul($ndigueul, $motifArchNdigueul) {

        $this->executeUpdate("Update ndigueul set motif_archivage='$motifArchNdigueul' , archive=1 where id='$ndigueul'");
    }

    public function restoreNdigueul($ndigueul, $motifRestoreNdigueul) {

        $this->executeUpdate("Update ndigueul set motif_restauration='$motifRestoreNdigueul' , archive=0 where id='$ndigueul'");
    }

    public function addNdigueul() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $nom = $request->nom;
        $collecteur = $request->collecteur;
        $date_deb = $request->date_debut;
        $date_deb_explode = explode("/", $date_deb);
        $date_debut = $date_deb_explode[2] . '-' . $date_deb_explode[1] . '-' . $date_deb_explode[0];
        $date_fin = "";
        if (isset($request->date_fin)) {
            $date_f = $request->date_fin;
            $date_fin_explode = explode("/", $date_f);
            $date_fin = $date_fin_explode[2] . '-' . $date_fin_explode[1] . '-' . $date_fin_explode[0];
            $this->executeUpdate("Insert into ndigueul (nom, collecteur,date_debut,date_fin,date_creation) values ( '$nom', '$collecteur','$date_debut','$date_fin',NOW())");
        } else {

            $this->executeUpdate("Insert into ndigueul (nom, collecteur,date_debut,date_creation) values ( '$nom', '$collecteur','$date_debut',NOW())");
        }
    }

    public function modNdigueul() {


        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $nom = $request->nom;
        $collecteur = $request->collecteur;
        $id_ndigueul = $request->id;
        $date_deb = $request->date_debut;
        $date_deb_explode = explode("/", $date_deb);
        $date_debut = $date_deb_explode[2] . '-' . $date_deb_explode[1] . '-' . $date_deb_explode[0];

        $date_fin = "";
        if (isset($request->date_fin)) {
            $date_f = $request->date_fin;
            $date_fin_explode = explode("/", $date_f);
            $date_fin = $date_fin_explode[2] . '-' . $date_fin_explode[1] . '-' . $date_fin_explode[0];
            $this->executeUpdate("Update ndigueul set nom='$nom', collecteur='$collecteur', date_debut ='$date_debut',date_fin='$date_fin' where id='$id_ndigueul'");
        } else {
            $this->executeUpdate("Update ndigueul set nom='$nom', collecteur='$collecteur', date_debut ='$date_debut' where id='$id_ndigueul'");
        }
    }

    public function GetLastKurel() {
        $reponse = $this->executeList("SELECT max(id) as id_kurel FROM kurel");
        return $reponse;
    }

    public function getNdigueuls() {
        $reponse = $this->executeList("SELECT n.id , n.nom , concat(u.prenom,' ',u.nom) as collecteur,DATE_FORMAT(date_debut,'%d/%m/%Y') as date_debut,DATE_FORMAT(date_fin,'%d/%m/%Y') 
as date_fin  From ndigueul n left outer join utilisateur u on u.id = n.collecteur  where n.archive=0 order by date_creation desc");
        return $reponse;
    }

    public function getNdigueulsArchive() {
        $reponse = $this->executeList("SELECT n.id , n.nom , concat(u.prenom,' ',u.nom) as collecteur,DATE_FORMAT(date_debut,'%d/%m/%Y') as date_debut,DATE_FORMAT(date_fin,'%d/%m/%Y') as date_fin  From ndigueul n left outer join utilisateur u on u.id = n.collecteur  where n.archive=1 order by date_creation desc");
        return $reponse;
    }

    public function ListSass($kurel, $ndigueul) {
        $reponse = $this->executeList("SELECT s.id_sass, code , ndi.nom as nom_ndigueul,  concat(u.prenom,' ',u.nom) as membreInf , "
                . "s.membre, montant, DATE_FORMAT(date,'%d/%m/%Y') as date , sum(t.tabi)as tabis, solde FROM sass s "
                . "left outer join tabis t on t.id_sass=s.id_sass left outer join utilisateur u on s.membre= u.id left outer join ndigueul ndi on ndi.id= s.id_ndigueul "
                . "where id_kurel = '$kurel' and s.id_ndigueul='$ndigueul' and s.archive=0 group by s.id_sass asc order by s.membre asc ");
        return $reponse;
    }

    public function ListTabis($kurel, $ndigueul) {
        $reponse = $this->executeList("SELECT id_tabi,t.id_sass,mode, concat(u.prenom,' ',u.nom) as membreInf , t.membre, tabi, DATE_FORMAT(date_tabi,'%d/%m/%Y') as date_tabi FROM tabis t,sass s,utilisateur u "
                . "where t.id_sass = s.id_sass and t.membre= u.id and s.id_kurel = '$kurel'  "
                . "and s.id_ndigueul='$ndigueul' and t.archive=0 order  by membre asc");
        return $reponse;
    }
    
    public function GetTotalTabis($kurel, $ndigueul) {
        $reponse = $this->executeList("SELECT sum(tabi) as totaltabis from tabis t,sass s  WHERE t.id_sass = s.id_sass and t.archive=0 and s.id_kurel = '$kurel' and s.id_ndigueul='$ndigueul'");
		return $reponse;
    }

    public function GetSoldeSass($id_sass) {
        $reponse = $this->executeList("SELECT  solde  FROM sass where id_sass='$id_sass'");
        return $reponse;
    }

    public function  getPercents(){
        $reponse = $this->executeList("SELECT n.nom , n.id,(sum(montant) + sum(solde)) / sum(montant) * 100 
             as percent FROM sass s , ndigueul n where n.id = s.id_ndigueul and n.archive =0 group by n.id");
        return $reponse;
    }

    public function AddSass() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id_kurel = $request->id_kurel;
        $montant = $request->montant;
        $datesass = $request->date;
        $date = explode("/", $datesass);
        $date_sass = $date[2] . '-' . $date[1] . '-' . $date[0];
        $id_ndigueul = $request->id_ndigueul;
        $membre = $request->membre;
        date_default_timezone_set('Africa/Dakar');
        $datetime = new DateTime();
        $code = $datetime->format("YmdHis");
        $this->executeUpdate("Insert into sass(date,code, montant,id_kurel, id_ndigueul,membre,solde) values ('$date_sass','$code', '$montant','$id_kurel','$id_ndigueul','$membre','-$montant')");
    }

    public function AddTabi() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $membre = $request->membre;
        $id_sass = "";
        if(isset($request->id_sass))
        {
            $id_sass = $request->id_sass;
        }
        $tabi = $request->tabi;
        $mode = $request->mode;
        $date_tabi = $request->date_tabi;
        $date = explode("/", $date_tabi);
        $datetabi = $date[2] . '-' . $date[1] . '-' . $date[0];
        $solde = 0;
         if(isset($request->solde))
         {
              $solde = ($request->solde * -1) + $tabi;
         }
         else $solde = $tabi;
         
        $this->executeUpdate("Insert into tabis(membre, id_sass, tabi, mode,  date_tabi) values ('$membre','$id_sass', '$tabi', '$mode', '$datetabi')");

        $this->executeUpdate("Update sass set solde='$solde' where id_sass ='$id_sass'");
    }

    public function UpdateSass() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $montant = $request->montant;
        $id_sass = $request->id_sass;
        $date_sass = $request->date;
        $date = explode("/", $date_sass);
        $datesass = $date[2] . '-' . $date[1] . '-' . $date[0];
        $totaltabis = $this->GetSommeTabis($id_sass)[0]['totaltabis'];
        $solde = ($montant - $totaltabis) * -1;
        $this->executeUpdate("Update sass set  montant='$montant',solde='$solde', date='$datesass' where id_sass ='$id_sass'");
    }

    public function GetSommeTabis($numero) {
        $reponse = $this->executeList("SELECT sum(tabi) as totaltabis from tabis WHERE id_sass = '$numero' and archive=0");
        return $reponse;
    }

    public function getSassById($sass_id) {
        $reponse = $this->executeList("SELECT id_sass,  code , membre, montant, id_kurel, id_ndigueul, DATE_FORMAT(date,'%d/%m/%Y') as date , solde FROM sass where id_sass='$sass_id'");
        return $reponse;
    }

    public function getSassByMembre($membre, $kurel, $ndigueul) {
        $reponse = $this->executeList("SELECT id_sass,  code  FROM sass where membre='$membre' and id_kurel = '$kurel' and id_ndigueul='$ndigueul' and sass.archive=0 ");
        return $reponse;
    }

}

use RestService\Server;

Server::create('/', new NdigueulManager)
        ->addGetRoute('getKurels', 'getKurels')
        ->addGetRoute('getNdigueuls', 'getNdigueuls')
        ->addGetRoute('getNdigueulsArchive', 'getNdigueulsArchive')
        ->addGetRoute('getSassByMembre', 'getSassByMembre')
        ->addGetRoute('ListSass', 'ListSass')
        ->addGetRoute('ListTabis', 'ListTabis')
        ->addGetRoute('getKurelById/(.*)', 'getKurelById')
        ->addGetRoute('getNdigueulById/(.*)', 'getNdigueulById')
        ->addGetRoute('getSassById/(.*)', 'getSassById')
        ->addGetRoute('getUserInscritsKurel/(.*)', 'getUserInscritsKurel')
        ->addPostRoute('addKurel', 'addKurel')
        ->addGetRoute('archiveNdigueul', 'archiveNdigueul')
        ->addGetRoute('restoreNdigueul', 'restoreNdigueul')
        ->addPostRoute('modKurel', 'modKurel')
        ->addGetRoute('GetSommeTabis/(.*)', 'GetSommeTabis')
        ->addPostRoute('addNdigueul', 'addNdigueul')
        ->addPostRoute('AddSass', 'AddSass')
        ->addPostRoute('UpdateSass', 'UpdateSass')
        ->addPostRoute('AddTabi', 'AddTabi')
        ->addPostRoute('modNdigueul', 'modNdigueul')
        ->addGetRoute('GetLastKurel', 'GetLastKurel')
        ->addGetRoute('GetTotalTabis', 'GetTotalTabis')
        ->addGetRoute('GetSoldeSass/(.*)', 'GetSoldeSass')
        ->addGetRoute('getPercents', 'getPercents')
    ->run();
