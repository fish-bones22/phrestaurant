
function deleteCategory(id) {

	$("#category-id-for-deletion").val(id);

}

function showNewCategory() {

	$(".new-category").removeAttr("hidden");

}

function hideNewCategory() {

	$(".new-category").attr("hidden", "");

}