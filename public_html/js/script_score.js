let phase = 1;

function resizeContent(){
    document.getElementById("content").style["height"] = window.innerHeight + "px";
}

window.onresize = resizeContent;

resizeContent();

let group_btn = document.getElementById("group-phase-button");
let bracket_btn = document.getElementById("bracket-phase-button");

if(group_btn != null && bracket_btn != null){
    group_btn.onclick = function() {
        if(phase == 1){
            return;
        }
        phase = 1;
        document.getElementById("poules").style.display = "flex";
        document.getElementById("bracket").style.display = "none";
        bracket_btn.setAttribute("class", "bgcolor-btnprimary color-main");
        group_btn.setAttribute("class", "color-main active");
    }
    
    bracket_btn.onclick = function() {
        if(phase == 2){
            return;
        }
        phase = 2;
        document.getElementById("poules").style.display = "none";
        document.getElementById("bracket").style.display = "flex";
        group_btn.setAttribute("class", "bgcolor-btnprimary color-main");
        bracket_btn.setAttribute("class", "color-main active");
    }
}

let group1_btn = document.getElementById("group1-button");
let group2_btn = document.getElementById("group2-button");
let final_btn = document.getElementById("final-button");

if(group1_btn != null && group2_btn != null && final_btn != null){
    document.getElementById("poules").style.display = "none";
    document.getElementById("bracket-16-1").style.display = "flex";
    group1_btn.onclick = function() {
        if(phase == 1){
            return;
        }
        phase = 1;
        document.getElementById("bracket-16-1").style.display = "flex";
        document.getElementById("bracket-16-2").style.display = "none";
        document.getElementById("bracket-finals").style.display = "none";
        group1_btn.setAttribute("class", "bgcolor-btnprimary color-main active");
        group2_btn.setAttribute("class", "bgcolor-btnprimary color-main");
        final_btn.setAttribute("class", "bgcolor-btnprimary color-main");
    }
    
    group2_btn.onclick = function() {
        if(phase == 2){
            return;
        }
        phase = 2;
        document.getElementById("bracket-16-1").style.display = "none";
        document.getElementById("bracket-16-2").style.display = "flex";
        document.getElementById("bracket-finals").style.display = "none";
        group1_btn.setAttribute("class", "bgcolor-btnprimary color-main");
        group2_btn.setAttribute("class", "bgcolor-btnprimary color-main active");
        final_btn.setAttribute("class", "bgcolor-btnprimary color-main");
    }

    final_btn.onclick = function() {
        if(phase == 3){
            return;
        }
        phase = 3;
        document.getElementById("bracket-16-1").style.display = "none";
        document.getElementById("bracket-16-2").style.display = "none";
        document.getElementById("bracket-finals").style.display = "flex";
        group1_btn.setAttribute("class", "bgcolor-btnprimary color-main");
        group2_btn.setAttribute("class", "bgcolor-btnprimary color-main");
        final_btn.setAttribute("class", "bgcolor-btnprimary color-main active");
    }
}



