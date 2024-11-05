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

let selectedCardElement = null;

// ======================================== Functions ========================================

/**
 * Create a card element place it in the map container
 *
 * @param {string|null} id - the id of the card
 * @param {string} title - the title of the card
 * @param {string|HTMLElement} content - the content of the card
 *
 * @returns {void}
 */
function setCard(id, title, content) {
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
	card.id = id | 0;

	const closeButton = document.createElement("button");
	closeButton.textContent = "X";
	closeButton.classList.add("tw-mx-2", "tw-px-2", "tw-text-2xl");
	closeButton.addEventListener("click", function () {
		card.remove();
		selectedCardElement = null;
	});

	const cardTitle = document.createElement("h3");
	cardTitle.textContent = id ? `${id}. ${title}` : title;

	const cardHead = document.createElement("div");
	cardHead.classList.add("tw-flex", "tw-justify-between", "tw-items-start");
	cardHead.appendChild(cardTitle);
	cardHead.appendChild(closeButton);

	let cardContent = null;
	if (typeof content === "object") {
		cardContent = content;
	} else {
		// the page-map.php converts special characters which we need to
		// convert back here
		content = content.replace(/<br>/g, "\n"); // newlines
		content = content.replace(/\"/g, '"'); // double quotes
		content = content.replace(/\'/g, "'"); // single quotes

		cardContent = document.createElement("p");
		cardContent.textContent = content;
	}

	const cardBody = document.createElement("div");
	cardBody.appendChild(cardContent);

	card.appendChild(cardHead);
	card.appendChild(cardBody);

	map.appendChild(card);
	selectedCardElement = card;
}

/**
 * Create a card element with onboarding instructions
 */
function setOnboardingCard() {
	// This is a very messy way to handle the language switching but it is
	// almost 10pm on a Friday and I am tired - so it is what it is.
	const enTitle = "Welcome to the map!";
	const svTitle = "Välkommen till kartan!";

	const enOnboardingHeader = "How to interact with the map";
	const svOnboardingHeader = "Hur man använder kartan";

	const enMobileOnboardingSteps = [
		"Drag your finger to move around the map.",
		"Pinch with fingers to zoom in and out.",
		"Click map pointers to view more information.",
	];
	const svMobileOnboardingSteps = [
		"Dra fingret för att flytta runt på kartan.",
		"Knip med fingrarna för att zooma in och ut.",
		"Klicka på kartmarkörer för att visa mer information.",
	];

	const enDesktopOnboardingSteps = [
		"Click and drag to move around the map.",
		"Use the scroll wheel to zoom in and out.",
		"Click map pointers to view more information.",
	];

	const svDesktopOnboardingSteps = [
		"Klicka och dra för att flytta runt på kartan.",
		"Använd scrollhjulet för att zooma in och ut.",
		"Klicka på kartmarkörer för att visa mer information.",
	];

	const title = getLanguage() === "sv" ? svTitle : enTitle;

	const onboardingHeader =
		getLanguage() === "sv" ? svOnboardingHeader : enOnboardingHeader;

	const onboardingSteps = isMobile()
		? getLanguage() === "sv"
			? svMobileOnboardingSteps
			: enMobileOnboardingSteps
		: getLanguage() === "sv"
		? svDesktopOnboardingSteps
		: enDesktopOnboardingSteps;

	const header = document.createElement("p");
	header.textContent = onboardingHeader;

	const list = document.createElement("ul");
	list.classList.add("tw-list-decimal", "tw-list-inside");
	onboardingSteps.forEach((step) => {
		const li = document.createElement("li");
		li.classList.add("tw-ml-2");
		li.textContent = step;
		list.appendChild(li);
	});

	const content = document.createElement("div");
	content.appendChild(header);
	content.appendChild(list);

	setCard(null, title, content);
}

/**
 * Setup the panzoom instance and add event listeners to the zoom in and zoom
 * out buttons
 *
 * @returns {object} - the panzoom instance
 */
function setupPanzoom() {
	const isMobileDevice = isMobile();

	const getCoords = () => {
		// exit if mapSvgGroup is not group instance of SVGElement
		if (!(mapSvgGroup instanceof SVGElement)) {
			return;
		}

		const rect = mapSvgGroup.getBBox();
		const cx = rect.x + rect.width / 2;
		const cy = rect.y + rect.height / 2;

		return { x: cx, y: cy };
	};

	return panzoom(mapSvgGroup, {
		bounds: true,
		boundsPadding: isMobileDevice ? 0.05 : 0.9, // the bigger the value (max 1), the less of the map is visible
		initialZoom: isMobileDevice ? 0.15 : 0.3,
		initialX: isMobileDevice ? -1100 : 0,
		initialY: isMobileDevice ? 0 : 0,
	});
}

// ======================================== Event Listeners ========================================

// add event listener for web page load
document.addEventListener("DOMContentLoaded", setupPanzoom);
document.addEventListener("DOMContentLoaded", setOnboardingCard);

// add event listeners for clicking and touching
["click", "touchend"].forEach((event) => {
	// map info btn
	if (mapInfoBtn) {
		mapInfoBtn.addEventListener(event, function () {
			if (mapInfo) {
				mapInfo.scrollIntoView({ behavior: "smooth" });
			}
		});
	}

	// close map info btn
	if (mapInfoCloseBtn) {
		mapInfoCloseBtn.addEventListener(event, function () {
			window.scrollTo({ top: 0, behavior: "smooth" });
		});
	}
});
