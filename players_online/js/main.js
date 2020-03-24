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
        }

    }, false);
}

