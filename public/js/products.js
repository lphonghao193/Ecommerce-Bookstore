showFilter = () => {
    let filterForm = document.getElementById("filter");
    if (filterForm.style.display === "none" || filterForm.style.display === "") {
        filterForm.style.display = "block";
    } else {
        filterForm.style.display = "none";
    }
}

window.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#filterForm");
    if (form) {
        form.addEventListener("submit", function () {
            this.querySelectorAll("input, select").forEach(input => {
                if (!input.value || input.value.trim() === "") {
                    input.removeAttribute("name");
                }
            });
        });
    }
});
