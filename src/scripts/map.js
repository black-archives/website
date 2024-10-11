/**
 * This script is responsible for setting up the interactive map in
 * page-map.php file.
 *
 * The script does the following:
 *
 * - It uses the panzoom library to pand and zoom the [map] image within the svg.
 * - Creates card elements that displays information about map pointers when the user clicks on them.
 * - Switches the language of the map card content when the user clicks on the language buttons.
 * - Scrolls between the map and the map info section when the user clicks on the map info buttons.
 */

// ======================================== Variables ========================================

const map = document.getElementById("map-main"); // entire map container
const mapSvg = document.getElementById("map-svg");
const mapSvgGroup = document.getElementById("map-svg-group");
const mapInfo = document.getElementById("map-info");
const mapInfoBtn = document.getElementById("btn-map-info");
const mapInfoCloseBtn = document.getElementById("btn-map-info-close");
const zoomInBtn = document.getElementById("btn-zoom-in");
const zoomOutBtn = document.getElementById("btn-zoom-out");
const englishLanguageBtn = document.getElementById("btn-lang-en");
const swedishLanguageBtn = document.getElementById("btn-lang-sv");

let selectedCardElement = null;

// ======================================== Functions ========================================

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
	if (selectedCardElement) {
		selectedCardElement.remove();
		selectedCardElement = null;
	}

	const card = document.createElement("div");
	card.classList.add(
		"map-card",
		"tw-absolute",
		"tw-top-1/3",
		"tw-w-11/12",
		"tw-min-h-60",
		"tw-max-h-96",
		"tw-mx-2",
		"tw-p-4",
		"tw-bg-slate-100",
		"tw-rounded-xl",
		"tw-border",
		"tw-border-slate-800",
		"tw-overflow-x-hidden",
		"tw-overflow-y-scroll",
		"tw-flex-col",
		"md:tw-left-1/3",
		"md:tw-w-5/12",
		"md:tw-min-h-60"
	);
	card.id = id;

	const closeButton = document.createElement("button");
	closeButton.textContent = "X";
	closeButton.classList.add("tw-mx-2", "tw-px-2", "tw-text-2xl");
	closeButton.addEventListener("click", function () {
		card.remove();
		selectedCardElement = null;
	});

	const cardTitle = document.createElement("h3");
	cardTitle.textContent = `${id}. ${title}`;

	const cardHead = document.createElement("div");
	cardHead.classList.add("tw-flex", "tw-justify-between", "tw-items-start");
	cardHead.appendChild(cardTitle);
	cardHead.appendChild(closeButton);

	// the page-map.php converts special characters which we need to
	// convert back here
	body = body.replace(/<br>/g, "\n"); // newlines
	body = body.replace(/\"/g, '"'); // double quotes
	body = body.replace(/\'/g, "'"); // single quotes

	const cardContent = document.createElement("p");
	cardContent.textContent = body;

	const cardBody = document.createElement("div");
	cardBody.appendChild(cardContent);

	card.appendChild(cardHead);
	card.appendChild(cardBody);

	map.appendChild(card);
	selectedCardElement = card;
}

/**
 * Returns the x and y coordinates of the center of the svg element
 *
 * @returns {Object} - object containing x and y coordinates
 */
function getCoords() {
	// exit if mapSvgGroup is not group instance of SVGElement
	if (!(mapSvgGroup instanceof SVGElement)) {
		return;
	}

	const rect = mapSvgGroup.getBBox();
	const cx = rect.x + rect.width / 2;
	const cy = rect.y + rect.height / 2;

	return { x: cx, y: cy };
}

/**
 * Setup the panzoom instance and add event listeners to the zoom in and zoom
 * out buttons
 *
 * @returns {void}
 */
function setupPanzoom() {
	const PANZOOM_ZOOM_IN = 2;
	const PANZOOM_ZOOM_OUT = 0;

	const isMobileDevice = isMobile();

	const instance = panzoom(mapSvgGroup, {
		bounds: true,
		boundsPadding: isMobile() ? 0.05 : 0.9, // the bigger the value (max 1), the less of the map is visible
		initialZoom: isMobileDevice ? 0.15 : 0.2,
		initialX: isMobileDevice ? -1100 : 0,
		initialY: isMobileDevice ? 0 : 0,
	});

	// increase scale of map when zoom in button is clicked
	if (zoomInBtn) {
		zoomInBtn.addEventListener("click", function () {
			const { x, y } = getCoords();
			instance.smoothZoom(x, y, PANZOOM_ZOOM_IN);
		});
	}

	// decrease scale of map when zoom out button is clicked
	if (zoomOutBtn) {
		zoomOutBtn.addEventListener("click", function () {
			const { x, y } = getCoords();
			instance.smoothZoom(x, y, PANZOOM_ZOOM_OUT);
		});
	}
}

/**
 * Change the language of the map card content based on the provided
 * language code.
 *
 * Note: This function is probably not the best way to handle language
 * switching but this is honest work.
 *
 * @param {string} lang - the language code (en or sv)
 *
 * @returns {void}
 */
function setLanguage(lang) {
	const origin = window.location.origin;
	const path = window.location.pathname;

	const langCode = lang === "sv" ? "sv" : "en";
	const currentLanguage = path.includes("/sv/") ? "sv" : "en";

	// skip if the language is already set
	if (currentLanguage === langCode) {
		return;
	}

	// redirect to the correct language path
	let newPath = path;
	if (langCode === "en") {
		// remove /sv/ from the path
		newPath = path.replace("/sv/", "/");
	} else {
		newPath = `/sv${path}`;
	}

	// redirect to the new path
	window.location.href = `${origin}${newPath}`;
}

// ======================================== Event Listeners ========================================

// setup the panzoom instance when the document is loaded
document.addEventListener("DOMContentLoaded", setupPanzoom);

// add event listener to map info button to scroll to the map info section
if (mapInfoBtn) {
	mapInfoBtn.addEventListener("click", function () {
		if (mapInfo) {
			mapInfo.scrollIntoView({ behavior: "smooth" });
		}
	});
}

// add event listener to map info close button to scroll to the top of the page
if (mapInfoCloseBtn) {
	mapInfoCloseBtn.addEventListener("click", function () {
		window.scrollTo({ top: 0, behavior: "smooth" });
	});
}

// add event listener to language buttons
const events = ["click", "touchend"];
events.forEach((event) => {
	if (englishLanguageBtn) {
		englishLanguageBtn.addEventListener(event, function () {
			setLanguage("en");
		});
	}

	if (swedishLanguageBtn) {
		swedishLanguageBtn.addEventListener(event, function () {
			setLanguage("sv");
		});
	}
});
