/* =========================================
   SIDEBAR ACTIVE AUTO-HIGHLIGHT
========================================= */

document.addEventListener("DOMContentLoaded", () => {
    let current = window.location.pathname.split("/").pop();  

    document.querySelectorAll(".sidebar a").forEach(link => {
        let file = link.getAttribute("href");
        if (file === current) {
            link.classList.add("active");
        }
    });
});
