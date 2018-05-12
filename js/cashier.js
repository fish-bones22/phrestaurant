function orderButtonSelected(self) {
	var oid = $(self).data("id");
	var oaction = "addUpdate";
	$.ajax({
		type: "post",	
		url: "php/functions/order.php",
		data: {
			id:oid, 
			action:oaction
		},
		datatype: "json",
		success: function(data){
			console.log(data);
		}
	});
}

function deleteItem(self) {
	var oid = $(self).data("id");
	var oaction = "deleteItem";
	$.ajax({
		type: "post",
		url: "php/functions/order.php",
		data: {
			id:oid,
			action:oaction
		},
		datatype: "json",
		success: function(data){
			console.log(data);
		}
	});
}

// function checkOutOrder() {
// 	var oaction = "checkOut";
// 	$.ajax({
// 		type: "post",
// 		url: "php/Order.php",
// 		data: {
// 			action:oaction
// 		},
// 		datatype: "json",
// 		success: function(data){
// 			console.log(data);
// 		}
// 	});
// }

function checkOutLogin() {
	var oaction = "checkOutLogin";
	var username = $("#checkUsername").val();
	var password = $("#checkPassword").val();
	$.ajax({
		type: "post",
		url: "php/functions/order.php",
		data: {
			action:oaction,
			user:username,
			pass:password
		},
		datatype: "json",
		success: function(data){
			console.log(data);
		}
	});
}

function showOrderlist() {
	var oaction = "showOrder";
    $.ajax({
		type: "post",
		url: "php/functions/order.php",
        data: {
			action:oaction
		},
		datatype: "json",
        success: function(html) {
            var ajaxDisplay = document.getElementById(orderBox);
            ajaxDisplay.innerHTML = html;
        }
    });
}

function loadlink(){
    $('#orderBox').load('php/functions/order.php',function () {
         $(this).unwrap();
    });
}

loadlink(); // This will run on page load
setInterval(function(){
    loadlink() // this will run after every .5 seconds
}, 500);
