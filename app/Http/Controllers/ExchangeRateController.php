<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ExchangeRateController extends Controller
{
    public function exchangeRate(Request $request){

        $client = new Client();

        $url = 'https://kambista.com/tipo-de-cambio/';

        $response = $client->request('GET', $url);

        $html = (string) $response->getBody();

        $crawler = new Crawler($html);

        $purchaseValue = $crawler->filter('#valcompra')->text();
        $saleValue = $crawler->filter('#valventa')->text();

        $data = [
            'date' =>date("Y/m/d"),
            'purchase' => $purchaseValue,
            'sale' => $saleValue
        ];

        return ['success'=>true, 'data'=>$data];


    }
}
