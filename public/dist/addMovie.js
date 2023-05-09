import { search } from "./index.js";
const searchButton = document.querySelector("#search"), searchMovie = document.querySelector("#searchMovie"), list = document.querySelector("#list"), info = document.querySelectorAll(".info");
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
        li.addEventListener("click", () => {
            const movie = {
                name: results[i].title,
                overview: results[i].overview,
                imgPath: `https://image.tmdb.org/t/p/original${results[i].poster_path}`
            };
            console.log(results[i]);
            info[0].src = movie.imgPath;
            info[1].value = movie.name;
            info[2].textContent = movie.overview;
            list.classList.remove("show");
        });
    }
    list.appendChild(ul);
    list.classList.add("show");
});
