<?php

namespace App\Services;

use GuzzleHttp\Client;

class Pushall
{
  private $apiKey;
  private $id;

  protected $url = 'https://pushall.ru/api.php';

  public function __construct($apiKey, $id)
  {
    $this->apiKey = $apiKey;
    $this->id = $id;
  }

  public function send($title, $text, $url)
  {
    $data = [
      "type" => "self",
      "id" => $this->id,
      "key" => $this->apiKey,
      "text" => $text,
      "title" => $title,
      "url" => $url
    ];  

      $client = new Client(['base_uri' => $this->url, 'verify'  =>  false]);

      return $client->post('', ['form_params' => $data]);
  }
}