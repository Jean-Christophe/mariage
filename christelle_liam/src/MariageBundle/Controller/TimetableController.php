<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 15/04/2017
 * Time: 11:40
 */

namespace MariageBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimetableController extends Controller
{
    public function indexAction()
    {
        return $this->render('MariageBundle:Default:timetable.html.twig');
    }

}