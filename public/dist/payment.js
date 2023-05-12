const data = treatData(JSON.parse(localStorage.getItem("info"))), infoToset = document.querySelectorAll(".info"), moviePosterP = document.querySelector(".moviePoster");
window.addEventListener("load", () => {
    console.log(data);
    moviePosterP.src = data[0];
    for (let i = 1; i < data.length; i++) {
        infoToset[i].innerHTML = data[i];
    }
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
