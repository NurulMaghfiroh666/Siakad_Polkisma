/* =========================================
   TABLE FILTERING / SEARCH FUNCTION
========================================= */

function searchTable() {
    let input = document.getElementById("search");
    if (!input) return;

    let filter = input.value.toLowerCase();
    let rows = document.querySelectorAll(".table tbody tr");

    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
}

