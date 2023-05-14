const movieModal = {
    movieName: document.querySelector(".movieContentContainer").children[0].innerHTML,
    seatsChose: document.querySelector(".seatsChose"),
    showSeats: document.querySelector(".seatsContainer"),
    seatsMainContainer: document.querySelector(".seatsMainContainer"),
    moviePoster: document.querySelector("#moviePoster"),
    ticketAmount: document.querySelector("#ticketAmount"),
    closeModal: document.querySelector("#closeModal"),
    finishButton: document.querySelector("#finishButton")
};
const mainItens = {
    imgAncor: document.querySelector("#imgAncor"),
    roomButton: document.querySelectorAll(".room"),
    movieImg: document.querySelector(".movieImg"),
    today: document.querySelector("#today"),
    homeBAnchor: document.querySelector("#homeBAnchor")
};
const seatsLetter = [] = "ABCDEFGHIJK".split(''), date = new Date();
let saveText = [];
window.addEventListener("load", async () => {
    mainItens.imgAncor.removeAttribute("href");
    createSeats(movieModal.seatsChose);
    mainItens.today.innerText = String(date.getDate()) + " / " + String(date.getMonth() + 1);
});
mainItens.roomButton.forEach((e) => {
    e.addEventListener("click", () => {
        const roomEle = {
            roomTime: document.querySelector("#roomTime"),
            roomNodes: e.childNodes,
            roomPick: document.querySelector("#roomPick")
        };
        movieModal.showSeats.classList.add("show");
        movieModal.seatsMainContainer.classList.add("show");
        movieModal.moviePoster.src = mainItens.movieImg.src;
        const seatsList = document.querySelectorAll(".seat");
        roomEle.roomPick.innerHTML = roomEle.roomNodes[1].textContent;
        roomEle.roomTime.innerHTML = `Horário: ${roomEle.roomNodes[3].textContent}`;
        seatsList.forEach((e) => {
            e.addEventListener("click", () => {
                if (!(e.classList.contains("selected"))) {
                    e.classList.add("selected");
                    saveText.push((e.id + "|"));
                    movieModal.ticketAmount.innerText += saveText[saveText.length - 1];
                }
                else {
                    e.classList.remove("selected");
                    saveText = saveText.filter(ele => ele !== (e.id + "|"));
                    movieModal.ticketAmount.innerHTML = `Assentos: ${saveText.join(" ")}   `;
                }
            });
        });
    });
    movieModal.closeModal.addEventListener("click", () => {
        movieModal.showSeats.classList.remove("show");
        movieModal.seatsMainContainer.classList.remove("show");
    });
});
movieModal.finishButton.addEventListener("click", () => {
    if (!(typeof saveText[0] === "undefined")) {
        const movieInfo = [];
        const elements = document.querySelectorAll(".modalInfo");
        movieInfo.push(movieModal.moviePoster.src);
        elements.forEach((e) => {
            movieInfo.push(e.innerHTML);
        });
        movieInfo.push(saveText);
        localStorage.setItem("info", JSON.stringify(movieInfo));
    }
    else {
        const anchor = document.querySelector("#finishChoice > a");
        anchor.href = "";
    }
});
function createSeats(divMain) {
    for (let i = 0; i < seatsLetter.length; i++) {
        const divChild = document.createElement("div");
        divChild.id = String(seatsLetter[i]);
        divMain.append(divChild);
        for (let j = 0; j < seatsLetter.length; j++) {
            const seats = document.createElement("img");
            seats.id = seatsLetter[i] + j;
            seats.src = "../public/img/seat.png";
            seats.classList.add("seat");
            divChild.append(seats);
        }
    }
}
export {};
