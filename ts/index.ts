const card:  NodeListOf<Element> = document.querySelectorAll(".card")
const urlIndex: URLSearchParams = new URLSearchParams(window.location.search);
const username:string = urlIndex.get("username") 
const usernameH3: HTMLTitleElement = document.querySelector("#usernameH3")



window.addEventListener("load", ()=>{
    if(localStorage.getItem("username")){
        usernameH3.innerText = localStorage.getItem("username")
    }else{
        usernameH3.innerText = username;
        JSON.stringify(localStorage.setItem("username",username))
    }
})
card.forEach((e)=>{
    e.addEventListener("click", ()=>{
        const cookie = `movieId=${e.id}`
        document.cookie = cookie
    })
})



