<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 15/04/2017
 * Time: 16:02
 */

namespace MariageBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RsvpController extends Controller
{
    public function indexAction()
    {
        return $this->render('MariageBundle:Default:rsvp.html.twig');
    }
}