const info: NodeListOf<Element> = document.querySelectorAll(".info")
const moviePoster: HTMLImageElement = document.querySelector(".moviePoster")
const lsInfo = JSON.parse(localStorage.getItem("info"))
const seats: HTMLTitleElement = document.querySelector("#seats")
const totalValue: HTMLLabelElement = document.querySelector("#totalValue")
const actionButtons: NodeListOf<Element> = document.querySelectorAll(".actionButton"),
    itensArr: Item[] = [],
    goToPayment: HTMLAnchorElement = document.querySelector(".goToPayment")

let c: number = 0,
     countTickets: number = 0

type Item = {
    name: string,
    qtd: number
}

window.addEventListener("load", ()=>{
    totalValue.innerText = "0"
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


actionButtons.forEach((e: HTMLElement)=>{
    const arrSeats = lsInfo[lsInfo.length -1]
    
    e.addEventListener("click", ()=>{
        
        
        const item: Item = {
            name: null,
            qtd: 0
        } 

        const parent:Element = e.parentElement  
        const amount:any = parent.children[1],        
         less: any = parent.children[0],        
         more: any = parent.children[2]        
       

        if(e.classList.contains("m")){
            totalValue.innerText =  String(Number(totalValue.innerText) + Number(e.dataset.value))
            amount.value = Number(amount.value) +1
            
            if(findElement(itensArr, e)){
                    itensArr.map((ele)=>{
                        if(ele.name === e.dataset.name){
                            ele.qtd +=1
                        }
                    })

            }else{

                item.name = e.dataset.name
                item.qtd += 1

                itensArr.push(item)
            }

            if(e.classList.contains("ticket")){
                countTickets++

                if(countTickets === arrSeats.length){
                 
                    document.querySelectorAll(".ticket.m").forEach((b)=>{
                        b.setAttribute("disabled", "true")
                    })
                }
            }
            
        }else if(e.classList.contains("l")){
            
            if(findElement(itensArr, e)){

                itensArr.map((ele)=>{
                    if(ele.name === e.dataset.name){
                        if(ele.qtd !== 0){
                            ele.qtd -=1
                        }
                    }
                })
            }

            if(!(amount.value === "0" || amount.value === "")){
                    totalValue.innerText =  String(Number(totalValue.innerText) - Number(e.dataset.value))
                    amount.value = Number(amount.value) - 1 
                    c-=1
                    
                    if(e.classList.contains("ticket")){
                        countTickets--

                        document.querySelectorAll(".ticket.m").forEach((b)=>{
                        b.removeAttribute("disabled")
                    })

                }
            }
        }
    })
})

goToPayment.addEventListener("click", (e)=>{
        const request = {
            total: totalValue.innerText,
            itens: itensArr.filter((ele) => ele.qtd !== 0)
        }
        localStorage.setItem("request", JSON.stringify(request))
})

function findElement(arr: Item[], e: HTMLElement):boolean {
        if(arr.find((ele)=> ele.name === e.dataset.name)){
            
            return true
        }
        return false
    
}

