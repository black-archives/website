const map = document.getElementById("map-main");
const svgMapBox = document.getElementById("map-box");
const zoomInBtn = document.getElementById("btn-zoom-in");
const zoomOutBtn = document.getElementById("btn-zoom-out");

let selectedCardElement = null;

/**
 * Create a card element and append it to the top-left corner of the map
 *
 * @param {string} id - the id of the card
 * @param {string} title - the title of the card
 * @param {string} body - the body of the card
 *
 * @returns {void}
 */
function setCard(id, title, body) {
	// remove the card if it already exists
	if (selectedCardElement && Number(selectedCardElement.id) === id) {
		console.log(`Removing ${id} card...`);
		selectedCardElement.remove();
		selectedCardElement = null;
		return;
	} else {
		console.log(`Creating ${id} card...`);
		const card = document.createElement("div");
		card.classList.add(
			"map-card",
			"tw-flex-col",
			"tw-absolute",
			"tw-top-5",
			"tw-left-5",
			"tw-min-w-72",
			"tw-min-h-60",
			"tw-p-4",
			"tw-bg-slate-100",
			"tw-rounded-lg",
			"tw-border-2",
			"tw-border-slate-800"
		);
		card.id = id;

		const closeButton = document.createElement("button");
		closeButton.textContent = "X";
		closeButton.classList.add("tw-mx-2");
		closeButton.addEventListener("click", function () {
			card.remove();
		});

		const cardTitle = document.createElement("h3");
		cardTitle.textContent = `${id}. ${title}`;

		const cardHead = document.createElement("div");
		cardHead.classList.add("tw-flex", "tw-justify-between", "tw-items-start");
		cardHead.appendChild(cardTitle);
		cardHead.appendChild(closeButton);

		const cardBody = document.createElement("p");
		cardBody.textContent = body;

		card.appendChild(cardHead);
		card.appendChild(cardBody);

		map.appendChild(card);
		selectedCardElement = card;
	}
}

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
function setupPanzoom() {
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

document.addEventListener("DOMContentLoaded", setupPanzoom);
