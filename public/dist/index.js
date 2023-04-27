const card = document.querySelectorAll(".card");
const urlIndex = new URLSearchParams(window.location.search);
const username = urlIndex.get("username");
const usernameH3 = document.querySelector("#usernameH3");
window.addEventListener("load", () => {
    // console.log(username)
    // if(localStorage.getItem("username")){
    //     JSON.stringify(localStorage.setItem("username", username))
    //     usernameH3.innerText = localStorage.getItem("username")
    // }else{
    //     usernameH3.innerText = username;
    //     JSON.stringify(localStorage.setItem("username", username))
    // }
});
card.forEach((e) => {
    e.addEventListener("click", () => {
        const cookie = `movieId=${e.id}`;
        document.cookie = cookie;
    });
});
export async function search(movieName) {
    const response = await fetch(`https://api.themoviedb.org/3/search/movie?api_key=b11c40b0b36c592e67882ea4a2da0100&query=${movieName}&language=pt-BR&page=1&include_adult=false`)
        .then((res) => res.json())
        .then((data) => console.log(data));
    return response;
}
