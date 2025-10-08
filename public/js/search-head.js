document.addEventListener("DOMContentLoaded", function () {
    const searchForm = document.querySelector("form.search");

    searchForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(searchForm);
        const searchQuery = formData.get("search");

        fetch(
            `{{ route('redirect-search', ['type' => 'head']) }}?search=${encodeURIComponent(
                searchQuery
            )}`,
            {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            }
        )
            .then((response) => response.text())
            .then((html) => {
                const wrapper = document.getElementById(
                    "familySearchTableWrapper"
                );
                if (wrapper) {
                    wrapper.innerHTML = html;
                } else {
                    console.error("Wrapper not found");
                }
            })
            .catch((error) => {
                console.error("AJAX error:", error);
            });
    });
});
