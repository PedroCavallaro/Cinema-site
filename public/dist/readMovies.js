const delet = document.querySelectorAll(".delete"), formModal = document.querySelector(".modal > form"), yesButton = document.querySelector(".yesButton"), modalContainer = document.querySelector(".modal-container"), modal = document.querySelector(".modal"), closeModal = document.querySelectorAll(".close"), updateButton = document.querySelectorAll(".updateButton"), imgList = document.querySelectorAll(".imgList"), delButton = document.querySelector("#delButton"), delForm = document.querySelector("#delForm");
delet.forEach((e) => {
    e.addEventListener("click", () => {
        modalContainer.classList.add("show");
        modal.classList.add("show");
        yesButton.addEventListener("click", () => {
            formModal.classList.add("show");
        });
        delButton.addEventListener("click", () => {
            delForm.action = "../src/delete.php?" + e.dataset.href;
        });
    });
});
updateButton.forEach((e) => {
    e.addEventListener("click", () => {
        const td = e.parentElement;
        const tr = td.parentElement;
        const tdChild = tr.children[0];
        const img = tdChild.children[0];
        localStorage.setItem("imgPath", JSON.stringify(img.src));
    });
});
closeModal.forEach((e) => {
    e.addEventListener("click", () => {
        modalContainer.classList.remove("show");
        modal.classList.remove("show");
    });
});
