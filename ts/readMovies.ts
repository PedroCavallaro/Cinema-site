const delet = document.querySelectorAll(".delete"),
formModal:HTMLFormElement = document.querySelector(".modal > form"),
yesButton = document.querySelector(".yesButton"),
modalContainer:HTMLDivElement = document.querySelector(".modal-container"),
modal:HTMLDivElement = document.querySelector(".modal"),
closeModal = document.querySelectorAll(".close"),
updateButton = document.querySelectorAll(".updateButton"),
imgList:any = document.querySelectorAll(".imgList")

let count:number = 0


delet.forEach((e)=>{
    e.addEventListener("click", ()=>{
        modalContainer.classList.add("show")
        modal.classList.add("show")
        yesButton.addEventListener("click", ()=>{
                formModal.classList.add("show")  
        })
    })

})



updateButton.forEach((e)=>{
    e.addEventListener("click", ()=>{
        const td = e.parentElement
        const tr = td.parentElement
        const tdChild = tr.children[0]
        const img:any = tdChild.children[0]
        localStorage.setItem("imgPath", JSON.stringify(img.src))
    })
})

closeModal.forEach((e)=>{
    e.addEventListener("click", ()=>{
            modalContainer.classList.remove("show")
            modal.classList.remove("show")
    })
})