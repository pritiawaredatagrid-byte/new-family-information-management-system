document.addEventListener("click", function (e) {
    const target = e.target.closest("a");
    if (target && target.closest(".pagination")) {
        e.preventDefault();
        console.log("AJAX clicked: ", target.href);

        fetch(target.href, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        })
            .then((response) => response.text())
            .then((data) => {
                document.getElementById("stateTableWrapper").innerHTML = data;
            })
            .catch((error) => {
                console.error("AJAX error:", error);
            });
    }
});
