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

for (let element of players){
    element.addEventListener("mouseover", function(){
        player = element.getAttribute("data-player");
        moreinfo = document.getElementById(player);
        moreinfo.style.display = 'block';
        printMousePos(moreinfo);
    },false);

    element.addEventListener("mouseout", function(){
        player = element.getAttribute("data-player");
        moreinfo = document.getElementById(player);
        moreinfo.style.display = 'none';
    },false);
}

function printMousePos(obj) {
    var cursorX;
    var cursorY;
    document.onmousemove = function(e){
        cursorX = e.pageX +10;
        cursorY = e.pageY + 10;
        obj.style.left = cursorX+"px";
        obj.style.top = cursorY+"px";
    }
}

document.getElementById("cc-btn").addEventListener("click", function(){
    $.post("php/contas_criadas.php", {}, function(results){
        alert(results);
    });
},false);