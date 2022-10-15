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
        window.IsDark = 0;
    }
}