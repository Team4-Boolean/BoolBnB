// bootstrap-input-inputSpinner
if (document.getElementById("js-cards")) {
	if ($('#js-cards').html() == 0) {
		$('.title-home-index.searchs-s').hide();
	};
}
require('bootstrap-input-spinner');
$("input[type='number']").inputSpinner();
