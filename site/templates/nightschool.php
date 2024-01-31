<?php snippet('header') ?>

<script>
    let string_dylan =
        "let me say this about Justine — she was 5 ft 2 & had Hungarian eyes — her belief was that if she could make it with Bo Diddley— she could get herself straight— now Ruthy— she was different— she always wanted to see a cock fight & went to Mexico City when she was 17 & a runaway castoff— she met Zonk when she was 18— Zonk came from her home town— at least that 's what he said when he met her — when they busted up, he said he never heard of the place but that 's beside the point—anyway these three—they make up the Realm Crew...i met them exactly at their table & they took 2 years of sanction from me but i never talk much about it myself— Justine was always trying to prove she existed as if she really needed proof— Ruthy— she was always trying to prove that Bo Diddley existed & Zonk he was trying to prove that he existed just for Ruthy but later on said that he was just trying to prove he existed to himself— me ? i started wondering about whether anybody existed but i never pushed it too much— especially when Zonk was around— Zonk hated himself & when he got too high he thought everybody was a mirror";


    function pathOnDiv(text, pos) {
        // Get the coordinates of the point that is the fraction 'pos' along the path
        var path = document.getElementById("mypath");
        var pathLength = path.getTotalLength();
        var loc = path.getPointAtLength(pos * pathLength);




        // Make a div
        var div = document.createElement("div");
        div.textContent = text;
        div.setAttribute("class", "pathDiv");
        div.style.left = loc.x + "px";
        div.style.top = loc.y + "px";
        div.style.position = "absolute";
        document.body.appendChild(div);
    }
    var slider = document.getElementById("slider");


    function moveSlider() {
        let sliderVal = slider.value / 100;
        console.log(sliderVal)
        pathOnDiv(sliderVal, 0.1);
    }
    var path = document.getElementById("mypath");

    console.log(path.getTotalLength());

    for (var i = 0; i < 500; i++) {
        let sliderVal = i / 500;
        var pathLength = path.getTotalLength();
        console.log(sliderVal)

        pathOnDiv(string_dylan.charAt(i), sliderVal);
        var pathLength = path.getTotalLength();

    }
</script>
<?php snippet('footer') ?>