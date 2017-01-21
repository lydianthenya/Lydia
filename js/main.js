jQuery(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
$(window).load(function(){
    setTimeout(function(){ $('.alert').fadeOut() }, 30000);
});
$(".dropdown dt a").on('click', function () {
    $(".dropdown dd ul").slideToggle('fast');
});
