jQuery(document).ready(function($) {

    $('.controls#cordero-img-container-header_layout li img').click(function(){
        $('.controls#cordero-img-container-header_layout li').each(function(){
            $(this).find('img').removeClass ('cordero-radio-img-selected') ;
        });
        $(this).addClass ('cordero-radio-img-selected') ;
    });

    $('.controls#cordero-img-container-footer_layout li img').click(function(){
        $('.controls#cordero-img-container-footer_layout li').each(function(){
            $(this).find('img').removeClass ('cordero-radio-img-selected') ;
        });
        $(this).addClass ('cordero-radio-img-selected') ;
    });

});
