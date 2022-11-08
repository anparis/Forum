<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        public function findTopicsById($id){
            $sql = "SELECT * FROM ".$this->tableName." t WHERE t.categorie_id = :id";
            return $this->getMultipleResults(
                // calling DAO class and her select static method 
                // take id to prepare it and execute it
                DAO::select($sql, ['id'=>$id]),
                $this->className
            );
        }

        public function addTopics(){
            if(isset($_POST['submitTopic'])){
                //need to add list of categories to choose from in addTopics
                $idCategorie = 3;
                $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $statut = filter_input(INPUT_POST, "statut", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $idUser = 1;

                if($idCategorie && $text && $titre && $statut && $idUser){
                    // Array preparation to inject data in DB with add function
                    $topicData = [
                        "titre" => $titre,
                        "statut" => (int) $statut,
                        "categorie_id" => $idCategorie,
                        "utilisateur_id" => $idUser
                    ];
                    $lastTopicInsert = $this->add($topicData);

                    $postManager = new PostManager;
                    $postData = [
                        "text" => $text,
                        "topic_id" =>  $lastTopicInsert,
                        "utilisateur_id" => $idUser
                    ];
                    $postManager->add($postData);
                    header('Location: index.php?ctrl=forum&action=listTopics');
                }
                
            }
        }
    }