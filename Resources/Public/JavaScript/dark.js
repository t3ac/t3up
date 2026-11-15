
let prefersDarkScheme;
let currentTheme;
let currentSize;

/* Darkmode ********************************************/

function checkDarkMode() {

    currentTheme = localStorage.getItem("color-mode");

    if (currentTheme === "dark") {
        document.documentElement.setAttribute("color-mode", "dark");
    } else if (currentTheme === "contrast") {
        document.documentElement.setAttribute("color-mode", "contrast");
    } else {
        prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
        document.documentElement.setAttribute(
            "color-mode",
            prefersDarkScheme.matches ? "system-dark" : "system-light"
        );
    }
}

/* Auf Änderungen der Systemeinstellung reagieren */

window.matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", checkDarkMode);

/* Schriftgröße ****************************************/

function checkfontSize() {
    currentSize = localStorage.getItem("font-size");
    if (currentSize !== null && currentSize !== "") {
        document.documentElement.style.fontSize = currentSize + "rem";
    }
}

/* Initialisierung *************************************/

checkfontSize();
checkDarkMode();
