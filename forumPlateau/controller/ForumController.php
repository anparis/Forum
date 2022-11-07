<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategorieManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){

           $topicManager = new TopicManager();
        //    var_dump($topicManager->findAll(["datecreation", "DESC"]));
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["datecreation", "DESC"])
                ]
            ];
        }

        public function listCategories(){
            $categorieManager = new CategorieManager();

             return [
                 "view" => VIEW_DIR."forum/listCategories.php",
                 "data" => [
                     "categorie" => $categorieManager->findAll([])
                 ]
             ];
         
         }

         public function addTest(){
            $categorieManager = new CategorieManager();
            var_dump($categorieManager->findOneById(1)); 

            
         }
        

    }
