<?php

namespace Model\Entities;

use App\Entity;

final class Categorie extends Entity
{
    private $id;
    private $nom;

    public function __construct($data){         
        $this->hydrate($data);
    }

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
         * Get the value of Name
         */ 
        public function getNom()
        {
                return $this->nom;
        }

        /**
         * Set the value of Name
         *
         * @return  self
         */ 
        public function setNom($nom)
        {
                $this->nom = $nom;

                return $nom;
        }
    }