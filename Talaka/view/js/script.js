$(main);

function main() {
    //    $(document).on('click', 'a[href="#howItWorks"', function (event) {
    //        event.preventDefault();
    //
    //        $('html, body').animate({
    //            scrollTop: $($.attr(this, 'href')).offset().top
    //        }, 1000);
    //    });
    
    $("#contrast").click(function () {
        $("body").css({
            "background-color": "#000",
            "color": "#fff"
        });
    });

    $("#doRegister").click(function () {
        $("#bgtypeRegister").fadeIn();
        $("#bgtypeRegister").css("display", "flex");
        $("#bgtypeRegister:not(#typeRegister)").click(function () {
            $(this).fadeOut();
        });
    });

    $(".faq").click(function () {
        $(".inputQuestion").slideToggle('medium', function () {
            if ($(this).is(':visible')) {
                $(this).css('display', 'inline-block');
            }
        });
    });
}
