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

        public function findTopicsByCatId($id){
            $sql = "SELECT * FROM ".$this->tableName." t WHERE t.categorie_id = :id";
            return $this->getMultipleResults(
                // calling DAO class and her select static method 
                // take id to prepare it and execute it
                DAO::select($sql, ['id'=>$id]),
                $this->className
            );
        }

        public function findTopicsByUserId($id){
            $sql = "SELECT * FROM ".$this->tableName." t WHERE t.utilisateur_id = :id";
            return $this->getMultipleResults(
                // calling DAO class and her select static method 
                // take id to prepare and then execute it
                DAO::select($sql, ['id'=>$id]),
                $this->className
            );
        }
    }