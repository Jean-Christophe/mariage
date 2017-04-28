<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 15/04/2017
 * Time: 22:55
 */

namespace MariageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Trajet
 * @package MariageBundle\Entity
 * @ORM\Entity(repositoryClass="MariageBundle\Repository\TrajetRepository")
 * @ORM\Table(name="trajets")
 */
class Trajet
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
    private $villeOrigine;
    /**
     * @ORM\Column(type="string", length=150)
     */
    private $dateDepart;
    /**
     * @ORM\Column(type="boolean")
     */
    private $estAller;
    /**
     * @ORM\ManyToOne(targetEntity="Voiture")
     */
    private $voiture;
    /**
     * @ORM\ManyToOne(targetEntity="Passager")
     */
    private $passager;

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
    public function getVilleOrigine()
    {
        return $this->villeOrigine;
    }

    /**
     * @return mixed
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * @return mixed
     */
    public function getEstAller()
    {
        return $this->estAller;
    }

    /**
     * @return mixed
     */
    public function getVoiture()
    {
        return $this->voiture;
    }

    /**
     * @return mixed
     */
    public function getPassager()
    {
        return $this->passager;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $villeOrigine
     */
    public function setVilleOrigine($villeOrigine)
    {
        $this->villeOrigine = $villeOrigine;
    }

    /**
     * @param mixed $dateDepart
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;
    }

    /**
     * @param mixed $estAller
     */
    public function setEstAller($estAller)
    {
        $this->estAller = $estAller;
    }

    /**
     * @param mixed $voiture
     */
    public function setVoiture($voiture)
    {
        $this->voiture = $voiture;
    }

    /**
     * @param mixed $passager
     */
    public function setPassager($passager)
    {
        $this->passager = $passager;
    }

    /**
     * Trajet constructor.
     * @param $id
     * @param $villeOrigine
     * @param $dateDepart
     * @param $estAller
     * @param $voiture
     * @param $passager
     */

    public function __construct($id, $villeOrigine, $dateDepart,  $estAller, $voiture, $passager)
    {
        $this->setId($id);
        $this->setVilleOrigine($villeOrigine);
        $this->setDateDepart($dateDepart);
        $this->setEstAller($estAller);
        $this->setVoiture($voiture);
        $this->setPassager($passager);
    }

    function __toString()
    {
        return 'id= ' . $this->getId() . ', villeOrigine= ' . $this->getVilleOrigine() . ', dateDepart= ' . $this->getDateDepart() .
            'estAller= ' . $this->getEstAller() . ', voiture= ' . $this->getVoiture() . ', passager= ' . $this->getPassager();
    }


}
