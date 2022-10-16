window.IsDark = 0;

function switchDarkMode() {

    var r = document.querySelector(':root');

    if (window.IsDark == 0) {

        r.style.setProperty('--color-main', "rgb(0, 0, 0)");
        r.style.setProperty('--bgcolor-main', "rgb(240, 240, 240)");
        r.style.setProperty('--bgcolor-btnprimary', "rgb(212, 212, 212)");
        r.style.setProperty('--bgcolor-tableprimary', "rgb(190, 190, 190)");
        r.style.setProperty('--bgcolor-tablesecondary', "rgb(210, 210, 210)");

        window.IsDark = 1;
    } else {

        r.style.setProperty('--color-main', "rgb(255, 255, 255)");
        r.style.setProperty('--bgcolor-main', "rgb(37, 37, 37)");
        r.style.setProperty('--bgcolor-btnprimary', "rgb(43, 43, 43)");
        r.style.setProperty('--bgcolor-tableprimary', "rgb(60, 60, 60)");
        r.style.setProperty('--bgcolor-tablesecondary', "rgb(45, 45, 45)");

        window.IsDark = 0;
    }
}
