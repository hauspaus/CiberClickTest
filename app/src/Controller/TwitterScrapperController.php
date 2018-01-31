<?php

namespace App\Controller;

use App\Service\RequestService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TwitterScrapperController extends Controller
{
    protected $requestService;

    /**
     * TwitterScrapperController constructor.
     * @param $requestService
     */
    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    /**
     * @Route("/twitterscrapper", name="twitter_scrapper")
     */
    public function index(Request $request)
    {
        //      $endpoint = "https://api.twitter.com/1.1/users/show.json?screen_name=PauCyberClick";

        $peopleInTwitter = [];

        $peopleToFollow = [];

        $names = $request->query->get('names');

        $names = explode(',', $names);


        if (count($names) < 2) throw new Exception("You must give at least 2 twitter users");

        foreach ($names as $name) {
            $friendsList = $this->requestService->get(
                'https://api.twitter.com/1.1/followers/list.json',
                'GET',
                'screen_name=' . $name
            );
            $friendsList = json_decode($friendsList);
//            var_dump($friendsList);die();
            $followersIds = array_map(function ($a) {
                return $a->id;
            }, $friendsList->users);

            foreach ($followersIds as $userId) {
                if (in_array($userId, $peopleInTwitter)) {
                    array_push($peopleToFollow, $userId);
                } else {
                    array_push($peopleInTwitter, $userId);
                }
            }
        }

        echo("peopleInTwitter");
        var_dump($peopleInTwitter);
        echo("peopleToFollow");
        var_dump($peopleToFollow);
        die();


        return $this->render('peopleToFollowOnTwitter.html.twig',array('people' => $peopleToFollow));

    }
}
