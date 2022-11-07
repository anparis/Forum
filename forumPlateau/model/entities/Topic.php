<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $titre;
        private $dateCreation;
        private $statut;
        private $utilisateur;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->titre;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitre($title)
        {
                $this->titre = $title;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getUtilisateur()
        {
                return $this->utilisateur;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUtilisateur($user)
        {
                $this->utilisateur = $user;

                return $this;
        }

        public function getDateCreation(){
            $formattedDate = $this->dateCreation->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setDateCreation($date){
            $this->dateCreation = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of statut
         */ 
        public function getStatut()
        {
                return $this->statut;
        }

        /**
         * Set the value of statut
         *
         * @return  self
         */ 
        public function setStatut($statut)
        {
                $this->statut = $statut;

                return $this;
        }
    }
