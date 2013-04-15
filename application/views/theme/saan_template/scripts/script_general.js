// JavaScript Document
function init_app() {
    $('#tabtext2').hide();
    $('#tabtext1').show();
    $('#header1').removeClass().addClass('tab_current');
    $('#header2').removeClass().addClass('tab_header');
}
$(document).ready(function () {
    init_app();
    $('#header1').click(function () {
        $('#tabtext1').show();
        $('#tabtext2').hide();
        $('#header1').removeClass().addClass('tab_current');
        $('#header2').removeClass().addClass('tab_header');
    });

    $('#header2').click(function () {
        $('#tabtext2').show();
        $('#tabtext1').hide();
        $('#header2').removeClass().addClass('tab_current');
        $('#header1').removeClass().addClass('tab_header');
    });
})