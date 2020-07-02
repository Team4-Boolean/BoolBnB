var header = $('.header');

$(window).scroll(function(e){
    if(header.offset().top !== 0){
        if(!header.hasClass('shadow')){
            header.addClass('shadow');
        }
    }else{
        header.removeClass('shadow');
    }
});

$('#address-btn-index').keypress(function(event){
    if (event.keyCode == 13) {
        $('.searchs').submit();
    };
});
