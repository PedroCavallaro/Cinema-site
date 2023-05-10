const info: NodeListOf<Element> = document.querySelectorAll(".info")
const moviePoster: HTMLImageElement = document.querySelector(".moviePoster")
const lsInfo = JSON.parse(localStorage.getItem("info"))
const seats: HTMLTitleElement = document.querySelector("#seats")
<<<<<<< HEAD
const totalValue: HTMLLabelElement = document.querySelector("#totalValue")
const actionButtons: NodeListOf<Element> = document.querySelectorAll(".actionButton")
let c: number = 0

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
    const arrSeats = lsInfo[lsInfo.length -1]
    
    e.addEventListener("click", ()=>{
        const parent:Element = e.parentElement
        const node:any = parent.children[1]        
    
        if(e.classList.contains("m")){
            console.log(e.id)
            if(e.id === "moreButton"){
                c+=1
                if(c === arrSeats.length){
                    document.querySelectorAll("#moreButton").forEach((b)=>{
                       b.setAttribute('disabled', 'true') 
                    }) 
                } 
                node.value = Number(node.value) +1
            }
        }else if(e.classList.contains("l")){

            if(e.id === "lessButton"){
                document.querySelectorAll("#moreButton").forEach((b)=>{
                    b.removeAttribute('disabled') 
                 }) 
                if(!(node.value === "0" || node.value === "")){
                    document.querySelectorAll("#lessButton").forEach((b)=>{
                        b.removeAttribute('disabled') 
                     }) 
                    node.value = Number(node.value) - 1 
                    c-=1
                }else{
                    e.setAttribute('disabled', '')
                    document.querySelectorAll("#moreButton").forEach((b)=>{
                        b.removeAttribute('disabled') 
                     }) 
                }
            }
        }
    })
=======
let c = 0

window.addEventListener("load", ()=>{
    moviePoster.src = lsInfo[0]
    for(let i = 1; i < lsInfo.length -2; i++) {
        info[i].innerHTML = lsInfo[i]
    }

>>>>>>> cea9c150b8905e9286bf56f41e404fada529fffb
})