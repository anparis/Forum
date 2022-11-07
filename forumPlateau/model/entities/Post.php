<?php

namespace Model\Entities;

use App\Entity;

final class Post extends Entity
{
    private $id;
    private $text;
    private $datePost;
    private $utilisateur;
    private $topic;

    public function __construct($data)
    {
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
     * Get the value of text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDatePost()
    {
        $formattedDate = $this->datePost->format("d/m/Y, H:i:s");
        return $formattedDate;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDatePost($date)
    {
        $this->datePost = new \DateTime($date);
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

    /**
     * Get the value of user
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }
}
