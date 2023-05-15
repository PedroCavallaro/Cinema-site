const spanError: HTMLSpanElement = document.querySelector("#spanError")
const url: URLSearchParams = new URLSearchParams(window.location.search);
const already:string = url.get("already") 
const mainContainer: HTMLDivElement = document.querySelector(".mainContainer")


if(already === "1"){
    spanError.innerText = "Usuário já registrado"
    throw new Error("Usuário já existe")
}   
