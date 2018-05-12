function orderButtonSelected(self) {
	var oid = $(self).data("id");
	var oaction = "addUpdate";
	$.ajax({
		type: "post",	
		url: "php/Order.php",
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
		url: "php/Order.php",
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

function checkOutOrder() {
	var oaction = "checkOut";
	$.ajax({
		type: "post",
		url: "php/Order.php",
		data: {
			action:oaction
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
        url: 'php/Order.php',
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
    $('#orderBox').load('php/Order.php',function () {
         $(this).unwrap();
    });
}

loadlink(); // This will run on page load
setInterval(function(){
    loadlink() // this will run after every 5 seconds
}, 1000);
