<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 15/04/2017
 * Time: 22:15
 */

namespace MariageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MariageBundle\Utils\ApplicationException;

/**
 * Class Voiture
 * @package MariageBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="voitures", indexes={@ORM\Index(name="mail_idx", columns="mail")})
 */
class Voiture
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
        if(is_integer($id))
        {
            $this->id = $id;
        }
        else{
            throw new ApplicationException("L'id de la voiture doit être un entier");
        }
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        if(strlen($nom) <= 150)
        {
            $this->nom = $nom;
        }
        else{
            throw new ApplicationException("Le nom et le prénom doivent faire moins de 150 caractères.");
        }
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        if(strlen($mail) <= 150)
        {
            $this->mail = $mail;
        }
        else{
            throw new ApplicationException("L'e-mail doit faire moins de 150 caractères.");
        }
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        if(strlen($tel) <= 20 || $tel == null)
        {
            $this->tel = $tel;
        }
        else{
            throw new ApplicationException("Le numéro de téléphone doit faire moins de 20 caractères.");
        }
    }

    /**
     * @param mixed $nbPlaces
     */
    public function setNbPlaces($nbPlaces)
    {
        if(is_integer($nbPlaces) && $nbPlaces < 10)
        {
            $this->nbPlaces = $nbPlaces;
        }
        else{
            throw new ApplicationException("Le nombre de places doit être un entier inférieur à 10.");
        }
    }

    /**
     * Voiture constructor.
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
