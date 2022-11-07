<?php

    namespace Controller;

    use App\Session;
    use App\DAO;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\AppartenirManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategorieManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){

           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["datecreation", "DESC"]),
                ]
            ];
        }

        public function listCategories(){
            $categorieManager = new CategorieManager();

             return [
                 "view" => VIEW_DIR."forum/listCategories.php",
                 "data" => [
                     "categories" => $categorieManager->findAll(["nom","ASC"])
                 ]
             ];
         
         }

         public function listPosts(){
            $postManager = new PostManager();

            // if the id of topic is set in url
            // -> only display posts related to the topic
            if(isset($_GET['id']))
                $post = $postManager->findPostsById($_GET['id']);
            else 
                $post = $postManager->findAll(["datePost","ASC"]);

             return [
                 "view" => VIEW_DIR."forum/listPosts.php",
                 "data" => [
                     "posts" => $post
                 ]
             ];
         
         }

         //test appartenir
         public function listAppartenir(){
            $appartenirManager = new AppartenirManager();
            $appartenirManager->add([
                "topic_id"=>1,
                "categorie_id"=>3
            ]);
            die;
            
         }

         public function addCategories(){
            $categorieManager = new CategorieManager();
            $categorieManager->addCategories();
            return [
                "view" => VIEW_DIR."forum/addCategories.php",
            ];
         }


    }
