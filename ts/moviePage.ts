import * as interfaces from "./interfaces.js"

const movieModal: interfaces.modalItens = {
    movieName: document.querySelector(".movieContentContainer").children[0].innerHTML,
    seatsChose: document.querySelector(".seatsChose"),
    showSeats: document.querySelector(".seatsContainer"),
    seatsMainContainer: document.querySelector(".seatsMainContainer"),
    moviePoster: document.querySelector("#moviePoster"),
    ticketAmount: document.querySelector("#ticketAmount")
}

const mainItens: interfaces.mainPageItens = {
    imgAncor: document.querySelector("#imgAncor"),
    roomButton: document.querySelectorAll(".room"),
    movieImg: document. querySelector(".movieImg"),
    today: document.querySelector("#today"),
    homeBAnchor: document.querySelector("#homeBAnchor")
}
const seatsLetter = [] = "ABCDEFGHIJK".split(''),
    date = new Date(),
    urlMp: URLSearchParams = new URLSearchParams(window.location.search),
    usernameMp:string = urlMp.get("username")
let saveText = []
    
    
window.addEventListener("load",async ()=>{
    // const  movieData = await search(movieModal.movieName)
    mainItens.homeBAnchor.href = `index.php?username=${usernameMp}`
    mainItens.imgAncor.removeAttribute("href")
    createSeats(movieModal.seatsChose)
    mainItens.today.innerText = String(date.getDate()) +" / " + String(date.getMonth() + 1) 

})
mainItens.roomButton.forEach((e)=>{
    e.addEventListener("click", ()=>{
        const roomEle: interfaces.roomElements = {
            roomTime:document.querySelector("#roomTime"),
            roomNodes:e.childNodes,
            roomPick: document.querySelector("#roomPick")
        }

        movieModal.showSeats.classList.add("show")
        movieModal.seatsMainContainer.classList.add("show")
        movieModal.moviePoster.src = mainItens.movieImg.src
        const seatsList: NodeListOf<Element> = document.querySelectorAll(".seat")
        //h3
        roomEle.roomPick.innerHTML = roomEle.roomNodes[1].textContent
        //p 
        roomEle.roomTime.innerHTML += roomEle.roomNodes[3].textContent
        seatsList.forEach((e)=>{
            e.addEventListener("click", ()=>{
                if(!(e.classList.contains("selected"))){

                    e.classList.add("selected")
                    saveText.push((e.id + "|"))

                    movieModal.ticketAmount.innerText += saveText[saveText.length -1]
                
                }else{
                    e.classList.remove("selected")
                    saveText = saveText.filter(ele => ele !== (e.id+"|"))
                    console.log(saveText.join(""))
                    movieModal.ticketAmount.innerHTML = `Assentos: ${saveText.join(" ")}   `
                }
            })
        })
    })
})

function createSeats(divMain: HTMLDivElement){
    for (let i = 0; i <  seatsLetter.length; i++) {
        const divChild: HTMLDivElement = document.createElement("div")
        divChild.id = String(seatsLetter[i])
        divMain.append(divChild)

        for (let j = 0; j < seatsLetter.length; j++) {
            const seats:HTMLImageElement = document.createElement("img") 
            seats.id = seatsLetter[i]+j
            seats.src = "../public/img/seat.png"
            seats.classList.add("seat")
            divChild.append(seats)
        }
    }
}

