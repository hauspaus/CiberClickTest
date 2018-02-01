<?php

namespace App\Service;

use TwitterAPIExchange;

class TwitterService
{
    /**
     * @var TwitterAPIExchange
     */
    protected $twitterService;

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
     * RequestService constructor.
     */
    public function __construct()
    {
        $this->twitterService = new TwitterAPIExchange($this->settings);
    }

    /**
     * Get request.
     *
     * @param string $url
     * @param string $getField
     * @return string
     */
    public function get($url, $getField)
    {
        return $this->twitterService
            ->buildOauth($url, 'GET')
            ->setGetfield($getField)
            ->performRequest();
    }

    /**
     * Post request.
     *
     * @param string $url
     * @param array $postFields
     * @return string
     */
    public function post($url, $postFields)
    {
        return $this->twitterService->buildOauth($url, 'POST')
            ->setGetfield()
            ->setPostfields($postFields)
            ->performRequest();
    }
}
