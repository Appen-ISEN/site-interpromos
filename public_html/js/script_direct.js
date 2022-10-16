function getDirect() {
    $.ajax({
        method: "GET",
        url: "api.php/matchs"
    }).done((matchs) => {
        aspect(matchs)
    })
}

function aspect(matchs) {
    matchs.forEach(match => {
        //show next matches with a gap of 15 min
        if(Date.parse(match['date']) > Date.now() && Date.parse(match['date']) < (Date.now() + 900000)){
            let tname = JSON.parse(match['teams_name'])

            let cap = "<div class=\"capsule\">"+
            "<div class=\"capTeam\">"+
            "<h3>"+ tname[0] +"</h3></div>"+
            "<div class=\"capTeam\">"+
            "<h3>"+ tname[1] +"</h3></div>"+
            match['sport_name'] +"</div>";

            $("#nextMatch").append(cap);
        }
        //show direct match with a gap of 15 min
        if(Date.parse(match['date']) < Date.now() && Date.parse(match['date']) > (Date.now() - 900000)){
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

getDirect()
setInterval(getDirect, 300000);