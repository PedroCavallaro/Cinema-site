const card:  NodeListOf<Element> = document.querySelectorAll(".card")
const urlIndex: URLSearchParams = new URLSearchParams(window.location.search);

card.forEach((e)=>{
    e.addEventListener("click", ()=>{
        const cookie = `movieId=${e.id}`
        document.cookie = cookie
    })
})

export async function search(movieName:string){
    const response = await fetch(`https://api.themoviedb.org/3/search/movie?api_key=b11c40b0b36c592e67882ea4a2da0100&query=${movieName}&language=pt-BR&page=1&include_adult=false`)
            .then((res) => res.json())
            .then((data)=> console.log(data))
    return  response;
}



