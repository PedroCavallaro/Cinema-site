import {tmbdApiResponse} from "./interfaces.js"

type movieInfoObj = Pick<tmbdApiResponse, "title" | "overview" | "runtime" | "release_date" | "poster_path"> 

const searchButton:HTMLInputElement = document.querySelector("#search"),
    searchMovie:HTMLInputElement =document.querySelector("#searchMovie"),
    list: HTMLDivElement = document.querySelector("#list"),
    movieInfoArr:any = document.querySelectorAll(".info"),
    fileImg:HTMLInputElement = document.querySelector("#fileImg")
let foundMovies

const ul:HTMLUListElement = document.createElement("ul")


searchMovie.addEventListener("keyup", async ()=>{
    list.innerHTML = ""
    const foundMovies = await search(searchMovie.value)
   
    let results

     ({results} = foundMovies)
   
    
    ul.innerHTML = ""
    for (let i = 0; i < 7; i++) {
        const img = document.createElement("img")
        const li: HTMLLIElement = document.createElement("li")
        const h3: HTMLHeadElement = document.createElement("h3")
        
        img.src = `https://image.tmdb.org/t/p/original${results[i].poster_path}`
        h3.innerText = results[i].title
        li.append(img, h3)
        ul.appendChild(li)
       
        li.addEventListener("click", async ()=>{

            const details: tmbdApiResponse = await getDetails(results[i].id)
            
            const movie: movieInfoObj = {
                title: details.title,
                overview: details.overview,
                poster_path:`https://image.tmdb.org/t/p/original${results[i].poster_path}`,
                runtime: details.runtime,
                release_date: details.release_date
            }
        
            movieInfoArr[0].src = movie.poster_path
            movieInfoArr[1].value = movie.title
            movieInfoArr[2].value = movie.runtime  
            movieInfoArr[3].textContent = movie.overview 
            movieInfoArr[4].value = movie.release_date 
            fileImg.value = movie.poster_path;  
            list.classList.remove("show")
            ul.innerHTML = ""
        })
    }
    list.appendChild(ul)
    list.classList.add("show")

})


async function search(movieName:string) {
    const response = await fetch(`https://api.themoviedb.org/3/search/movie?api_key=b11c40b0b36c592e67882ea4a2da0100&query=${movieName}&language=pt-BR&include_adult=false`)
        .then((res) => res.json())
   
    return response;
}

async function getDetails(id){
    const response = await fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=b11c40b0b36c592e67882ea4a2da0100&language=pt-BR`)
                    .then((res) => res.json())
    return response
}
//b11c40b0b36c592e67882ea4a2da0100
//https://api.themoviedb.org/3/search/movie?api_key=b11c40b0b36c592e67882ea4a2da0100&query=${movieName}&language=pt-BR&page=1&include_adult=false
//https://api.themoviedb.org/3/genre/movie/list?api_key=b11c40b0b36c592e67882ea4a2da0100&language=pt-BR