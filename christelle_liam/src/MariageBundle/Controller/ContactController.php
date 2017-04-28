<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 15/04/2017
 * Time: 16:09
 */

namespace MariageBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function indexAction()
    {
        return $this->render('MariageBundle:Default:contact-us.html.twig');
    }
}