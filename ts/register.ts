const url: URLSearchParams = new URLSearchParams(window.location.search);
const already:string = url.get("already") 
const spanError: HTMLSpanElement = document.querySelector("#spanError")
const mainContainer: HTMLDivElement = document.querySelector(".mainContainer")

if(already === "1"){
    spanError.innerText = "Usuário já registrado"
}
