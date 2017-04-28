<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 15/04/2017
 * Time: 16:03
 */

namespace MariageBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GiftListController extends Controller
{
    public function indexAction()
    {
        return $this->render('MariageBundle:Default:gift-list.html.twig');
    }
}