<?php

namespace MariageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MariageBundle:Default:index.html.twig');
    }
}
