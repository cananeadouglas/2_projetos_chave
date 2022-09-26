function teste() {

    var saindo = window.document.getElementById('saindo')
    let infor = window.document.getElementsByName('vem')

    saindo.addEventListener('mouseenter', entrar)
    saindo.addEventListener('mouseout', sair)

    function entrar(){
        saindo.style.background = '#FFDAB9';
    }
    function sair(){
        saindo.style.background = '#F8F8FF';
    }

    

    var data = new Date();
    let diasemana = data.getDay();

    if (diasemana == 0) {
        infor.innerHTML = `Hoje é Domingo`
    } else if (diasemana == 1) {
        infor.innerHTML = `Hoje é Segunda-Feira`
    } else if (diasemana == 2) {
        infor.innerHTML = `Hoje é Terça-Feira`
    } else if (diasemana == 3) {
        infor.innerHTML = `Hoje é Quarta-Feira`
    } else if (diasemana == 4) {
        infor.innerHTML = `Hoje é Quinta-Feira`
    } else if (diasemana == 5) {
        infor.innerHTML = `Hoje é Sexta-Feira`
    } else if (diasemana == 6) {
        infor.innerHTML = `Hoje é Sábado`
    }

}