const delet:any = document.querySelectorAll(".delete"),
    formModal:HTMLFormElement = document.querySelector(".modal > form"),
    yesButton = document.querySelector(".yesButton"),
    modalContainer:HTMLDivElement = document.querySelector(".modal-container"),
    modal:HTMLDivElement = document.querySelector(".modal"),
    closeModal = document.querySelectorAll(".close"),
    updateButton = document.querySelectorAll(".updateButton"),
    imgList:any = document.querySelectorAll(".imgList"),
    delButton: HTMLInputElement = document.querySelector("#delButton"),
    delForm:HTMLFormElement = document.querySelector("#delForm")

delet.forEach((e: any)=>{
    e.addEventListener("click", ()=>{
        modalContainer.classList.add("show")
        modal.classList.add("show")
        yesButton.addEventListener("click", ()=>{
                formModal.classList.add("show")  
        })
        delButton.addEventListener("click", ()=>{
            delForm.action = "../src/delete.php?"+ e.dataset.href
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

