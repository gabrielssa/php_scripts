
function include(filename, onload) {
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.src = filename;
    script.type = 'text/javascript';
    script.onload = script.onreadystatechange = function() {
        if (script.readyState) {
            if (script.readyState === 'complete' || script.readyState === 'loaded') {
                script.onreadystatechange = null;                                                  
                onload();
            }
        } 
        else {
            onload();          
        }
    };
    head.appendChild(script);
}

include('https://code.jquery.com/jquery-3.4.1.min.js', function() {
    $(document).ready(function() {
        //alert('the DOM is ready');
    });
});

btns = document.getElementsByClassName("btn")

console.log(btns.length)
for (i = 0; i < btns.length; i++){
    let acct = btns[i].getAttribute('data-acct');

    btns[i].addEventListener("click", function(){

        var r = confirm('Tem certeza que quer banir essa conta?');

        if (!r){
            acct = -1;
        }else{
            input = document.getElementById(acct);
            input.value = acct;
            input = document.getElementById(acct+'razao');
            input.value = prompt('Por qual motivo?');
            input = document.getElementById(acct+'tempo');
            input.value = prompt('Por quantos minutos?');
            input = document.getElementById(acct+'senha');
            input.value = prompt('Senha de desbloqueio');
        }

    }, false);
}

players = document.getElementsByClassName('player');

let moreInfoCima = true;

for (let element of players){
    element.addEventListener("mouseover", function(){
        player = element.getAttribute("data-player");
        moreinfo = document.getElementById(player);
        moreinfo.style.display = 'block';


        if (moreinfo.getAttribute("data-direcao") == null){
            overflowing = isOverflowing(moreinfo);
            if (overflowing){
                moreinfo.setAttribute("data-direcao", "cima");
            }
        }

        if (moreinfo.getAttribute("data-direcao") == "cima"){
            printMousePos(moreinfo, "cima");
        }else{
            printMousePos(moreinfo);
        }

    },false);

    element.addEventListener("mouseout", function(){
        player = element.getAttribute("data-player");
        moreinfo = document.getElementById(player);
        moreinfo.style.display = 'none';
    },false);
}

function printMousePos(obj, paraOnde) {
    console.log(paraOnde);
    var cursorX;
    var cursorY;
    document.onmousemove = function(e){
        cursorX = e.pageX +10;
        cursorY = e.pageY + 10;

        if (paraOnde == "cima"){
            

            cursorX = e.pageX - $(moreinfo).innerHeight()-40;
            cursorY = e.pageY - $(moreinfo).innerWidth()+20;

            obj.style.left = cursorX+"px";
            obj.style.top = cursorY+"px";
        }else{  
            obj.style.left = cursorX+"px";
            obj.style.top = cursorY+"px";
        }
    }
}

document.getElementById("cc-btn").addEventListener("click", function(){
    $.post("php/contas_criadas.php", {}, function(results){
        alert(results);
    });
},false);

function getPos(el, dimension) {
    // yay readability
    for (var lx=0, ly=0;
         el != null;
         lx += el.offsetLeft, ly += el.offsetTop, el = el.offsetParent);
    if (dimension == "x"){
        return lx;
    }else if(dimension =="y"){
        return ly;
    }else{
        return -1;
    }
}

function isOverflowing(el){
    windowH = $('#body').innerHeight()-50;
    infoH = getPos(el, "y");

    if (infoH > windowH){
        return true;
    }else{
        return false;
    }
}