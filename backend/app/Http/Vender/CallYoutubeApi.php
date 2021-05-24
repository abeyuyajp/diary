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
        $r = $youtube->playlistItems->listPlaylistItems('snippet', array(
            "playlistId" => 'PLErc3Oi7icuFSTHt-RtlqW0cC1l5dle1v',
            "maxResults" => 50
        ));
        
        $videos = $r['items'];
        $video = $videos[array_rand($videos)];
        return $video;
      }
  }