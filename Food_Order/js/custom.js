/* global $, alert, console */
$(function() {
    'use strict';
    var nameError = true,
        contactEmailError = true,
        textMsgError = true;
    $('.uservalid').blur(function() {
        if($(this).val().length < 4) {
            $(this).parent().find(".usererror").fadeIn(200);
            $(this).parent().find(".astrix").fadeIn(100);
            nameError = true;
        }
        else
        {
            $(this).parent().find(".usererror").fadeOut(200);
            $(this).parent().find(".astrix").fadeOut(100);
            nameError = false;
        }
    });

    $('.emailvalid').blur(function() {
        if($(this).val().length < 1) {
            $(this).parent().find(".emailerror").fadeIn(200);
            $(this).parent().find(".astrix").fadeIn(100);
            contactEmailError = true;
        }
        else
        {
            $(this).parent().find(".emailerror").fadeOut(200);
            $(this).parent().find(".astrix").fadeOut(100);
            contactEmailError = false;
        }
    });

    $('.messagevalid').blur(function() {
        if($(this).val().length < 12) {
            $(this).parent().find(".msgerror").fadeIn(200);
            $(this).parent().find(".astrix").fadeIn(100);
            textMsgError = true;
        }
        else
        {
            $(this).parent().find(".msgerror").fadeOut(200);
            $(this).parent().find(".astrix").fadeOut(100);
            textMsgError = false;
        }
    });

    $(".contact").submit(function(e) {
        if(nameError == true || contactEmailError == true || textMsgError == true) {
            e.preventDefault();
            $(".uservalid, .emailvalid, .messagevalid").blur();
        }
    });
});
