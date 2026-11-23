function ushqyerja(){
    alert("Vizitorët mund të ushqejnë kafshët, por jo qenët.");
}

function rërë(){
    alert("Vizitorët mund të luajnë ne fushën me rërë.");
}

function shtëpia(){
    var answer = confirm("Dëshironi të mësoni më shumë për shtëpinë në pemë?");
    if(answer){
        alert("Shtëpia në pemë është tek livadhi prapa shankut, aty fëmijët mund shikojnë pamjen e natyrës dhe te argëtohen në luhatëse.");
    }
}

function këndi(){
    var answer = confirm("Dëshironi të mësoni më shumë për këndin e aventurave?");
    if(answer){
        alert("Këndi i aventurave është vendi ku argëtohen fëmijët med lojrat që i jepin kujtime të pa harrushme.");
    }
}

function hiking(){
    var answer = confirm("Dëshironi të mësoni më shumë për hikingun në natyrë?");
    if(answer){
        alert("Hikingu fillon tek livadhi prapa shankut dhe zhvillohet tek pylli afër fermës i shoqëruar me qenët e fermës dhe zgjatë 45 minuta deri në 1 orë.");
    }
}

function pony(){
    var answer = confirm("Dëshironi të mësoni më shumë për kalërimin me poni?");
    if(answer){
        alert("Kalërimi me poni është një aktivitet argëtues për fëmijë, ku fëmijëve u ipet mundësia për të kalëruar me poni me mbikqyerjen e stafit, ky aktivitet është tek livadhi prapa shanku.");
    }
}

function kampi(){
    var answer = confirm("Dëshironi të mësoni më shumë për kampin veror?");
    if(answer){
        alert("Kampi veror 2026, java e parë 6-10 Korrik 6-14 vjeq, java e dytë 13-17 Korrik 6-14 vjeq, kampingu me fjetje në tenta 3-5 Gusht 8-14 vjeq, në kampin veror realizohen aktivitete të shumta me kafshët dhe natyrën që janë momente të pa harrueshme për fëmijët.");
    }
}

function gara(){
    var answer = confirm("Dëshironi të mësoni më shumë për garën breshka me lepurin?");
    if(answer){
        alert("Merrni pjesë në garën argëtuese me breshka dhe lepuj, një aktivitet unik që sjell buzëqeshje dhe emocion për fëmijët dhe të rriturit.");
    }
}

var images = document.querySelectorAll(".imganimal");
var overlay2 = document.getElementById("overlay2");
var overlayImg = document.getElementById("overlayImg");

if (overlay2 && overlayImg) {
    for (var i = 0; i < images.length; i++) {
        images[i].addEventListener("click", function () {
            overlay2.style.display = "flex";
            overlayImg.src = this.src;
            
            var albumi = document.querySelector(".albumi");
            if (albumi) albumi.style.filter = "blur(3px)";
        });
    }

    overlay2.addEventListener("click", function () {
        overlay2.style.display = "none";
        var albumi = document.querySelector(".albumi");
        if (albumi) albumi.style.filter = "none";
    });
}

function swap(img) {
    if (img.src.includes("krisi.jpg")) {
        img.src = "img/kafshet/choko.jpg";
    } 
    else if (img.src.includes("choko.jpg")) {
        img.src = "img/kafshet/lulu.jpg";
    } 
    else if (img.src.includes("lulu.jpg")) {
        img.src = "img/kafshet/polari.jpg";
    }
    else {
        img.src = "img/kafshet/krisi.jpg";
    }
}

function swap2(img) {
    if (img.src.includes("mr%20heckles.jpg") || img.src.includes("mr heckles.jpg")) {
        img.src = "img/kafshet/papagalli.jpg";
    }
    else if (img.src.includes("papagalli.jpg")) {
        img.src = "img/kafshet/fllanza.jpg";
    }
    else if (img.src.includes("fllanza.jpg") || img.src.includes("pauna 2.jpg")) {
        img.src = "img/kafshet/pauna.jpg";
    }
    else if (img.src.includes("pauna.jpg")) {
        img.src = "img/kafshet/pauna 2.jpg";
    }
    else if (img.src.includes("pauna 2.jpg") || img.src.includes("pauna 2.jpg")) {
        img.src = "img/kafshet/fazan.jpg";
    }
    else {
        img.src = "img/kafshet/mr heckles.jpg";
    }
}

function swap3(img) {
    if (img.src.includes("lepur.jpg")) {
        img.src = "img/kafshet/breshka.jpg";
    }
    else {
        img.src = "img/kafshet/lepur.jpg";
    }
}

function updateFarmStatus() {
    var statusBadge = document.getElementById("status-badge");
    if (!statusBadge) return;

    var currentHour = new Date().getHours();

    if (currentHour >= 12 && currentHour < 20) {
        statusBadge.innerHTML = "● Hapur tani (12:00 - 20:00)";
        statusBadge.style.color = "#4CAF50"; 
    } else {
        statusBadge.innerHTML = "○ Mbyllur tani (Hapet në 12:00)";
        statusBadge.style.color = "#f44336"; 
    }
}

updateFarmStatus();