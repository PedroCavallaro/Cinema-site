const searchText: HTMLTitleElement = document.querySelector("#search"),
    urlFm: URLSearchParams = new URLSearchParams(window.location.search),
    searchValue:string = urlFm.get("search"),
    card:  NodeListOf<Element> = document.querySelectorAll(".card") 
   

window.addEventListener("load", ()=>{
    searchText.innerText = `'${searchValue === null? "  ": searchValue }'`
})

card.forEach((e)=>{
    e.addEventListener("click", ()=>{
        const cookie = `movieId=${e.id}`
        document.cookie = cookie
    })
})