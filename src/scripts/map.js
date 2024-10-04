const zoomInBtn = document.getElementById("btn-zoom-in");
const zoomOutBtn = document.getElementById("btn-zoom-out");
const svgMapBox = document.getElementById("map-box");

/**
 * Returns the x and y coordinates of the center of the svg element
 *
 * @returns {Object} - object containing x and y coordinates
 */
function getCoords() {
	let rect = svgMapBox.getBBox();

	return {
		x: rect.x + rect.width / 2,
		y: rect.y + rect.height / 2,
	};
}

/**
 * Setup the panzoom instance and add event listeners to the zoom in and zoom
 * out buttons
 *
 * @returns {void}
 */
function setup() {
	const instance = panzoom(svgMapBox, {
		maxZoom: 3,
		minZoom: 0.7,
		initialX: 100,
		initialY: 50,
		initialZoom: 1,
		bounds: true,
		boundsPadding: 0.1,
	});

	// This event will be called along with events above.
	instance.on("transform", function (e) {
		console.log("logging latest panzoom instance", instance.getTransform());
	});

	// increase scale of map when zoom in button is clicked
	zoomInBtn.addEventListener("click", function () {
		const { x, y } = getCoords(svgMapBox);
		instance.zoomTo(x, y, 1.5);
	});

	// decrease scale of map when zoom out button is clicked
	zoomOutBtn.addEventListener("click", function () {
		const { x, y } = getCoords(svgMapBox);
		instance.zoomTo(x, y, 0.2);
	});
}

document.addEventListener("DOMContentLoaded", setup);
