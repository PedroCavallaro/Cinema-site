const tempImg: HTMLImageElement = document.querySelector("#tempImg"),
    imgPath = JSON.parse(localStorage.getItem("imgPath"))


window.addEventListener("load", ()=>{
        tempImg.src = imgPath
})