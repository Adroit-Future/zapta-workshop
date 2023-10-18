<?php
namespace App\Services;
use App\Interfaces\MusicServiceInterface;
class SpotifyService implements MusicServiceInterface
{
  protected $api_key;
  public function __construct($api_key)
  {
    $this->api_key = $api_key;
  }
  public function play()
  {
    dd("Played on Spotify!");
  }
}
