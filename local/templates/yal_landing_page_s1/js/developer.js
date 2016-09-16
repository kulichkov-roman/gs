$(document).ready(function() {
    var options = {
		success: showSuccessPopup,
	};
	$(".ajax_form").ajaxForm(options);
});

function showSuccessPopup(objResponse, statusText, xhr, $form){

	if(objResponse.element_id){

		$.fancybox($('#success-popup'), popUpSettings);

		$form.trigger("reset");
		$form.trigger("clear");

	} else {
		
	}
}