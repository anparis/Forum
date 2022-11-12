<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\CategorieManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }

        public function findPostsByTopicId($id){
            $sql = "SELECT * FROM ".$this->tableName." WHERE post.topic_id = :id";
            return $this->getMultipleResults(
                // calling DAO class and her select static method 
                // take id to prepare and then execute it
                DAO::select($sql, ['id'=>$id]),
                $this->className
            );
        }

        public function deletePostsByTopicId($id){
            $sql = "DELETE FROM ".$this->tableName." WHERE post.topic_id = :id";
            return DAO::delete($sql, ['id' => $id]);
        }

        public function findPostsByUserId($id){
            $sql = "SELECT * FROM ".$this->tableName." WHERE post.utilisateur_id = :id";
            return $this->getMultipleResults(
                // calling DAO class and her select static method 
                // take id to prepare and then execute it
                DAO::select($sql, ['id'=>$id]),
                $this->className
            );
        }

    }