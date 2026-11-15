
document.addEventListener("DOMContentLoaded", () => {

    // Tabellen sortieren
    const tables = document.querySelectorAll("table");

    tables.forEach(table => {

        const headers = table.querySelectorAll("thead th");
        const tbody = table.querySelector("tbody");

        if (!tbody || !headers.length) return;

        headers.forEach((header, columnIndex) => {

            header.style.cursor = "pointer";

            header.addEventListener("click", () => {

                const rows = Array.from(tbody.querySelectorAll("tr"));

                // Sortierrichtung wechseln
                const direction = header.dataset.sortDirection === "asc"
                    ? "desc"
                    : "asc";

                // Sortierrichtung bei allen Spalten zurücksetzen
                headers.forEach(th => {
                    delete th.dataset.sortDirection;
                });

                header.dataset.sortDirection = direction;

                rows.sort((a, b) => {

                    const aText = a.cells[columnIndex]?.textContent.trim() ?? "";
                    const bText = b.cells[columnIndex]?.textContent.trim() ?? "";

                    // Zahlen erkennen
                    const aNumber = Number(aText.replace(",", "."));
                    const bNumber = Number(bText.replace(",", "."));

                    let result;

                    if (aText !== "" && bText !== "" &&
                        !isNaN(aNumber) && !isNaN(bNumber)) {

                        result = aNumber - bNumber;

                    } else {

                        result = aText.localeCompare(bText, "de", {
                            numeric: true,
                            sensitivity: "base"
                        });

                    }

                    return direction === "asc" ? result : -result;

                });

                rows.forEach(row => tbody.appendChild(row));

            });

        });

    });


    // Tabellenzeilen markieren
    document.querySelectorAll("table tbody tr").forEach(row => {

        row.addEventListener("click", () => {

            document.querySelectorAll(".marked").forEach(element => {
                element.classList.remove("marked");
            });

            row.classList.add("marked");

        });

    });


    // Leere Absätze entfernen
    document.querySelectorAll("p").forEach(paragraph => {

        if (paragraph.textContent.replace(/[\s\u00a0]/g, "").length === 0) {
            paragraph.remove();
        }

    });

});
