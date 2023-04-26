const imgAncor = document.querySelector("#imgAncor"), homeButton = document.querySelector("#homeButton"), seatsChose = document.querySelector(".seatsChose"), seatsLetter = [] = "ABCDEFGHIJK".split(''), roomButton = document.querySelectorAll(".room"), showSeats = document.querySelector(".seatsContainer"), seatsMainContainer = document.querySelector(".seatsMainContainer"), movieImg = document.querySelector(".movieImg"), moviePoster = document.querySelector("#moviePoster"), today = document.querySelector("#today"), date = new Date(), ticketAmount = document.querySelector("#ticketAmount"), saveText = [];
window.addEventListener("load", async () => {
    await test();
    imgAncor.removeAttribute("href");
    createSeats(seatsChose);
    today.innerText = String(date.getDate()) + " / " + String(date.getMonth() + 1);
});
roomButton.forEach((e) => {
    e.addEventListener("click", () => {
        showSeats.classList.add("show");
        seatsMainContainer.classList.add("show");
        moviePoster.src = movieImg.src;
        const seatsList = document.querySelectorAll(".seat");
        seatsList.forEach((e) => {
            e.addEventListener("click", () => {
                if (!(e.classList.contains("selected"))) {
                    e.classList.add("selected");
                    saveText.push((" " + e.id + " |"));
                    ticketAmount.innerText += saveText[saveText.length - 1];
                }
                else {
                    e.classList.remove("selected");
                    const newSaveText = saveText.filter((e) => {
                        return e !== (" " + e.id + " |");
                    });
                    console.log(saveText.join());
                    ticketAmount.innerHTML = `Assentos | ${newSaveText.join(" ")} `;
                }
            });
        });
    });
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
async function test() {
    const response = await fetch("https://api.themoviedb.org/3/search/movie")
        .then((res) => res.json())
        .then((data) => console.log(data));
    console.log(response);
}
