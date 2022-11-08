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
                // take id to prepare it and execute it
                DAO::select($sql, ['id'=>$id]),
                $this->className
            );
        }

        public function findPostsByUserId($id){
            $sql = "SELECT * FROM ".$this->tableName." WHERE post.utilisateur_id = :id";
            return $this->getMultipleResults(
                // calling DAO class and her select static method 
                // take id to prepare it and execute it
                DAO::select($sql, ['id'=>$id]),
                $this->className
            );
        }

        public function addPosts(){
            if(isset($_POST['submitPost'])){
                //need to add list of categories to choose from in addTopics
                $idTopic = $_GET['id'];
                $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $idUser = 1;

                if($idTopic && $text && $idUser){
                    // Array preparation to inject data in DB with add function
                    $postData = [
                        "text" => $text,
                        "topic_id" => $idTopic,
                        "utilisateur_id" => $idUser
                    ];
                    $this->add($postData);
                    header('Location: index.php?ctrl=forum&action=listPosts&id='.$idTopic);
                }
                
            }
        }
    }