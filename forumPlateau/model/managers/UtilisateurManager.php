<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use App\Session;

    class UtilisateurManager extends Manager{

        protected $className = "Model\Entities\Utilisateur";
        protected $tableName = "utilisateur";


        public function __construct(){
            parent::connect();
        }

        // Add a user and check the different inputs
        public function checkPseudo($pseudo){
            $sqlPseudo = "SELECT pseudo FROM utilisateur WHERE pseudo = :pseudo";
            return(DAO::select($sqlPseudo,['pseudo' => $pseudo]));
        }

        public function checkEmail($email){
            $sqlEmail = "SELECT email FROM utilisateur WHERE email = :email";
            return(DAO::select($sqlEmail,['email' => $email]));
        }


        public function getMdpByEmail($email){
            $sqlMdp = "SELECT mdp FROM ".$this->tableName." WHERE email = :email";
            return($this->getSingleScalarResult(DAO::select($sqlMdp,['email' => $email])));
        }

        public function getUserByEmail($email){
            $sqlUser = "SELECT * FROM ".$this->tableName." WHERE email = :email";
            return($this->getOneOrNullResult(DAO::select($sqlUser,['email' => $email],false),$this->className));
            // return(DAO::select($sqlUser,['email' => $email],false));
        }
    }