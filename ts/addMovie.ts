

type movieInfoArr = {
    name: string,
    overview: string,
    imgPath: string
}
const searchButton:HTMLInputElement = document.querySelector("#search"),
    searchMovie:HTMLInputElement =document.querySelector("#searchMovie"),
    list: HTMLDivElement = document.querySelector("#list"),
    movieInfoArr:any = document.querySelectorAll(".info")
let foundMovies




searchMovie.addEventListener("keyup", async ()=>{
    list.innerHTML = ""
    foundMovies = await search(searchMovie.value)
    let results

     ({results} = foundMovies)
   
    const ul:HTMLUListElement = document.createElement("ul")
    for (let i = 0; i < 7; i++) {
        const img = document.createElement("img")
        const li: HTMLLIElement = document.createElement("li")
        const h3: HTMLHeadElement = document.createElement("h3")
        
        img.src = `https://image.tmdb.org/t/p/original${results[i].poster_path}`

        h3.innerText = results[i].title
        li.append(img, h3)
        ul.appendChild(li)
        
        li.addEventListener("click", ()=>{
            
            const movie: movieInfoArr = {
                name: results[i].title,
                overview: results[i].overview,
                imgPath:`https://image.tmdb.org/t/p/original${results[i].poster_path}`
            }
        
            console.log(results[i])
            movieInfoArr[0].src = movie.imgPath
            movieInfoArr[1].value = movie.name
            movieInfoArr[2].textContent = movie.overview     
            list.classList.remove("show")
        })
    }
    list.appendChild(ul)
    list.classList.add("show")
})


async function search(movieName) {
    const response = await fetch(`https://api.themoviedb.org/3/search/movie?api_key=b11c40b0b36c592e67882ea4a2da0100&query=${movieName}&language=pt-BR&page=1&include_adult=false`)
        .then((res) => res.json());
    return response;
}