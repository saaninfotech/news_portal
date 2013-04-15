$(document).ready(function () {
    var buttons = { previous:$('#jslidernews2 .button-previous'),
        next:$('#jslidernews2 .button-next') };
    $('#jslidernews2').lofJSidernews({ interval:5000,
        easing:'easeInOutQuad',
        duration:1200,
        auto:true,
        mainWidth:684,
        mainHeight:300,
        navigatorHeight:100,
        navigatorWidth:200,
        maxItemDisplay:3,
        buttons:buttons });
});

// When the document loads do everything inside here ...
$(document).ready(function () {

    // When a link is clicked
    $("a.tab").click(function () {


        // switch all tabs off
        $(".active").removeClass("active");

        // switch this tab on
        $(this).addClass("active");

        // slide all content up
        $(".content").slideUp();

        // slide this content up
        var content_show = $(this).attr("title");
        $("#" + content_show).slideDown();

    });

    $("a.tabs").click(function () {


        // switch all tabs off
        $(".active_right").removeClass("active_right");

        // switch this tab on
        $(this).addClass("active_right");

        // slide all content up
        $(".content_right").slideUp();

        // slide this content up
        var content_show = $(this).attr("title");
        $("#" + content_show).slideDown();

    });

});
// JavaScript Document