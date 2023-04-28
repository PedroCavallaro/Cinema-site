const searchText = document.querySelector("#search"), urlFm = new URLSearchParams(window.location.search), searchValue = urlFm.get("search"), card = document.querySelectorAll(".card");
window.addEventListener("load", () => {
    searchText.innerText = `'${searchValue === null ? "  " : searchValue}'`;
});
card.forEach((e) => {
    e.addEventListener("click", () => {
        const cookie = `movieId=${e.id}`;
        document.cookie = cookie;
    });
});
