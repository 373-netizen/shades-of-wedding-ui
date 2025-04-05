document.addEventListener("click", function (event) {
    if (event.target.classList.contains("view-details")) {
        const button = event.target;
        const title = button.getAttribute("data-title");
        const description = button.getAttribute("data-description");
        const image = button.getAttribute("data-image");
        const price = button.getAttribute("data-price");

        document.getElementById("modalTitle").innerText = title;
        document.getElementById("modalDescription").innerText = description;
        document.getElementById("modalImage").src = image;
        document.getElementById("modalPrice").innerText = price;
    }
});
