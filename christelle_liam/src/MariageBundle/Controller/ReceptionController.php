<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 15/04/2017
 * Time: 11:39
 */

namespace MariageBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ReceptionController extends Controller
{
    public function indexAction()
    {
        return $this->render('MariageBundle:Default:reception.html.twig');
    }
}