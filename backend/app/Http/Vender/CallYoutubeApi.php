<?php

namespace App\Http\Vender;

use Google_Client;
use Google_Service_YouTube;

class CallYoutubeApi
{
    private $client;

    public function __construct()
    {
        $key = config('services.youtube.api_key');
        $this->client = new Google_Client();
        $this->client->setDeveloperKey($key);
    }
       
    public function searchVideos()
    {
        $youtube = new Google_Service_YouTube($this->client);
        $params['channelId'] = 'UCVrvnobbNGGMsS5n2mJwfOg';
        $params['type'] = 'video';
        $params['maxResults'] = 10;

        $r = $youtube->search->listSearch('snippet', $params);
        $videos = $r['items'];
        $video = $videos[array_rand($videos)];
        return $video;
      }
  }