<?php
/**
 * Created by IntelliJ IDEA.
 * User: pau
 * Date: 31/01/18
 * Time: 11:23
 */

namespace App\Service;


use GuzzleHttp\Client;
use Symfony\Component\Validator\Constraints\DateTime;
use TwitterAPIExchange;

class RequestService
{

    /**
     * RequestService constructor.
     */
    public function __construct()
    {


    }

    public function get($url, $getfield)
    {

        $settings = array(
            'oauth_access_token' => "958641715421892608-3flzi5N7LJRYn1bDpQOsSPLxEjacyyO",
            'oauth_access_token_secret' => "FIe5qpqENSsPSPNlY46K57HD8X0vXohWtVOrYo4pqwzzV",
            'consumer_key' => "PyXUjlGRyye1MH6uCrLl0hw3B",
            'consumer_secret' => "1DwCELjLABBoyvXJGDoxFdNsTK2BYLEnI7E3vuzvVDPk4mcWls"
        );


        $twitter = new TwitterAPIExchange($settings);

        $response = $twitter->setGetfield($getfield)
            ->buildOauth($url, 'GET')
            ->performRequest();

        return $response;
    }

    public function post($url, $postfields)
    {

        $settings = array(
            'oauth_access_token' => "958641715421892608-3flzi5N7LJRYn1bDpQOsSPLxEjacyyO",
            'oauth_access_token_secret' => "FIe5qpqENSsPSPNlY46K57HD8X0vXohWtVOrYo4pqwzzV",
            'consumer_key' => "PyXUjlGRyye1MH6uCrLl0hw3B",
            'consumer_secret' => "1DwCELjLABBoyvXJGDoxFdNsTK2BYLEnI7E3vuzvVDPk4mcWls"
        );


        $twitter = new TwitterAPIExchange($settings);
        $response =  $twitter->buildOauth($url, 'POST')
            ->setPostfields($postfields)
            ->performRequest();

        return $response;

    }
}