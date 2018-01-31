<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CyberNumbersController extends Controller
{
    /**
     * @Route("/cybernumbers", name="cybernumbers")
     */
    public function index()
    {

        $numbers = range(1, 1000);

        for ($i = 0; $i < 1000; $i++) {
            if ($numbers[$i] % 3 == 0) $numbers[$i] = "CyberClick";
        }


        return $this->render('cybernumbers.html.twig',array('numbers' => $numbers));
    }
}
