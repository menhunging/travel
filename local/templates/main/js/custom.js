$(document).ready(function () {
	$(document).on("click", ".more-block-btn",  function (e) {
	    e.preventDefault();
		
		$(this).siblings('.more-block').show();
		
		$(this).hide();
	});
	
	$(document).on("click", ".more-team-btn",  function (e) {
	    e.preventDefault();
		
		$(".teams-new__item").show();
		
		$(this).hide();
	});
});