/**
 * This script is used to setup helper functions that are used in multiple
 * scripts in the project.
 */

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
 * Return the language code based on the current path
 *
 * @returns {string} - the language code (en or sv)
 */
function getLanguage() {
	const path = window.location.pathname;
	return path.includes("/sv/") ? "sv" : "en";
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
	const currentLanguage = getLanguage();
	const langCode = lang === "sv" ? "sv" : "en";

	// skip if the language is already set
	if (currentLanguage === langCode) {
		return;
	}

	const origin = window.location.origin;
	const path = window.location.pathname;

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

/**
 * Returns the language buttons
 *
 * the language buttons
 */
function getLanguageButtons() {
	const BTN_ENGLISH_ID = "btn-lang-en";
	const BTN_SWEDISH_ID = "btn-lang-sv";

	return {
		englishBtn: document.getElementById(BTN_ENGLISH_ID),
		swedishBtn: document.getElementById(BTN_SWEDISH_ID),
	};
}

/**
 * Underlines language buttons based on the current language
 * and the style anchor class.
 */
function setLanguageButtons() {
	const { englishBtn, swedishBtn } = getLanguageButtons();

	const underlineClass = "tw-underline";
	const styleAnchor = "tw-font-bold";

	if (englishBtn) {
		// set event listeners
		englishBtn.addEventListener("click", function () {
			setLanguage("en");
		});

		englishBtn.addEventListener("touchend", function () {
			setLanguage("en");
		});

		// set underline class if current language is english
		if (getLanguage() === "en" && englishBtn?.classList.contains(styleAnchor)) {
			englishBtn.classList.add(underlineClass);
		}
	}

	if (swedishBtn) {
		// set event listeners
		swedishBtn.addEventListener("click", function () {
			setLanguage("sv");
		});

		swedishBtn.addEventListener("touchend", function () {
			setLanguage("sv");
		});

		// set underline class if current language is swedish
		if (getLanguage() === "sv" && swedishBtn?.classList.contains(styleAnchor)) {
			swedishBtn.classList.add(underlineClass);
		}
	}
}

// ======================================== Main ========================================

// set underline class for language buttons
setLanguageButtons();
