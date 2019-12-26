$(document).ready(function(){
    $('.js_deploy_btn').click(function(){

        if($(this).hasClass('js_date')){
            let dateResult = $(this).parent().find('.date_height');
            if(dateResult.length){
                dateResult.removeClass('date_height');
                $(this).html('Hide');
            } else{
                $('.default__date-trans').addClass('date_height');
                $(this).html('Expand');
            }
        } else{
            let priceResult = $(this).parent().find('.price_height');
            if(priceResult.length){
                priceResult.removeClass('price_height');
                $(this).html('Hide');
                $(this).removeClass('btn_delpoy_shadow ');
            } else{
                $('.default__price-trans').addClass('price_height');
                $(this).html('Expand');
                $(this).addClass('btn_delpoy_shadow ');
            }
        }
    });

    $('.notes_textarea').keyup(function(){
       $(this).siblings('button').removeClass('d-none');
    });
});