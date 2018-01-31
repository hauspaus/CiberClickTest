<?php

namespace App\Controller;

use App\Service\RequestService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

        if (count($names) < 2) {
            return $this->render('peopleToFollowOnTwitter-error.html.twig');
        }

        foreach ($names as $name) {
            $response = $this->requestService->get(
                'https://api.twitter.com/1.1/followers/ids.json',
                '?screen_name=' . $name
            );
            $response = json_decode($response);

            foreach ($response->ids as $userId) {
                if (in_array($userId, $peopleInTwitter)) {
                    $peopleToFollow[] = $userId;
                } else {
                    $peopleInTwitter[] = $userId;
                }
            }
        }

        foreach ($peopleToFollow as $userId) {
            $this->requestService->post(
                'https://api.twitter.com/1.1/friendships/create.json',
                ['user_id' => $userId]
            );
        }

//        return $this->json($response);
        return $this->render('peopleToFollowOnTwitter.html.twig', ['people' => $peopleToFollow]);
    }
}
