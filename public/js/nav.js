document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.getElementById("menu");
    const mobileMenu = document.getElementById("mobileMenu");

    const infoBtn = document.getElementById("info");
    const infoMenu = document.getElementById("infoMenu");
    
    // Only attach listeners if buttons exist
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener("click", () => {
            if (infoMenu && infoMenu.classList.contains("show")) {
                infoMenu.classList.remove("show");
            }
            mobileMenu.classList.toggle("show");
        });
    }

    if (infoBtn && infoMenu) {
        infoBtn.addEventListener("click", () => {
            if (mobileMenu && mobileMenu.classList.contains("show")) {
                mobileMenu.classList.remove("show");
            }
            infoMenu.classList.toggle("show");
        });
    }

    document.addEventListener("click", (e) => {
        const isClickInsideMenu = menuBtn && (mobileMenu.contains(e.target) || menuBtn.contains(e.target));
        const isClickInsideInfo = infoBtn && (infoMenu.contains(e.target) || infoBtn.contains(e.target));

        if (!isClickInsideMenu && mobileMenu) {
            mobileMenu.classList.remove("show");
        }

        if (!isClickInsideInfo && infoMenu) {
            infoMenu.classList.remove("show");
        }
    });

    const setupSearch = (inputId, resultsId) => {
        const searchBox = document.getElementById(inputId);
        const resultsContainer = document.getElementById(resultsId);

        if (!searchBox || !resultsContainer) return;

        searchBox.addEventListener("input", async function () {
            const query = searchBox.value.trim();
            if (query.length === 0) {
                resultsContainer.style.display = "none";
                return;
            }

            try {
                const response = await fetch(`./app/controllers/SearchController.php?q=${encodeURIComponent(query)}`);
                if (!response.ok) throw new Error("Fetch error");

                const data = await response.json();
                resultsContainer.innerHTML = "";

                if (Array.isArray(data.categories)) {
                    data.categories.forEach(cat => {
                        resultsContainer.innerHTML += `
                            <a class="row d-flex align-items-center p-2 border-bottom text-decoration-none text-dark"
                                href="?page=products&filter-category[]=${cat.id}">
                                <span class="material-symbols-outlined col-4">${cat.icon}</span>
                                <div class="col-8">
                                    <p class="fw-bold mb-1">Category: ${cat.name}</p>
                                </div>
                            </a>`;
                    });
                }

                if (Array.isArray(data.books)) {
                    data.books.forEach(book => {
                        resultsContainer.innerHTML += `
                            <a class="row d-flex align-items-center p-2 border-bottom text-decoration-none text-dark"
                                href="?page=product&id=${book.id}">
                                <div class="col-4">
                                    <img loading="lazy" src="${book.path}" alt="Image of ${book.name}"
                                        class="img-fluid" style="height: 2cm; width: auto;">
                                </div>
                                <div class="col-8">
                                    <p class="fw-bold mb-1">${book.name}</p>
                                    <p class="fst-italic mb-0">${book.category}</p>
                                </div>
                            </a>`;
                    });
                }

                resultsContainer.style.display = resultsContainer.innerHTML.trim().length > 0 ? "block" : "none";
                resultsContainer.style.zIndex = "1001";
            } catch (error) {
                console.error("Search error:", error);
                resultsContainer.style.display = "none";
            }
        });

        document.addEventListener("click", function (event) {
            if (!searchBox.contains(event.target) && !resultsContainer.contains(event.target)) {
                resultsContainer.style.display = "none";
            }
        });
    };

    setupSearch("search-box", "search-results");
    setupSearch("search-box-mb", "search-results-mb");
});
