<?php

namespace App\Controller;

use App\Service\RequestService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

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

        $peopleInTwitter = [];

        $peopleToFollow = [];

        $names = $request->query->get('names');

        $names = explode(',', $names);

        if (count($names) < 2) throw new Exception("You must give at least 2 twitter users");

        foreach ($names as $name) {
            $friendsList = $this->requestService->get(
                'https://api.twitter.com/1.1/followers/ids.json',
                '?stringify_id=true&screen_name=' . $name
            );
            $followersIds = json_decode($friendsList);

            foreach ($followersIds as $userId) {
                if ($userId != '0' && in_array($userId, $peopleInTwitter)) {
                    array_push($peopleToFollow, $userId);
                } else {
                    array_push($peopleInTwitter, $userId);
                }
            }
        }

        foreach ($peopleToFollow as $person) {
            $this->requestService->post(
                'https://api.twitter.com/1.1/friendships/create.json',
                ['user_id' =>  $person]

            );
        }

        return $this->render('peopleToFollowOnTwitter.html.twig', array('people' => $peopleToFollow));

    }
}
