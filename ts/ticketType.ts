const info: NodeListOf<Element> = document.querySelectorAll(".info")
const moviePoster: HTMLImageElement = document.querySelector(".moviePoster")
const lsInfo = JSON.parse(localStorage.getItem("info"))
const seats: HTMLTitleElement = document.querySelector("#seats")
const totalValue: HTMLLabelElement = document.querySelector("#totalValue")
const actionButtons: NodeListOf<Element> = document.querySelectorAll(".actionButton")
let c = 0

window.addEventListener("load", ()=>{
    
    const arrSeats = lsInfo[lsInfo.length -1]
    moviePoster.src = lsInfo[0]

    const duration = lsInfo[2].split(":")
    const gender = lsInfo[3].split(":")
    const time = lsInfo[5].split(":")
    lsInfo[2] = duration[1]
    lsInfo[3] = gender[1]
    lsInfo[5] = time[1] + ":" + time[2] 
    for(let i = 1; i < lsInfo.length -1; i++) {
        
        info[i].innerHTML = lsInfo[i]
    }
    seats.innerHTML += arrSeats.join('')
})


actionButtons.forEach((e)=>{
    e.addEventListener("click", ()=>{
        const parent = e.parentElement
        const node:any = parent.children[1]

        if(e.classList.contains("m")){
            node.value = Number(node.value) + 1
  
        }else if(e.classList.contains("l")){
            if(!(node.value === "0" || node.value === " ")){
                node.value = Number(node.value) - 1 
                
            }
        }
    })
})