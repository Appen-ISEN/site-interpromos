window.IsDark = 0;

function switchDarkMode() {
    document.body.classList.toggle("LightMode");
    if (window.IsDark == 0) {
        var menus = document.getElementsByClassName('menu');
        for(let i = 0; i < menus.length; i++){
            menus[i].style.backgroundColor = 'rgb(211, 211, 211)';
        }
        var Choices = document.querySelectorAll('.menu a');
        Choices.forEach(choice => {
            choice.style.color = 'rgb(14, 14, 14)';
        });
        var bgcolor_main = document.getElementsByClassName("bgcolor-main");
        for(let i = 0; i < bgcolor_main.length; i++){
            bgcolor_main[i].style.backgroundColor = 'rgb(240, 240, 240)';
        }
        window.IsDark = 1;
    } else {
        var menus = document.getElementsByClassName('menu');
        for(let i = 0; i < menus.length; i++){
            menus[i].style.backgroundColor = 'rgb(43, 43, 43)';
        }
        var Choices = document.querySelectorAll('.menu a');
        Choices.forEach(choice => {
            choice.style.color = 'rgb(193, 193, 193)';
        });
        var bgcolor_main = document.getElementsByClassName("bgcolor-main");
        for(let i = 0; i < bgcolor_main.length; i++){
            bgcolor_main[i].style.backgroundColor = 'rgb(37, 37, 37)';
        }
        window.IsDark = 0;
    }
}
