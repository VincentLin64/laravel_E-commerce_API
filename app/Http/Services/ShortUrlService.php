<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class ShortUrlService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function makeShortUrl($url)
    {
        // try 外的錯誤
//        $oContents['a']['123'];
        try {
            $accessToken = env('SHORT_URL_ACCESS_TOKEN');
            $data = ['url' => $url];

            $vResponse = $this->client->request(
                'POST',
                "https://api.pics.ee/v1/links/?access_token=$accessToken",
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode($data)
                ]
            );
            $oContents = json_decode($vResponse->getBody()->getContents());
            // try 內的錯誤
//            $oContents['a']['123'];
        } catch (\Throwable $th) {
            report($th);
            return $url;
        }
        return $oContents->data->picseeUrl;
    }
}
