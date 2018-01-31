<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Home controller. returns a view that says hello
 *
 * @Route("/")
 */
class HomeController extends Controller
{
    /**
     * Returns the information of a given group
     *
     * @Route("", name="home")
     * @Method("GET")
     */
    public function getAction()
    {

        return new Response(
            '<html><body>hello wold</body></html>'
        );
    }
}
