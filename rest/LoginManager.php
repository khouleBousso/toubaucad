<?php

include 'vendor/autoload.php';
require_once("Db/BDManager.php");
// require_once("entities/ClassEleve.php");
header("Access-Control-Allow-Origin: *");

class LoginManager extends BDManager {


    public function getAllUsers() {
        $reponse = $this->executeList("SELECT  utilisateur.*, profil.code_profil as profil, profil.id as id_profil FROM  utilisateur,profil where profil.id=utilisateur.profile_id and  profil.code_profil != 'thiantacone'");
        return $reponse;
    }
    
    public function UserByKurel($kurelId){
          $reponse = $this->executeList("SELECT  utilisateur.*, profil.code_profil as profil, profil.id as id_profil FROM  utilisateur,profil where profil.id=utilisateur.profile_id and profil.code_profil != 'thiantacone'");
        return $reponse;
    }
    
    
    public function getUsers() {
        $reponse = $this->executeList("SELECT  * FROM  utilisateur limit 6");
        return $reponse;
    }

    public function getUserById($userId) {
        $reponse = $this->executeList("SELECT utilisateur.*, profil.code_profil, profil.id as id_profil FROM  utilisateur,profil where profil.id=utilisateur.profile_id and "
                . "utilisateur.id= '$userId'");


        return $reponse;
    }

    public function postLogin($login, $password) {
        $reponse = $this->executeList("SELECT u.*,p.id as id_profil,k.id as id_kurel, ik.id_kurel as id_kurel_member , p.code_profil FROM utilisateur u  left outer join  profil p on p.id =  u.profile_id 
                                        left outer join  kurel k on k.dieuwrigne =  u.id   left outer join  inscrit_kurel ik on ik.id_utilisateur =  u.id where 
                                         u.login='$login' and u.password='$password' ");
        return $reponse;
    }

    public function updateUser($id) {
        $this->executeUpdate("Update utilisateur set status='ON' where id='$id'");
    }

    public function updateUserDeconnect($id) {
        $this->executeUpdate("Update utilisateur set status='OFF' where id='$id'");
    }


    public function getProfilsDieuwrignes() {
        $reponse = $this->executeList("SELECT * FROM profil where profil.code_profil != 'thiantacone' and
             profil.code_profil != 'top_dieuwrigne'");
        return $reponse;
    }

    public function addUser() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $nomAvatar = "";
        
        if (isset($request->name)) {
            $nomAvatar = $request->name;
        }
        $nom = $request->nom;
        $prenom = $request->prenom;
        $email = $request->email;
        $adresse = $request->adresse;
        $statut = $request->statut;
        $profession = $request->profession;
        $telephone = $request->telephone;
        $civilite = $request->civilite;
        $profil = $request->id_profil;
        $login = $request->login;

        $this->executeUpdate("Insert into utilisateur (nom, prenom,email,adresse,telephone,statut,profession,profile_id,password,avatar,login,civilite) values ( '$nom', '$prenom', '$email', '$adresse', '$telephone', '$statut','$profession','$profil','ucad','$nomAvatar','$login','$civilite')");
    }
    

    public function modUser() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id = $request->id;
        $nomAvatar = "";
        if (isset($request->name)) {
            $nomAvatar = $request->name;
        }
        $nom = $request->nom;
        $prenom = $request->prenom;
        $email = $request->email;
        $adresse = $request->adresse;
        $telephone = $request->telephone;
        $statut = $request->statut;
        $profession = $request->profession;
        $login = $request->login;
        $profil = $request->id_profil;

        $this->executeUpdate("Update utilisateur set nom='$nom', prenom='$prenom', email='$email',adresse='$adresse',telephone='$telephone',statut='$statut',profession='$profession',profile_id='$profil',avatar ='$nomAvatar',login='$login' where id='$id'");
    }
	
	public function changePasswordUser($password,$id) {
        $this->executeUpdate("Update utilisateur set password='$password' where id='$id'");
    }

    
      public function addUserKurel() {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $nomAvatar = "";
        $civilite = $request->civilite;
        if (isset($request->name)) {
            $nomAvatar = $request->name;
        }
        $nom = $request->nom;
        $prenom = $request->prenom;
        $email = $request->email;
        $adresse = $request->adresse;
        $statut = $request->statut;
          $profession = $request->profession;
          $telephone = $request->telephone;
        $id_kurel = $request->id_kurel;

        $this->executeUpdate("Insert into utilisateur (nom, prenom,email,adresse,telephone,statut,profession,password,profile_id,avatar,login,civilite)"
                . " values ( '$nom', '$prenom', '$email', '$adresse', '$telephone', '$statut','$profession','ucad',6,'$nomAvatar','$telephone','$civilite')");
        $id_utilisateur = $this->GetLastUser()[0]['id_utilisateur'];
        $this->executeUpdate("Insert into inscrit_kurel (id_kurel, id_utilisateur) values ( '$id_kurel', '$id_utilisateur')");
        
        }
    
        
	
	
   public function getDieuwrignekurelsAdd() {
      $reponse = $this->executeList("SELECT  utilisateur.*, profil.code_profil as profil, profil.id as id_profil FROM  utilisateur,profil where "
              . "profil.id=utilisateur.profile_id and  profil.code_profil != 'thiantacone'and utilisateur.id not in (select dieuwrigne from kurel)");
      return $reponse;
    }
    
    public function getDieuwrignekurelsMod() {
      $reponse = $this->executeList("SELECT  utilisateur.*, profil.code_profil as profil, profil.id as id_profil FROM  utilisateur,profil where "
              . "profil.id=utilisateur.profile_id and profil.code_profil != 'thiantacone' and utilisateur.id");
      return $reponse;
    }
    
    public function GetLastUser() {
        $reponse = $this->executeList("SELECT max(id) as id_utilisateur FROM utilisateur");
        return $reponse;
    }

}

use RestService\Server;

Server::create('/', new LoginManager)
        ->addPostRoute('addUser', 'addUser')
        ->addPostRoute('modUser', 'modUser')
        ->addPostRoute('addUserKurel', 'addUserKurel')
        ->addGetRoute('updateUser/(.*)', 'updateUser')
        ->addGetRoute('GetLastUser', 'GetLastUser')
	->addGetRoute('changePasswordUser', 'changePasswordUser')
        ->addGetRoute('updateUserDeconnect/(.*)', 'updateUserDeconnect')
	->addGetRoute('getAllUsers', 'getAllUsers')
        ->addGetRoute('getUsers', 'getUsers')
        ->addGetRoute('getUserById/(.*)', 'getUserById')
        ->addGetRoute('getDieuwrignekurelsAdd', 'getDieuwrignekurelsAdd')
        ->addGetRoute('getDieuwrignekurelsMod', 'getDieuwrignekurelsMod')
        ->addGetRoute('login', 'postLogin')
        ->addGetRoute('getProfilsDieuwrignes', 'getProfilsDieuwrignes')
        ->run();
