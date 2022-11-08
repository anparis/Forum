<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\UtilisateurManager;

    class UtilisateurManager extends Manager{

        protected $className = "Model\Entities\Utilisateur";
        protected $tableName = "utilisateur";


        public function __construct(){
            parent::connect();
        }

        public function addUsers(){
            if(isset($_POST['submitUser'])){
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
                $mdp = $_POST['mdp'];
                $mdp2 = $_POST['mdp2'];
                // need ta add a list of different roles
                $role = "user";
                $sqlEmail = "SELECT email FROM utilisateur WHERE email = :email";
                $sqlPseudo = "SELECT pseudo FROM utilisateur WHERE pseudo = :pseudo";
                
                if($pseudo && $email && $mdp && $mdp2 && ($mdp == $mdp2) && (strlen($mdp)>8)){
                    // select static method return null if dont find
                    $checkPseudo = DAO::select($sqlPseudo,['pseudo' => $pseudo]);
                    $checkEmail = DAO::select($sqlEmail,['email' => $email]);
                    if($checkPseudo==NULL && $checkEmail==NULL){
                        // hash of password
                        $mdpHash = password_hash($mdp,PASSWORD_DEFAULT);
                        // Array preparation to inject data in DB with add function
                        $userData = [
                            "email" => $email,
                            "pseudo" => $pseudo,
                            "mdp" => $mdpHash,
                            "role" => $role
                        ];

                        $this->add($userData);
                        header('Location: index.php?ctrl=home');
                    }
                    else
                        echo "email ou pseudo déjà utilisé";
                }
                else
                    echo "Une erreur est survenu";
                
            }
        }

    }