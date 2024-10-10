/**
 * Opens a modal window in the map page (page-map.php)
 * when the user clicks on the "Open Modal" button.
 */
document.addEventListener("DOMContentLoaded", function () {
	var btn = document.getElementById("map-open-modal");
	var modal = document.getElementById("map-modal");
	var span = document.getElementsByClassName("modal-close")[0];

	if (btn && modal) {
		btn.onclick = function () {
			modal.style.display = "block";
		};
	}

	if (span && modal) {
		span.onclick = function () {
			modal.style.display = "none";
		};
	}

	if (modal) {
		window.onclick = function (event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		};
	}
});
