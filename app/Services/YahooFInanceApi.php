<?php

namespace App\Services;

use  \GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

use App\Interfaces\StockApiInterface;


class YahooFinanceApi  implements StockApiInterface
{

    private $client;

    public function __construct()
    {
        $this->client = new Client(
            [
                'base_uri' => 'https://apidojo-yahoo-finance-v1.p.rapidapi.com',
                'headers' => [
                    'x-rapidapi-host' => 'apidojo-yahoo-finance-v1.p.rapidapi.com',
                    'x-rapidapi-key' => env('YAHOO_FINANCE_KEY')
                ]
            ]
        );
    }
    /**
     * 
     */
    public function getMarketSummary($reigon)
    {

        $response = $this->client->request('GET','market/get-summary',
        ['query'=>['reigon'=>$reigon,'lang'=>'en']]);
        $body = json_decode((string)$response->getBody());
        return $body;

    }
    public function getHistoricalData(string $reigon,$from,$to,string $symbol)
    {

        $response = $this->client->request('GET','stock/get-histories',
        ['query'=>[
            'region'=>$reigon,
            'lang'=>'en',
            'from'=>$from,
            'to'=>$to,
            'events'=>'div',
            'interval'=>$this->SelectSuitablePeriod($to,$from),
            'symbol'=>$symbol
            ]]);
           
            $body = json_decode((string)$response->getBody());
            return $body;

    }
    private function SelectSuitablePeriod($to,$from){
        $dayInSeconds = 3600*24;
        $duration = $to-$from; 
        if($duration/$dayInSeconds >= 365*3){ // duration greater than 3 years
            return '60d';
        }else if ($duration/$dayInSeconds >= 365){
            return '30d';
        }elseif($duration/$dayInSeconds >= 31*6){
            return '10d';
        }elseif($duration/$dayInSeconds >= 31*3){
            return '5d';
        }else{
            return '1d';
        }
    }

    public function getStockSummary($symbol){
        $response = $this->client->request('GET','stock/v2/get-summary',
        ['query'=>[
            'symbol'=>$symbol
            ]]);
           
            $body = json_decode((string)$response->getBody());
            return $body;
    }

    public function autocomplete($reigon,String $query)
    {
        $response = $this->client->request('GET','market/auto-complete',
        ['query'=>[
            'region'=>$reigon,
            'lang'=>'en',
            'query'=>$query
            ]]);
           
            $body = json_decode((string)$response->getBody())->ResultSet->Result;

            $values['suggestions'] = array_map(function($value){
                return $value->symbol;
            },$body);
            return $values ;
    }
}
