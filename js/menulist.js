function deleteMenu(id) {

	$("#menu-id-for-deletion").val(id);

}

$(document).ready(function() {
	$("#menu-table").DataTable({
    	"bLengthChange": false,
        "info":     false
	});
	$('.dataTables_filter').parent().siblings().remove();
	$('.dataTables_filter').parent().removeClass("col-sm-12 col-md-6");
	$('.dataTables_filter').parent().addClass("col-3");
});