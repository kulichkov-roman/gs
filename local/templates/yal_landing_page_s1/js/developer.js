"use strict"

var popUpSettings = {
    margin: [10, 10, 10, 10],
    padding: 0,
    wrapCSS: 'my-fancybox',
    titlePosition: 'inside',
    helpers: {
         overlay: {
                locked: false
         },
         title : {
            type : 'inside'
        }
    }
};


$(document).ready(function() {
    var options = {
		success: showSuccessPopup,
	};
	$(".ajax_form").ajaxForm(options);
	
	$(".catalog-form.frm2").each(function(){
		var container = $(this);
		container.find("form").prepend('<input name="form-type" value="' + container.find(".form__header").text() + '" type="hidden">');
	});
	
	
	$('.js__pop-up').fancybox(popUpSettings);



	$(function () {

		$(window).load(function () {
			if($('.js-roistat-email').length>0){
				var email=$('.js-roistat-email').html();
				var input='<input type="hidden" value="'+email+'" name="roistat_mail_client">';
				$('form').append(input);
			}
		});

	});

});

function showSuccessPopup(objResponse, statusText, xhr, $form){
	if(objResponse.element_id){

		$.fancybox($('#success-popup'), popUpSettings);

		//$(".success_block").prepend(document.createTextNode("Спасибо ваша заявка отправлена!"));

		$form.trigger("reset");
		$form.trigger("clear");

		yaCounter40774559.reachGoal('zayavka');
		ga('send', 'event', 'conv', 'zayavka');
		
	} else {
		
	}
}
