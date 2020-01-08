let POST = {
    CzasTworzeniaMin: '',
    CzasTworzeniaMon: '',
    CzasTworzeniaYea: '',
    fotoAutora: '',
    // fotoAltAuthora: '',
    fotoFona: ''
};
function dodajDate() {
	let date = new Date();
	document.getElementById('h').innerHTML = 'Dzisiaj jest: ' +
    date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
    document.getElementById("zmien").style.display = 'none';
    POST.CzasTworzeniaYea = date.getFullYear();
    POST.CzasTworzeniaMon = (date.getMonth() + 1);
    POST.CzasTworzeniaDay = date.getDate();
    localStorage.setItem('index', 0);
    pokazPosty('list');
}

function dodajPost() { //utworzenie obiektu o odpowiednich atrybutach:
    let post = {};

    post.createTimeYear = POST.CzasTworzeniaYea;
    post.createTimeMonth = POST.CzasTworzeniaMon;
    post.createTimeDay = POST.CzasTworzeniaDay;
    
    post.title = document.getElementById('title').value;
    if(post.title == '')
	    post.title = 'Tytuł';
    
    post.author = document.getElementById('author').value;
    if(post.author == '')
        post.author = 'Anon';
    
    post.tag = document.getElementById('tag').value;
    if(post.tag == '')
        post.tag = 'Tag';

    post.time = document.getElementById('time').value;
    if(post.time == 0 || post.time == '')
        post.time = '&infin;';

    post.opis = document.getElementById('opis').value;
    if(post.opis == '')
        post.opis = 'Opis';

    post.fAuthora = POST.fotoAutora;
    if(post.fAuthora == ""){
        post.fAuthora = 'img/standard/anon.jpg';
    }

    // post.img300 = 'img/standard/f300.jpg';
    post.img600 = POST.fotoFona;
    // post.img1000 = 'img/standard/f1000.jpg';
    // post.img2000 = 'img/standard/f2000.jpg';
    if(post.img600 == ''){
        post.img300 = 'img/standard/f300.jpg';
        post.img600 = 'img/standard/f600.jpg';
        post.img1000 = 'img/standard/f1000.jpg';
        post.img2000 = 'img/standard/f2000.jpg';
    }
    else{
        post.img300 = post.img600;
        post.img1000 = post.img600;
        post.img2000 = post.img600;
        // post.img300 = '';
        // post.img1000 = '';
        // post.img2000 = '';
    }
    // post.img300 = document.getElementById('').value;
    // post.img600 = document.getElementById('').value;
    // post.img1000 = document.getElementById('').value;
    // post.img2000 = document.getElementById('').value;

    post.mainText = document.getElementById('editor').value;
    if(post.mainText == '')
        post.mainText = 'Co będzie w samym poście';
    
    // post.mainText = document.getElementById('mainText').value;
    // if(post.mainText == '')
    //     post.mainText = 'Co będzie w samym poście';

	//odczyt listy obiektów z localStorage (jeśli już istnieje):
	let lista = JSON.parse(localStorage.getItem('post'));
    if (lista === null) 
        lista = []; //pracujemy z tablicą obiektów
    lista.push(post); //dodaj nowy obiekt do listy
    
	localStorage.setItem('post', JSON.stringify(lista)); //zapisz nową listę
    
    wyczysc();

    pokazPosty('list');
} //koniec dodajPost

function wyczysc(){
    document.getElementById('title').value = '';
    document.getElementById('author').value = '';
    document.getElementById('tag').value = '';
    document.getElementById('time').value = '';
    document.getElementById('opis').value = '';
    document.getElementById('editor').value = '';
    POST.fotoAutora = '';
    POST.fotoFona = '';
}
// https://www.javascripture.com/FileReader
// https://www.html5rocks.com/ru/tutorials/file/dndfiles/
let openFilef = function(event) {
    let input = event.target;

    let reader = new FileReader();
    reader.onload = function(theFile){
        POST.fotoFona = reader.result;
    };
    reader.readAsDataURL(input.files[0]);
};

let openFilea = function(event) {
    let input = event.target;

    let reader = new FileReader();
    reader.onload = function(theFile){
        POST.fotoAutora = reader.result;// dataURL
        // POST.fotoAltAuthora = escape(theFile.name);
    };
    reader.readAsDataURL(input.files[0]);
};

function pokazPosty(SrcId) {
	let post = JSON.parse(localStorage.getItem('post'));
	let el = document.getElementById(SrcId);
	let tresc = '';
    if (post === null) 
        el.innerHTML = "<p>Pusto</p>";
	else {
        for (let i = 0; i < post.length; i++) //pobierz informacje o zadaniach z listy
		{
            const documen = 'index5.html';

            let img300 = '';
            let img600 = '';
            let img1000 = '';
            let img2000 = '';
            // if(post[i].img300 == post[i].img2000) {
            //     img300 = post[i].img600;
            //     img600 = post[i].img600;
            //     img1000 = post[i].img600;
            //     img2000 = post[i].img600;
            // }
            // else {
                img300 = post[i].img300;
                img600 = post[i].img600;
                img1000 = post[i].img1000;
                img2000 = post[i].img2000;
            // }
            
            
            const author = post[i].author;
            const title = post[i].title;
            const opis = post[i].opis;
            const tag = post[i].tag;
            const time = post[i].time;
            const fAuthora = post[i].fAuthora;
            // let faltAuthor = post[i].faltAuthor;

            tresc += "<article class=\"post-card post\">";

            tresc += "<a class=\"post-card-image-link\" href=\""+documen+"\" onclick=\"Index("+i+")\">";
            tresc += "<img class=\"post-card-image\" srcset=\""+img300+" 300w\,"+img600 + " 600w\,"+img1000 + " 1000w\,"+img2000 + " 2000w\"";
            tresc += " sizes=\"(max-width: 1000px) 400px, 700px\" src=\"" + img2000 + "\" alt=\"document\"/> </a>";
            
            tresc += "<div class=\"post-card-content\"><a class=\"post-card-content-link\" href=\""+documen+"\" onclick=\"Index("+i+")\">";
            tresc += "<header class=\"post-card-header\"><span class=\"post-card-tags\">" + tag + "</span>";
            tresc += "<h2 class=\"post-card-title\">"+title+"</h2></header><section class=\"post-card-excerpt\">";
            tresc += "<p>"+opis+"</p></section></a>";
            tresc += "<footer class=\"post-card-meta\">"+
                "<ul class=\"author-list\">"+
                "<li class=\"author-list-item\">"+
                    "<div class=\"author-name-tooltip\">"+author+"</div>"+
                    "<a href=\"#\" class=\"static-avatar\">"+
                    "   <img class=\"author-profile-image\" src=\""+fAuthora+"\" alt=\"author\"/>"+
                    "</a>"+
                "</li>";
            
            tresc += "<li class=\"list-item\">"+
                "<button class='usun' onclick='usunPost(" + i + ")' > X </button>"+
                "<button class='zmien' onclick='zmienPost(" + i + ")' > E </button>"+
            "</li>";
            
            tresc += "</ul><span class=\"reading-time\">"+time+" min</span></footer></div></article>";
        }
        el.innerHTML = tresc;
	}
}

function Index(i){
    localStorage.setItem('index', i);
}

function usunPosty() {
	localStorage.removeItem('post'); //usuń całą listę z localStorage
	pokazPosty('list'); //zaktualizuj widok na stronie
}

function usunPost(i) {
	let lista = JSON.parse(localStorage.getItem('post'));
	//usuń i-ty element z listy zadań:
    
    if (confirm("Usunąć zadanie?")) 
        lista.splice(i, 1);
	//zapisz zaktualizowaną listę w localStorage:
	localStorage.setItem('post', JSON.stringify(lista)); //zapisz listę
	pokazPosty('list'); //zaktualizuj widok na stronie
}
let index = 0;
function zmienPost(i){
	document.getElementById("zmien").style.display = 'block';
	let lista = JSON.parse(localStorage.getItem('post'));
    index = i;
    // Index(i);
	// document.getElementById('godzina').value = lista[i].godzina;
	// document.getElementById('data').value = lista[i].data;
	// document.getElementById('zadanie').value = lista[i].zadanie;

    document.getElementById('title').value = lista[i].title;
    document.getElementById('author').value = lista[i].author;
    document.getElementById('tag').value = lista[i].tag;
    document.getElementById('opis').value = lista[i].opis;
    document.getElementById('editor').value = lista[i].mainText;
    if(lista[i].time == '&infin;')
        document.getElementById('time').value = 0;
    else
    document.getElementById('time').value = lista[i].time;
    
	// pokazPosty('list');
}
function zmienPost1(){
    let i = index;
    // sessionStorage.setItem("mainText","0");
    Index(i);
    let lista = JSON.parse(localStorage.getItem('post'));
    
    let date = new Date();

    lista[i].createTimeYear = date.getFullYear();
    lista[i].createTimeMonth = (date.getMonth() + 1);
    lista[i].createTimeDay = date.getDate();

    lista[i].title = document.getElementById('title').value;
    lista[i].author = document.getElementById('author').value;
    lista[i].tag = document.getElementById('tag').value;
    lista[i].time = document.getElementById('time').value;
    lista[i].opis = document.getElementById('opis').value;
    lista[i].mainText = document.getElementById('editor').value;

    // lista[i].fAuthora = POST.fotoAutora;
    // lista[i].img600 = POST.fotoFona;
    
    localStorage.setItem('post', JSON.stringify(lista)); //zapisz nową listę
    pokazPosty('list');
    document.getElementById("zmien").style.display = 'none';
    wyczysc();
}
