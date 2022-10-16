window.IsDark = 0;

function switchDarkMode() {
    document.body.classList.toggle("LightMode");

    // all elem to switch mode
    var color_main = document.getElementsByClassName("color-main");

    var bgcolor_main = document.getElementsByClassName("bgcolor-main");
    var bgcolor_btnprimary = document.getElementsByClassName("bgcolor-btnprimary");
    var bgcolor_tableprimary = document.getElementsByClassName("bgcolor-tableprimary");
    var bgcolor_tablesecondary = document.getElementsByClassName("bgcolor-tablesecondary");

    var bordercolor_main = document.getElementsByClassName("bordercolor-main");

    if (window.IsDark == 0) {
        var menus = document.getElementsByClassName('menu');
        for(let i = 0; i < menus.length; i++){
            menus[i].style.backgroundColor = 'rgb(211, 211, 211)';
        }
        var Choices = document.querySelectorAll('.menu a');
        Choices.forEach(choice => {
            choice.style.color = 'rgb(14, 14, 14)';
        });

        for(let i = 0; i < color_main.length; i++){
            color_main[i].style.color = 'rgb(0, 0, 0)';
        }
        
        for(let i = 0; i < bgcolor_main.length; i++){
            bgcolor_main[i].style.backgroundColor = 'rgb(240, 240, 240)';
        }
        for(let i = 0; i < bgcolor_btnprimary.length; i++){
            bgcolor_btnprimary[i].style.backgroundColor = 'rgb(212, 212, 212)';
        }
        for(let i = 0; i < bgcolor_tableprimary.length; i++){
            bgcolor_tableprimary[i].style.backgroundColor = 'rgb(190, 190, 190)';
        }
        for(let i = 0; i < bgcolor_tablesecondary.length; i++){
            bgcolor_tablesecondary[i].style.backgroundColor = 'rgb(210, 210, 210)';
        }
        for(let i = 0; i < bgcolor_tablesecondary.length; i++){
            bgcolor_tablesecondary[i].style.backgroundColor = 'rgb(210, 210, 210)';
        }

        for(let i = 0; i < bordercolor_main.length; i++){
            bordercolor_main[i].style["border"] = '1px solid black';
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

        for(let i = 0; i < color_main.length; i++){
            color_main[i].style.color = 'rgb(255, 255, 255)';
        }
        
        for(let i = 0; i < bgcolor_main.length; i++){
            bgcolor_main[i].style.backgroundColor = 'rgb(37, 37, 37)';
        }
        
        for(let i = 0; i < bgcolor_btnprimary.length; i++){
            bgcolor_btnprimary[i].style.backgroundColor = 'rgb(43, 43, 43)';
        }
        for(let i = 0; i < bgcolor_tableprimary.length; i++){
            bgcolor_tableprimary[i].style.backgroundColor = 'rgb(60, 60, 60)';
        }
        for(let i = 0; i < bgcolor_tablesecondary.length; i++){
            bgcolor_tablesecondary[i].style.backgroundColor = 'rgb(45, 45, 45)';
        }

        for(let i = 0; i < bordercolor_main.length; i++){
            bordercolor_main[i].style["border"] = '1px solid white';
        }

        window.IsDark = 0;
    }
}
