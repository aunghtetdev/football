
    let screenHeight = $(window).height();
    let currentsideHeight = $('.sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active').offset().top;
    
    if(currentsideHeight > screenHeight*0.8){
        $('.sidebar').animate({
            scrollTop : currentsideHeight-100
        },1000);
    }

