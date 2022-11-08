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
            $sql = "SELECT * FROM ".$this->tableName." t INNER JOIN appartenir a ON t.id_topic = a.topic_id 
            WHERE a.categorie_id = :id";
            return $this->getMultipleResults(
                // calling DAO class and her select static method 
                // take id to prepare it and execute it
                DAO::select($sql, ['id'=>$id]),
                $this->className
            );
        }

        public function addTopics(){
            if(isset($_POST['submitTopic'])){
                $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $this->add(["nom"=>$nom]);
                header('Location: index.php?ctrl=forum&action=listCategories');
            }
        }
    }