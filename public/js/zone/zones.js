$(document).on('click', '.addFlowRate', function(){
    
    $.get("/zones/flowRates", 
        function (data){
            $("#flowRates tr:last").after(data);
            
            
    });
    
    return false;
});

$("#flowRates").on("change", ".flowRate", (function(){
    var rate = getRate();
    
    $("#flow").html(rate.toFixed(4));
}));

$(document).on("ready", function(){
    interval = setInterval(function(){
        var rate = getRate();
    
        $("#flow").html(rate.toFixed(4));
    }, 5000);
});

function getRate()
{
    var rate = 0;
    
   $('#flowRates tr').each(function(){
       diam = parseFloat($(this).find(".diameter").val() || 0);
       press = parseFloat($(this).find(".pressure").val() || 0);
       quan = parseFloat($(this).find(".quantity").val() || 0);
       
       rate = rate + (quan * (28.9 * Math.pow(diam, 2) * Math.sqrt(press)));
   });
   
   return rate;
}



$(document).on('click', '.removeTableRow', function(){
    $(this).closest('tr').remove();

    return false;
});

