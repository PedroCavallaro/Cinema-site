const data: any[] = treatData(JSON.parse(localStorage.getItem("info"))),
    infoToset: NodeListOf<any>  = document.querySelectorAll(".info"),
    moviePosterP: HTMLImageElement = document.querySelector(".moviePoster"),
    request = JSON.parse(localStorage.getItem("request")),
    finalValue: HTMLParagraphElement = document.querySelector("#finalValue"),
    itensList: HTMLElement = document.querySelector(".itensList")
window.addEventListener("load", ()=>{

    renderItens(itensList, request.itens)

    moviePosterP.src = data[0]
    for(let i = 1; i < data.length; i++) {
        
        infoToset[i].innerHTML = data[i]
    }
    finalValue.innerText = request.total

})




function treatData(lsInfo: any[]){
    
    const duration = lsInfo[2].split(" ")
    const gender = lsInfo[3].split(":")
    const time = lsInfo[5].split(":")
    lsInfo[2] = duration[1] + " min"
    lsInfo[3] = gender[1]
    lsInfo[5] = time[1] + ":" + time[2] 
    lsInfo[6] = lsInfo[6].join("")
    
    return lsInfo
}


function renderItens(parentElement: HTMLElement, list: object[]){
        list.forEach((e: any)=>{
            const td1 = document.createElement("td")
            const td2 = document.createElement("td")
            const tr = document.createElement("tr")

            td1.innerText = e.qtd + "x "
            td2.innerHTML = e.name
            tr.append(td1,td2)
            parentElement.append(tr)
        })
}