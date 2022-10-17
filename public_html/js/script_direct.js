function parseISOLocal(s) {
    var b = s.split(/\D/);
    return new Date(b[0], b[1], b[2], b[3]+2, b[4], b[5]);
}

function getDirect() {
    $.ajax({
        method: "GET",
        url: "api.php/matchs"
    }).done((matchs) => {
        aspect(matchs)
    })
}

function aspect(matchs) {
    $("#nextMatch").empty()
    $("#nowMatch").empty()

    matchs.forEach(match => {
        let date = new Date(match['date']);
        //show next matches with a gap of 20 min
        if(date > (Date.now() - 1200000) /*&& date < (Date.now() + 1200000)*/){
            let tname = JSON.parse(match['teams_name'])

            let cap = "<div class=\"capsule\">"+
            "<div class=\"capTeam\">"+
            "<h3>"+ tname[0] +"</h3></div>"+
            "<div class=\"capTeam\">"+
            "<h3>"+ tname[1] +"</h3></div>"+
            match['sport_name'] +"</div>";

            $("#nextMatch").append(cap);
        }
        //show direct match with a gap of 20 min 
        if(date < (Date.now() - 1200000) && date > ((Date.now() - 1200000) - 1800000)){
            let tname = JSON.parse(match['teams_name'])
            let tscore = JSON.parse(match['scores'])

            let cap = "<div class=\"capsule\">"+
            "<div class=\"capTeam\">"+
            "<h3>"+ tname[0] +"</h3>"+
            "<h4>"+ tscore[0] + "</h4></div>"+
            "<div class=\"capTeam\">"+
            "<h3>"+ tname[1] +"</h3>"+
            "<h4>"+ tscore[1] +"</h4></div>"+
            match['sport_name'] +"</div>";

            $("#nowMatch").append(cap);
        }
    });
}

getDirect();
setInterval(getDirect, 5000 );