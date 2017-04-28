<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 15/04/2017
 * Time: 22:40
 */

namespace MariageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Passager
 * @package MariageBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="passagers", indexes={@ORM\Index(name="mail_idx", columns="mail")})
 */
class Passager
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=150)
     */
    private $mail;
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $tel;
    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlaces;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @return mixed
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @param mixed $nbPlaces
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;
    }

    /**
     * Passager constructor.
     * @param $id
     * @param $nom
     * @param $mail
     * @param $tel
     * @param $nbPlaces
     */
    public function __construct($id, $nom, $mail, $tel, $nbPlaces)
    {
        $this->setId($id);
        $this->setNom($nom);
        $this->setMail($mail);
        $this->setTel($tel);
        $this->setNbPlaces($nbPlaces);
    }

    function __toString()
    {
        return 'id= ' . $this->getId() . ', nom= ' . $this->getNom() . ', mail= ' . $this->getMail() . ', tel= ' . $this->getTel() .
            ', nbPlaces= ' . $this->getNbPlaces();
    }


}
