<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 15/04/2017
 * Time: 16:07
 */

namespace MariageBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TravelController extends Controller
{
    public function indexAction()
    {
        return $this->render('MariageBundle:Default:travel.html.twig');
    }
}