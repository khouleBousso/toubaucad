<?php
	class BDManager{
		private $bdd;
		
		public function __construct(){
			$this->bdd = new PDO('mysql:host=localhost;dbname=gesttoubaucad', 'root', 'khoule86', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' ));

		}
		
		public function executeList($req){
			$reponse = $this->bdd->query($req);
			$data= [];
			while ($donnees = $reponse->fetch())
			{
				$data[] = $donnees;
			}	
			return $data;
		}
		
		
		public function executeUpdate($req){
			$reponse = $this->bdd->query($req);
			return $reponse;
		}
		
		
		public function getPdo(){
                    return $this->bdd;
                }
		
	}

