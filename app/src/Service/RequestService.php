<?php

namespace App\Service;

use TwitterAPIExchange;

class RequestService
{
    /**
     * @var array
     */
    protected $settings = [
        'oauth_access_token' => "958641715421892608-3flzi5N7LJRYn1bDpQOsSPLxEjacyyO",
        'oauth_access_token_secret' => "FIe5qpqENSsPSPNlY46K57HD8X0vXohWtVOrYo4pqwzzV",
        'consumer_key' => "PyXUjlGRyye1MH6uCrLl0hw3B",
        'consumer_secret' => "1DwCELjLABBoyvXJGDoxFdNsTK2BYLEnI7E3vuzvVDPk4mcWls"
    ];

    /**
     * @var TwitterAPIExchange
     */
    protected $twitterService;

    /**
     * RequestService constructor.
     */
    public function __construct()
    {
        $this->twitterService = new TwitterAPIExchange($this->settings);
    }

    /**
     * @param string $url
     * @param string $getfield
     * @return string
     */
    public function get($url, $getfield)
    {
        return $this->twitterService->setGetfield($getfield)
            ->buildOauth($url, 'GET')
            ->performRequest();
    }

    /**
     * @param string $url
     * @param array $postfields
     * @return string
     */
    public function post($url, $postfields)
    {
        return $this->twitterService->buildOauth($url, 'POST')
            ->setPostfields($postfields)
            ->performRequest();
    }
}