$(main);

function main() {
//    $(document).on('click', 'a[href="#howItWorks"', function (event) {
//        event.preventDefault();
//
//        $('html, body').animate({
//            scrollTop: $($.attr(this, 'href')).offset().top
//        }, 1000);
//    });
    
    $("#contrast").click(function(){
        $("body").css({"background-color":"#000", "color":"#fff"});
    });
    
    
}


