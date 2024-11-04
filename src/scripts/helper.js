const englishLanguageBtn = document.getElementById("btn-lang-en");
const swedishLanguageBtn = document.getElementById("btn-lang-sv");

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

// add event listeners for clicking and touching
const events = ["click", "touchend"];
events.forEach((event) => {
	const underlineClass = "tw-underline";
	const styleAnchor = "language-link";

	// language btn for english
	if (englishLanguageBtn) {
		englishLanguageBtn.addEventListener(event, function () {
			setLanguage("en");
		});

		// set underline class if current language is english
		if (
			getLanguage() === "en" &&
			englishLanguageBtn.classList.contains(styleAnchor)
		) {
			englishLanguageBtn.classList.add(underlineClass);
		}
	}

	// language btn for swedish
	if (swedishLanguageBtn) {
		swedishLanguageBtn.addEventListener(event, function () {
			setLanguage("sv");
		});

		// set underline class if current language is swedish
		if (
			getLanguage() === "sv" &&
			swedishLanguageBtn.classList.contains(styleAnchor)
		) {
			swedishLanguageBtn.classList.add(underlineClass);
		}
	}
});
