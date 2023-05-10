const card:  NodeListOf<Element> = document.querySelectorAll(".card")
const urlIndex: URLSearchParams = new URLSearchParams(window.location.search);
const searchButton: HTMLButtonElement = document.querySelector("#searchButton") 
const searchInput:HTMLInputElement = document.querySelector("#searchInput")
<<<<<<< HEAD
const movies:HTMLDivElement = document.querySelector(".movies")
let c: number = 0
let test:boolean = false
=======
>>>>>>> cea9c150b8905e9286bf56f41e404fada529fffb

card.forEach((e)=>{
    e.addEventListener("click", ()=>{
        const cookie = `movieId=${e.id}`
        document.cookie = cookie
    })
})



const movieCarrousel = setInterval(()=>{
    c+=20
    movies.style.transform = `translate(-${c}%)`   
    movies.style.transition = "1.5s"
    if(movies.style.transform === "translate(-100%)"){
        c = 0
        movies.style.transform = ``   
        movies.style.transition = "1.5s"
    }
},1 * 3000)

movies.addEventListener("click", ()=>{
    c = 0
    clearInterval(movieCarrousel)
})
window.addEventListener('mousedown', (e)=>{
   
    if(e.clientX > (window.innerWidth / 2)){
            c+=20
            movies.style.transform = `translate(-${c}%)`   
            movies.style.transition = "1.5s"

            if(movies.style.transform === "translate(-100%)"){
                c = 0 
                movies.style.transform = ``
                movies.style.transition = "1.5s"
            }
        }
    if(e.clientX <  (window.innerWidth / 2) ){ 
            c = 0 
            movies.style.transform = ``
            movies.style.transition = "1.5s"
        }
    
})


export async function search(movieName:string){ 
    const response = await fetch(`https://api.themoviedb.org/3/search/movie?api_key=b11c40b0b36c592e67882ea4a2da0100&query=${movieName}&language=pt-BR&page=1&include_adult=false`)
            .then((res) => res.json())
    return response;
}




