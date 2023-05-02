const info: NodeListOf<Element> = document.querySelectorAll(".info")
const moviePoster: HTMLImageElement = document.querySelector(".moviePoster")
const lsInfo = JSON.parse(localStorage.getItem("info"))
const seats: HTMLTitleElement = document.querySelector("#seats")
let c = 0

window.addEventListener("load", ()=>{
    moviePoster.src = lsInfo[0]
    for(let i = 1; i < lsInfo.length -2; i++) {
        info[i].innerHTML = lsInfo[i]
    }

})