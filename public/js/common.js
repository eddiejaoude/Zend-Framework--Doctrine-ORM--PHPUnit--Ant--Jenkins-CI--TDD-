$(document).ready(function() {
    // form interaction
    $('form.box input').focusin( function() {
        $(this).addClass('active');
    });
    $('form.box input').focusout( function() {
        $(this).removeClass('active');
    });


    
});
