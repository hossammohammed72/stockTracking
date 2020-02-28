var date = new Date();
var to =  moment(); 
var from = moment().subtract(6,'months');
var symbol =undefined;
var mode      = 'index';
var intersect = true

var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }
//console.log(from.unix());   
//console.log(from);
setInterval(fetchSummary,1000);
var fetchSummaryAjax = null
var fetchSummary =function(){
    if(fetchSummaryAjax !== null){
      fetchSummaryAjax.abort();
    }
   fetchSummaryAjax =  $.get("/api/marketSummary", function(data, status){
       
        if(status == 'success'){
          //  console.log(data);
            //console.log(data.marketSummaryResponse.result);
            updateIndeciesTable(data.marketSummaryResponse.result);
            
        }else{

            alert('something went wrong'+status);
        }
    });
  };
  var fetchHistoryAjax = null;
var fetchHistory =function(to,from){
   
    if(symbol !== undefined){
      if(fetchHistoryAjax !== null){
        fetchHistoryAjax.abort();
      } 
      fetchHistoryAjax =   $.get("api/historicalData/"+symbol+"/"+to.unix()+"/"+from.unix(), function(data, status){
         
          if(status == 'success'){
                updateChart(data.historicalData);
                var stockSummary  = data.stockSummary;
                console.log(stockSummary);
                if($("tr[data-symbol='"+stockSummary.symbol+"']").length == 0 ){
                  var TableData = $('#StockPricingTable').html();
                var html='';
                html+='<tr tabindex="0" class="symbol-row" data-symbol="'+stockSummary.symbol+'">';
                html+='<td>'+stockSummary.symbol+'</td>';
                html+='<td>'+stockSummary.quoteType.exchange+'</td>';
                html+='<td>'+stockSummary.price.regularMarketPrice.raw+'</td>';
                var className = 'class="text-danger"><i class="fas fa-arrow-down"></i> '
                if(stockSummary.price.regularMarketChange.raw > 0)
                  className = 'class="text-success"><i class="fas fa-arrow-up"></i> ';
                html+='<td '+className+stockSummary.price.regularMarketChange.fmt+' ('+stockSummary.price.regularMarketChangePercent.fmt+')</td>';
                html+='<td class="wishlist-index"><div class="heart-checkBox-cont">\
                <label class="heart-checkBox-label">\
                    <input class="heart-checkBox-input" onclick="addToWishlist(6)" type="checkbox">\
                    <i class="fas fa-heart" aria-hidden="true"></i></label>\
                    </div></td>';
                html+='</tr>';
                TableData = html+TableData;   
                }else{
                  console.log('mawgod');
                }
                $('#StockPricingTable').html(TableData);
                $('#curentSymbol').html(stockSummary.symbol);
                $('#curentPrice').html("Regular Market Price: "+stockSummary.price.regularMarketPrice.raw);
    
            }else{
    
                alert('something went wrong'+status);
            }
        });    
    }
    
};
function updateIndeciesTable(data){
    $response = [];
    var html = '';
    for(var i =0;i< data.length;i++){
        html+='<tr tabindex="0" class="symbol-row" data-symbol="'+data[i].symbol+'">';
        html+='<td>'+data[i].symbol+'</td>';
        html+='<td>'+data[i].fullExchangeName+'</td>';
        html+='<td>'+data[i].regularMarketPreviousClose.fmt+'</td>';
        var className = 'class="text-danger"><i class="fas fa-arrow-down"></i> '
        if(data[i].regularMarketChange.raw > 0)
          className = 'class="text-success"><i class="fas fa-arrow-up"></i> ';
        html+='<td '+className+data[i].regularMarketChange.fmt+' ('+data[i].regularMarketChangePercent.fmt+')</td>';
        html+='<td class="wishlist-index"><div class="heart-checkBox-cont">\
        <label class="heart-checkBox-label">\
            <input class="heart-checkBox-input" onclick="addToWishlist(6)" type="checkbox">\
            <i class="fas fa-heart" aria-hidden="true"></i></label>\
            </div></td>';
        
        html+='</tr>';
    }
    $('#StockPricingTable').html(html);
    symbol = $($('.symbol-row ')[0]).data('symbol');
    fetchHistory(to,from);

}
fetchSummary();
$(document).on('click','.symbol-row',function(){
   symbol = $(this).data('symbol');
    fetchHistory(to,from); 
   // console.log($(this).data('symbol'));
});

$('#radioBtn a').on('click', function(){
    var value = $(this).data('value');
    var id = $(this).data('id');
    var period_unit = $(this).data('unit');
    
    from = moment().subtract(value,period_unit);
    fetchHistory(to,from);
    var tog = $(this).data('toggle');
    $('#'+tog).prop('value', value);
    
    $('a[data-toggle="'+tog+'"]').not('[data-id="'+id+'"]').removeClass('active').addClass('notActive');
    $('a[data-toggle="'+tog+'"][data-id="'+id+'"]').removeClass('notActive').addClass('active');
})
function updateChart(data){
    var $visitorsChart = $('#indexes-chart')
   
    var visitorsChart  = new Chart($visitorsChart, {
        
        data   : {
        labels  : divideLabels(data.chart.result[0].timestamp,8),
        datasets: [{
          type                : 'line',
          data                : data.chart.result[0].indicators.quote[0].high,
          backgroundColor     : 'transparent',
          borderColor         : '#007bff',
          pointBorderColor    : '#007bff',
          pointBackgroundColor: '#007bff',
          fill                : false,
          lineTension         : 0
          // pointHoverBackgroundColor: '#007bff',
          // pointHoverBorderColor    : '#007bff'
        },
        {
        type                : 'line',
        data                : data.chart.result[0].indicators.quote[0].low,
        backgroundColor     : 'tansparent',
        borderColor         : '#ced4da',
        pointBorderColor    : '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill                : false,
        lineTension         : 0
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
        },
        {
        type                : 'line',
        data                : data.chart.result[0].indicators.quote[0].open,
        backgroundColor     : 'tansparent',
        borderColor         : '#14e330',
        pointBorderColor    : '#14e330',
        pointBackgroundColor: '#14e330',
        fill                : false,
        lineTension         : 0
        // pointHoverBackgroundColor: '#14e330',
        // pointHoverBorderColor    : '#14e330'
        },
        {
            type                : 'line',
            data                : data.chart.result[0].indicators.quote[0].close,
            backgroundColor     : 'tansparent',
            borderColor         : '#e3141b',
            pointBorderColor    : '#e3141b',
            pointBackgroundColor: '#e3141b',
            fill                : false,
            lineTension         : 0
            // pointHoverBackgroundColor: '#e3141b',
            // pointHoverBorderColor    : '#e3141b'
        }]
        
      },
      options: {
        maintainAspectRatio: true,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
            // display: false,
            gridLines: {
              display      : true,
              lineWidth    : '4px',
              color        : 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks    : $.extend({
              beginAtZero : false,
              suggestedMax: 200
            }, ticksStyle)
          }],
          xAxes: [{
            display  : true,
            gridLines: {
              display: false
            },
            ticks    : ticksStyle
          }]
        }
      }
    })
    
}

function divideLabels(LablesArray,numItems){
    var chosenItems = [];
    var cnt=0;
    var increment = parseInt(LablesArray.length/numItems) >= 1  ? parseInt(LablesArray.length/numItems) : 1;
    for(var i=0;i<LablesArray.length;i+=increment){
    //    console.log(LablesArray[i],i);
        chosenItems[cnt++]=moment(LablesArray[i]*1000).format('MMM Do'); 
    }
    return chosenItems;
}
$('#autocomplete').autocomplete({
  serviceUrl: 'api/autocomplete',
  onSelect: function (suggestion) {
    symbol = suggestion.value;
     fetchHistory(to,from)
  }
});
  