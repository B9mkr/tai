function pokaz(id){
    tresc="";
    switch (id) { 
        case 2: tresc += pokazGalerie();break;
        case 3: tresc += pokazPost(); break;
        case 4: tresc += pokazKontakt();break;
        default: tresc += pokazOmnie();
    }
    //pobierz element o wskazanym id i ustaw jego nową zawartość:
    document.getElementById('blok').innerHTML = tresc;
}
function pokazOmnie() {
    tresc ='<h2><br />O mnie</h2> ';
    //operator += uzupełnia łańcuch kolejną porcją znaków:
    Tresc += '<p>Lorem ipsum dolor pariatur,...</p>'+
    '<p class="srodek"><img src="images/baner.jpg" alt="Zdjęcie" /></p>'+
    '<article><h2>Moje hobby</h2><p>'+
    'Lorem ipsum dolor sit amet,...'+
    'mollit anim id est laborum.</p></article>';
    //przekaż wynik – gotową zawartość – do miejsca wywołania funkcji:
    return tresc;
}
function pokazGalerie() {
    tresc='<h2><br />Moja galeria</h2>';
    tresc+=' <div class="galeria">';
    //wygeneruj kod HTML z obrazami za pomocą pętli for:
    var i=1;
    for(;i<=10;i++) {
        tresc += '<div class="slajd"> <img src="miniaturki/obraz' + i + '.JPG" alt="Zdjecie' + i + '" /></div>';
    }
    
    return tresc + '</div>';
}
function pokazKontakt() {
    tresc='<h2><br />Kontakt</h2>';
    //uzupełnij treść:
    // tresc+= ...
    return tresc;
}
function pokazPost() {
    //funkcja generuje kod formularza – dane wpisane w odpowiednie pola przez
    //użytkownika zostaną przekazane mailem na wskazany adres, ale w
    //zajścia zdarzenia submit – zostanie wyołana funkcja pokazDane()
    //submit zostanie najpierw który będzie wysłany mailem
    tresc = '<h2><br />Dodaj post</h2>';
    tresc += '<article class="srodek" ><form action="mailto:b.panczyk@pollub.pl" '+
    'method="post" onsubmit="return pokazDane();">'+
        'Twój email:<br />'+
    '<input type="email" name="email" id="email" required /><br />'+
        'Nazwisko i imię:<br /> '+
    '<input type="text" name="iminazw" id="iminazw" required /><br />'+
        'Telefon:<br /> '+
    '<input type="tel" name="tel" id="tel" required /><br />'+
        'Zainteresowania: <br />'+
    '<input type="checkbox" name="zaint" value="sport" /> Sport'+
    '<input type="checkbox" name="zaint" value="muzyka" /> Muzyka'+
    '<input type="checkbox" name="zaint" value="film" /> Film '+
    '<input type="checkbox" name="zaint" value="inne" /> Inne <br />'+
        'Wiek: <br />'+
    '<input type="radio" name="wiek" value="Mniej niż 10" /> Mniej niż 10'+
    '<input type="radio" name="wiek" value="10-20" /> 10-20'+
    '<input type="radio" name="wiek" value="21-30" /> 21-30'+
    '<input type="radio" name="wiek" value="31-40" /> 31-40'+
    '<input type="radio" name="wiek" value="41-50" /> 41-50'+
    '<input type="radio" name="wiek" value="Więcej niż 50" /> Więcej niż 50 <br />'+
        'Komentarz: <br />'+
    '<textarea rows="3" cols="20" id="wiadomosc" name="wiadomosc" required></textarea>'+
    '<br /> <input type="submit" name="wyslij" value="Wyślij" />'+
    '</form></article>';
    return tresc;
}
function pokazDane() {
    //Funkcja zbiera dane wpisane w pola formularza i wyświetla okienko
    //typu confirm do zatwierdzenia przez użytkownika:
    dane="Następujące dane zostaną wysłane:\n";
    dane+="Email: "+document.getElementById('email').value+"\n";
    dane+="Nazwisko i imię: "+document.getElementById('iminazw').value+"\n";
    dane+="Telefon: "+document.getElementById('tel').value+"\n";
    dane+="Zainteresowania: ";
    
    var zaint = document.getElementsByName("zaint");
    for(i=0; i < zaint.length; i++){
        if(zaint[i].checked)
            dane += zaint[i].value + ', ';
    }
    dane+="\nWiek: ";
    for(i=0; i<6; i++){
        if(document.forms[0].wiek[i].checked)
            dane += document.forms[0].wiek[i].value + '\n';
    }
    dane+="Komentarz: "+document.getElementById('wiadomosc').value+"\n";
    
    if (window.confirm(dane)) return true;
    else return false;
}
// var chapter = {
//     // logika: 0,
//     // id: 0,
//     // ilStron: 0,
//     allChapter: 11
// };

// function menu(){
//     var lista = '<nav> ';

//     for(i = 1; i <= chapter.allChapter; i++) {
//         lista += '<a href="#chapt"> <button onmouseover="onmOut(this)" onmouseout="ofmOver(this)" onclick="pokaz(' + i + ', ' + iloscStron(i-1) + ')">Глава ' + i + ' </button> </a>';
//     }

//     lista += ' </nav>';
    
//     elDiv = document.getElementById("zd1");
    
//     elDiv.innerHTML = lista;
// }
// function ofmOver(obj) {
//     obj.style.background = "#45525a60";
// }

// function onmOut(obj) {
//     obj.style.background = "#45525aee";
// }
// function iloscStron(i) {
//     var iloscStron = [  
//         31,23,27,20,21,
//         24,17,25,12,12,
//         19
//     ];
//     return iloscStron[i];
// }
//     // rename -v 's/([^.]+).*/$1.png/' *.png
//     // x=101; for i in `ls`; do mv $i ${x:1}.png; (( x++ )); done

// function pokaz(id, iloscS){
//     tresc="";
//     tresc += tom(id, iloscS);
//     document.getElementById('blok').innerHTML = tresc;
// }

// function tom(tom, ilosc){
//     var lista = '<h2 id="chapt"> Глава ' + tom + ' </h2>';
//     // lista += '<div id="float-block" class="float-block">'+ 
//     // '<p>Этот блок будет фиксироваться в верхней части экрана при скролле. Прокрутите страницу вниз…</p>'+
//     // '</div>';

//     for(i = 1; i <= ilosc; i++) {
//         if(i < 10) {
//             lista += '<h4> 0'+i+' </h4>'+
//                      '<img src="img/g'+tom+'/0'+i+'.png" alt="foto_'+i+'"/>';
//         }
//         else {
//             lista += '<h4>'+i+'</h4>'+
//                      '<img src="img/g'+tom+'/'+i+'.png" alt="foto_'+i+'"/>';
//         }
//     }

//     lista += '<nav>';
//     if(tom > 1)
//         lista += '<a href="#chapt"> <button class="dol" onmouseover="pmOver(this,' + tom + ')" onmouseout="pmOut(this,' + tom + ')" onclick="pokaz(' + (tom - 1) + ', ' + iloscStron(tom - 2) + ')"> \< Глава ' + (tom - 1) + ' </button> </a>';
//     if(tom < chapter.allChapter)
//         lista += '<a href="#chapt"> <button class="dol" onmouseover="nmOver(this,' + tom + ')" onmouseout="nmOut(this,' + tom + ')" onclick="pokaz(' + (tom + 1) + ', ' + iloscStron(tom) + ')"> Глава ' + (tom + 1) + ' \> </button> </a>';
//     lista += '</nav>';
//     // goToHome();
//     return lista;
// }

// function pmOver(obj, tom) {
//     obj.innerHTML = ' \<\< Глава ' + (tom - 1);
//     obj.style.background = "#45525aee";
// }

// function pmOut(obj, tom) {
//     obj.innerHTML = ' \< Глава ' + (tom - 1);
//     obj.style.background = "#45525a60";
// }

// function nmOver(obj, tom) {
//     obj.innerHTML = 'Глава ' + (tom + 1) + ' \>\>';
//     obj.style.background = "#45525aee";
// }

// function nmOut(obj, tom) {
//     obj.innerHTML = 'Глава ' + (tom + 1) + ' \>';
//     obj.style.background = "#45525a60";
// }
// /* ----------------------- */
// var scrollFloat = function() {
//     'use strict';

//     var app = {};

//     app.init = function init(node) {
//         if (!node || node.nodeType !== 1) {
//             throw new Error(node + ' is not DOM element');
//         }
//         handleWindowScroll(node);
//     };

//     function handleWindowScroll(floatElement) {
//         window.onscroll = function() {
//             if (window.scrollY > floatElement.offsetTop) {
//                 if (floatElement.style.position !== 'fixed') {
//                     floatElement.style.position = 'fixed';
//                     floatElement.style.top = '0';
//                 }
//             } else {
//                 if (floatElement.style.position === 'fixed') {
//                     floatElement.style.position = '';
//                     floatElement.style.top = '';
//                 }
//             }
//         };
//     }

//     return app;
// }();