document.addEventListener("DOMContentLoaded", function() {

	var elements = document.querySelector(".servicelist");
	elements.addEventListener("click", function(e) {

		var itemNode = e.target.className == "servicelist__item__row"
						? e.target.parentNode : e.target.parentNode.parentNode;

		var display = itemNode.querySelector(".servicelist__item__details").style.display;
		itemNode.querySelector(".servicelist__item__details").style.display = display == "block" ? "none" : "block";

	});



});
