<?php

namespace App\Controller;

use App\Service\TwitterService;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TwitterScrapperController extends Controller
{
    /**
     * @var TwitterService
     */
    protected $requestService;

    /**
     * @var array
     */
    protected $peopleInTwitter = [];

    /**
     * @var array
     */
    protected $peopleToFollow = [];

    /**
     * TwitterScrapperController constructor.
     * @param $requestService
     */
    public function __construct(TwitterService $requestService)
    {
        $this->requestService = $requestService;
    }

    /**
     * @Route("/twitterscrapper", name="twitter_scrapper")
     */
    public function index(Request $request)
    {
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
                if (in_array($userId, $this->peopleInTwitter) && !in_array($userId, $this->peopleToFollow)) {
                    $this->peopleToFollow[] = $userId;
                    continue;
                }

                $this->peopleInTwitter[] = $userId;
            }
        }

        foreach ($this->peopleToFollow as $userId) {
            $this->requestService->post(
                'https://api.twitter.com/1.1/friendships/create.json',
                ['user_id' => $userId, 'skip_status' => '1']
            );
        }

        return $this->render('peopleToFollowOnTwitter.html.twig', ['people' => $this->peopleToFollow]);
    }

//    /**
//     * @Route("/twitterscrapper", name="twitter_scrapper")
//     */
//    public function index(Request $request)
//    {
//        $names = $request->query->get('names');
//
//        $names = explode(',', $names);
//
//        if (count($names) > 2) {
//            return $this->render('peopleToFollowOnTwitter-error.html.twig');
//        }
//
//        foreach ($names as $name) {
//            $response = $this->requestService->get(
//                'https://api.twitter.com/1.1/followers/ids.json',
//                '?screen_name=' . $name
//            );
//            $response = json_decode($response);
//
//            $this->peopleInTwitter[$name] = $response->ids;
//        }
//
//        // Match
//
//        foreach ($this->peopleToFollow as $userId) {
//            $this->requestService->post(
//                'https://api.twitter.com/1.1/friendships/create.json',
//                ['user_id' => $userId]
//            );
//        }
//
//        return $this->render('peopleToFollowOnTwitter.html.twig', ['people' => $this->peopleToFollow]);
//    }
}
