let phase = 1;

function resizeContent(){
    document.getElementById("content").style["height"] = window.innerHeight + "px";
}

window.onresize = resizeContent;

resizeContent();

let group_btn = document.getElementById("group-phase-button");
let bracket_btn = document.getElementById("bracket-phase-button");

group_btn.onclick = function() {
    if(phase == 1){
        return;
    }
    phase = 1;
    document.getElementById("poules").style.display = "flex";
    document.getElementById("bracket").style.display = "none";
    bracket_btn.removeAttribute("class");
    group_btn.setAttribute("class", "active");
}

bracket_btn.onclick = function() {
    if(phase == 2){
        return;
    }
    phase = 2;
    document.getElementById("poules").style.display = "none";
    document.getElementById("bracket").style.display = "flex";
    group_btn.removeAttribute("class");
    bracket_btn.setAttribute("class", "active");
}

