<?php 
namespace App\Interfaces;
Interface StockApiInterface {
 
    public function __construct();
    
    public function getMarketSummary($reigon);

}