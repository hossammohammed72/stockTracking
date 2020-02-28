<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\YahooFinanceApi;
class ApiController extends Controller
{
    //
    public function __construct(YahooFinanceApi $api)
    {
        $this->stockService = $api;
    }
    public function getMarketSummary()
    {
        # code...
        return response()->json($this->stockService->getMarketSummary('US'),200);
    }
    public function getHistoricalData($symbol,$to,$from)
    {
        $historicalData = $this->stockService->getHistoricalData('US',$from,$to,$symbol);
        $stockSummary = $this->stockService->getStockSummary($symbol);
        return response()->json(['stockSummary'=>$stockSummary,'historicalData'=>$historicalData],200);
    }
    public function autocomplete()
    {
        $query = request()['query'];
        return response()->json($this->stockService->autocomplete('US',$query),200);
    }
}
