const data = treatData(JSON.parse(localStorage.getItem("info"))), infoToset = document.querySelectorAll(".info"), moviePosterP = document.querySelector(".moviePoster"), request = JSON.parse(localStorage.getItem("request")), finalValue = document.querySelector("#finalValue"), itensList = document.querySelector(".itensList"), methodButton = document.querySelectorAll(".methodButton"), imgMethod = document.querySelectorAll(".imgMethod"), endButton = document.querySelector(".endButton"), paymentInfo = document.querySelector(".paymentInfo");
const popUp = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});
var methods;
(function (methods) {
    methods[methods["PIX"] = 1] = "PIX";
    methods[methods["crediCard"] = 2] = "crediCard";
    methods[methods["debitCard"] = 3] = "debitCard";
})(methods || (methods = {}));
window.addEventListener("load", () => {
    renderItens(itensList, request.itens);
    moviePosterP.src = data[0];
    for (let i = 1; i < data.length; i++) {
        infoToset[i].innerHTML = data[i];
    }
    finalValue.innerText = request.total;
});
methodButton.forEach((e) => {
    e.addEventListener("click", () => {
        const parent = e.parentElement;
        document.querySelectorAll('.imgMethod').forEach((e) => {
            e.style.filter = "";
        });
        switch (Number(e.id)) {
            case methods.PIX:
                pix(paymentInfo);
                break;
            case methods.crediCard:
                cards(paymentInfo);
                validateForm();
                const cardNumber = document.querySelectorAll(".infoInput");
                cardNumber[2].addEventListener("keyup", (e) => {
                    if (isNaN(e.target.value) || e.target.value === "") {
                        e.target.style.animation = "shake 1s infinite";
                        e.target.style.outlineColor = "red";
                    }
                    else {
                        e.target.style.animation = "";
                        e.target.style.outlineColor = "green";
                    }
                });
                break;
            case methods.debitCard:
                cards(paymentInfo);
                validateForm();
                break;
        }
        parent.children[1].style.filter = "contrast(5%)";
    });
});
function treatData(lsInfo) {
    const duration = lsInfo[2].split(" ");
    const gender = lsInfo[3].split(":");
    const time = lsInfo[5].split(":");
    lsInfo[2] = duration[1] + " min";
    lsInfo[3] = gender[1];
    lsInfo[5] = time[1] + ":" + time[2];
    lsInfo[6] = lsInfo[6].join("");
    return lsInfo;
}
function renderItens(parentElement, list) {
    list.forEach((e) => {
        const td1 = document.createElement("td");
        const td2 = document.createElement("td");
        const tr = document.createElement("tr");
        td1.innerText = e.qtd + "x";
        td2.innerHTML = e.name;
        tr.append(td1, td2);
        parentElement.append(tr);
    });
}
endButton.addEventListener("click", (e) => {
    if (document.querySelector("input[type='radio']:checked") === null) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            text: 'Seleciona um método de pagamento',
            background: "#6b2929",
            color: "white",
            confirmButtonColor: "black"
        });
    }
    else {
        const radio = document.querySelector("input[type='radio']:checked");
    }
});
function pix(mainDiv) {
    mainDiv.innerHTML = "";
    const div = document.createElement("div");
    const img = document.createElement("img");
    const h3 = document.createElement("h3");
    div.classList.toggle("paymentInfo");
    h3.innerText = "QR code";
    div.append(h3, img);
    img.src = "./img/qrCode.png";
    mainDiv.append(div);
}
function cards(mainDiv) {
    mainDiv.innerHTML = "";
    const arrLabels = ["Nome no cartão", "Numero do cartão"];
    const button = document.createElement("input");
    button.type = "button";
    button.id = "confirmButton";
    button.value = "Confirmar";
    const arrLabels2 = ["CVV", "Vencimento"];
    for (let i = 0; i < arrLabels.length; i++) {
        const label = createEle("label");
        const label2 = createEle("label");
        const input = createEle("input");
        const input2 = createEle("input");
        const div = createEle("div");
        const br = document.createElement("br");
        const divChild = createEle("div");
        const divChild2 = createEle("div");
        input.classList.toggle("nameInput");
        input.classList.toggle("infoInput");
        input2.classList.toggle("numberInput");
        input2.classList.toggle("infoInput");
        div.classList.toggle("paymentCard");
        label.innerText = arrLabels[i];
        label2.innerText = arrLabels2[i];
        divChild.append(label, createEle("br"), input, createEle("br"));
        divChild2.append(label2, createEle("br"), input2);
        div.append(divChild, divChild2);
        mainDiv.append(div);
    }
    mainDiv.append(button);
}
function createEle(element) {
    return document.createElement(element);
}
function validateForm() {
    document.querySelector("#confirmButton")
        .addEventListener("click", (e) => {
        const info = document.querySelectorAll(".infoInput");
        info.forEach((e) => {
            if (!(e.value)) {
                popUp.fire({
                    icon: "error",
                    title: "Preencha os campos",
                    background: "black"
                });
            }
            else {
                popUp.fire({
                    icon: "success",
                    title: "Dados cadastrados",
                    background: "black"
                });
            }
        });
    });
}
function validateCardNumber(e) {
}
