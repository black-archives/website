const map = document.getElementById("map-main"); // entire map container
const mapSvg = document.getElementById("map-svg");
const mapSvgGroup = document.getElementById("map-svg-group");
const zoomInBtn = document.getElementById("btn-zoom-in");
const zoomOutBtn = document.getElementById("btn-zoom-out");

const points = [
	{
		id: 1,
		x: 7746.912109375,
		y: 2287.798583984375,
	},
	{
		id: 2,
		x: 7902.91552734375,
		y: 2220.940185546875,
	},
	{
		id: 3,
		x: 8155.4921875,
		y: 2354.656982421875,
	},
	{
		id: 4,
		x: 7709.7685546875,
		y: 2503.2314453125,
	},
	{
		id: 5,
		x: 7932.63037109375,
		y: 2532.9462890625,
	},
	{
		id: 6,
		x: 7405.19091796875,
		y: 3023.241943359375,
	},
	{
		id: 7,
		x: 7486.9072265625,
		y: 3015.813232421875,
	},
	{
		id: 8,
		x: 7761.76953125,
		y: 4620.4169921875,
	},
	{
		id: 9,
		x: 7858.34326171875,
		y: 4627.845703125,
	},
	{
		id: 10,
		x: 7264.04541015625,
		y: 3216.388671875,
	},
	{
		id: 11,
		x: 7449.763671875,
		y: 4419.841796875,
	},
	{
		id: 12,
		x: 7085.755859375,
		y: 3045.528076171875,
	},
	{
		id: 13,
		x: 7197.18701171875,
		y: 3038.099365234375,
	},
	{
		id: 14,
		x: 310.76214599609375,
		y: 5341.0029296875,
	},
	{
		id: 15,
		x: 7769.1982421875,
		y: 3231.24609375,
	},
	{
		id: 16,
		x: 7925.20166015625,
		y: 4523.84375,
	},
	{
		id: 17,
		x: 7256.61669921875,
		y: 4018.690673828125,
	},
	{
		id: 18,
		x: 7249.18798828125,
		y: 4115.26416015625,
	},
	{
		id: 19,
		x: 4760.56640625,
		y: 5066.14013671875,
	},
	{
		id: 20,
		x: 7940.05908203125,
		y: 3075.242919921875,
	},
	{
		id: 21,
		x: 7249.18798828125,
		y: 4211.83740234375,
	},
	{
		id: 22,
		x: 7732.0546875,
		y: 4085.549072265625,
	},
	{
		id: 23,
		x: 7286.33154296875,
		y: 3104.9580078125,
	},
	{
		id: 24,
		x: 7791.48486328125,
		y: 3535.82373046875,
	},
	{
		id: 25,
		x: 7590.9091796875,
		y: 3877.544921875,
	},
	{
		id: 26,
		x: 7204.61572265625,
		y: 2941.526123046875,
	},
	{
		id: 27,
		x: 8816.6484375,
		y: 2733.521728515625,
	},
	{
		id: 28,
		x: 8898.3642578125,
		y: 2674.092041015625,
	},
	{
		id: 29,
		x: 7576.0517578125,
		y: 4360.41162109375,
	},
	{
		id: 30,
		x: 9024.65234375,
		y: 2703.806884765625,
	},
	{
		id: 31,
		x: 7776.626953125,
		y: 3929.5458984375,
	},
	{
		id: 32,
		x: 6536.03076171875,
		y: 4033.548095703125,
	},
	{
		id: 33,
		x: 6075.4501953125,
		y: 3877.544921875,
	},
	{
		id: 34,
		x: 8110.91943359375,
		y: 2191.22509765625,
	},
	{
		id: 35,
		x: 7278.90283203125,
		y: 2837.52392578125,
	},
	{
		id: 36,
		x: 7821.19970703125,
		y: 4107.83544921875,
	},
	{
		id: 37,
		x: 7888.05810546875,
		y: 4419.841796875,
	},
	{
		id: 38,
		x: 7427.47705078125,
		y: 3268.389892578125,
	},
	{
		id: 39,
		x: 7873.20068359375,
		y: 4196.97998046875,
	},
	{
		id: 40,
		x: 8408.068359375,
		y: 2889.52490234375,
	},
	{
		id: 41,
		x: 7516.6220703125,
		y: 3231.24609375,
	},
	{
		id: 42,
		x: 7784.05615234375,
		y: 3832.97265625,
	},
	{
		id: 43,
		x: 4337.12939453125,
		y: 4612.98828125,
	},
	{
		id: 44,
		x: 7531.4794921875,
		y: 3104.9580078125,
	},
];

let selectedCardElement = null;

/**
 * Returns true if browser is a mobile device
 *
 * @returns {boolean}
 */
function isMobile() {
	return window.innerWidth <= 768;
}

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
			"tw-top-32",
			"tw-left-32",
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
	const rect = mapSvgGroup.getBBox();
	const cx = rect.x + rect.width / 2;
	const cy = rect.y + rect.height / 2;

	console.log("zoom coords", {
		x: rect.x,
		y: rect.y,
		width: rect.width,
		height: rect.height,
		cx,
		cy,
	});

	return { x: cx, y: cy };
}

/**
 * Setup the panzoom instance and add event listeners to the zoom in and zoom
 * out buttons
 *
 * @returns {void}
 */
function setupPanzoom() {
	const isMobileDevice = isMobile();
	console.log("isMobileDevice", isMobileDevice);

	const instance = panzoom(mapSvgGroup, {
		transformOrigin: { x: 0.5, y: 0.5 }, // centers the map
		bounds: true,
		boundsPadding: 0.05, // the bigger the value (max 1), the less of the map is visible

		maxZoom: 0.5,
		minZoom: 0.1,
		initialZoom: 0.1,
		initialX: 500,
		initialY: 4000,
	});

	// This event will be called along with events above.
	instance.on("transform", function (e) {
		console.log("logging latest panzoom instance", instance.getTransform());
	});

	// increase scale of map when zoom in button is clicked
	zoomInBtn.addEventListener("click", function () {
		const { x, y } = getCoords(mapSvgGroup);
		instance.zoomTo(x, y, 2);
	});

	// decrease scale of map when zoom out button is clicked
	zoomOutBtn.addEventListener("click", function () {
		const { x, y } = getCoords(mapSvgGroup);
		instance.zoomTo(x, y, 0.2);
	});
}

document.addEventListener("DOMContentLoaded", setupPanzoom);
