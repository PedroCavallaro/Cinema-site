const searchButton = document.querySelector("#search"), searchMovie = document.querySelector("#searchMovie"), list = document.querySelector("#list"), movieInfoArr = document.querySelectorAll(".info"), fileImg = document.querySelector("#fileImg");
let foundMovies;
searchMovie.addEventListener("keyup", async () => {
    list.innerHTML = "";
    foundMovies = await search(searchMovie.value);
    let results;
    ({ results } = foundMovies);
    const ul = document.createElement("ul");
    for (let i = 0; i < 7; i++) {
        const img = document.createElement("img");
        const li = document.createElement("li");
        const h3 = document.createElement("h3");
        img.src = `https://image.tmdb.org/t/p/original${results[i].poster_path}`;
        h3.innerText = results[i].title;
        li.append(img, h3);
        ul.appendChild(li);
        li.addEventListener("click", async () => {
            const details = await getDetails(results[i].id);
            console.log(details);
            const movie = {
                name: details.title,
                overview: details.overview,
                imgPath: `https://image.tmdb.org/t/p/original${results[i].poster_path}`,
                runtime: details.runtime,
                release_date: details.release_date
            };
            movieInfoArr[0].src = movie.imgPath;
            movieInfoArr[1].value = movie.name;
            movieInfoArr[2].value = movie.runtime;
            movieInfoArr[3].textContent = movie.overview;
            movieInfoArr[4].value = movie.release_date;
            fileImg.value = movie.imgPath;
            list.classList.remove("show");
        });
    }
    list.appendChild(ul);
    list.classList.add("show");
});
async function search(movieName) {
    const response = await fetch(`https://api.themoviedb.org/3/search/movie?api_key=b11c40b0b36c592e67882ea4a2da0100&query=${movieName}&language=pt-BR&include_adult=false`)
        .then((res) => res.json());
    return response;
}
async function getDetails(id) {
    const response = await fetch(`https://api.themoviedb.org/3/movie/${id}?api_key=b11c40b0b36c592e67882ea4a2da0100&language=pt-BR`)
        .then((res) => res.json());
    return response;
}
//b11c40b0b36c592e67882ea4a2da0100
//https://api.themoviedb.org/3/search/movie?api_key=b11c40b0b36c592e67882ea4a2da0100&query=${movieName}&language=pt-BR&page=1&include_adult=false
//https://api.themoviedb.org/3/genre/movie/list?api_key=b11c40b0b36c592e67882ea4a2da0100&language=pt-BR
