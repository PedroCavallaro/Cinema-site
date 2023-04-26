const url = new URLSearchParams(window.location.search);
const already = url.get("already");
const spanError = document.querySelector("#spanError");
const mainContainer = document.querySelector(".mainContainer");
if (already === "1") {
    spanError.innerText = "Usuário já registrado";
}
