
function deleteCategory(id) {

	$("#category-id-for-deletion").val(id);

}

function showNewCategory() {

	$(".new-category").removeAttr("hidden");

}

function hideNewCategory() {

	$(".new-category").attr("hidden", "");

}

$(document).ready(function() {
	$("#category-table").DataTable({
    	"bLengthChange": false,
        "info":     false,
        "ordering": false,
        "paging": false
	});
	$('.dataTables_filter').parent().siblings().remove();
	$('.dataTables_filter').parent().removeClass("col-sm-12 col-md-6");
	$('.dataTables_filter').parent().addClass("col-3");
});