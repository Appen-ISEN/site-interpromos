function resizeContent(){
    document.getElementById("content").style["height"] = window.innerHeight + "px";
}

window.onresize = resizeContent;

resizeContent();

