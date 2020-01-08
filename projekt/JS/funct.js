function dodajDate() {
	let date = new Date();
	document.getElementById('h').innerHTML = 'Dzisiaj jest: ' +
		date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
		document.getElementById("zmien").style.display = 'none';
}

function dodajZadanie() { //utworzenie obiektu o odpowiednich atrybutach:
	let item = {};
	item.godzina = document.getElementById('godzina').value;
	item.data = document.getElementById('data').value;
	item.zadanie = document.getElementById('zadanie').value;
	//odczyt listy obiektów z localStorage (jeśli już istnieje):
	let lista = JSON.parse(localStorage.getItem('lista'));
	if (lista === null) lista = []; //pracujemy z tablicą obiektów
	lista.push(item); //dodaj nowy obiekt do listy
	localStorage.setItem('lista', JSON.stringify(lista)); //zapisz nową listę
	pokazListe();
}

function pokazListe() {
	let lista = JSON.parse(localStorage.getItem('lista'));
	let el = document.getElementById('list');
	let str = "<h2>Lista zadań</h2>";
	if (lista === null) el.innerHTML = str + "<p>Pusta lista zadań</p>";
	else {
		// str += "<div class=\"container\">";
		for (i = 0; i < lista.length; i++) //pobierz informacje o zadaniach z listy
		{
			// str += "<div class=\"card\"><div class=\"card-item\">";
			str += "<button class='usun' onclick='usunZadanie(" + i + ")' > X </button>";
			str += "<button class='zmien' onclick='zmienZadanie(" + i + ")' > E </button>";
			str += " " + lista[i].data + " godzina: " + lista[i].godzina + " - ";
			str += lista[i].zadanie + "<br />";
			// str += "</div></div>";
		}
		el.innerHTML = str;
	}
}

function usunListe() {
	localStorage.removeItem('lista'); //usuń całą listę z localStorage
	pokazListe(); //zaktualizuj widok na stronie
}

function usunZadanie(i) {
	let lista = JSON.parse(localStorage.getItem('lista'));
	//usuń i-ty element z listy zadań:
	if (confirm("Usunąć zadanie?")) lista.splice(i, 1);
	//zapisz zaktualizowaną listę w localStorage:
	localStorage.setItem('lista', JSON.stringify(lista)); //zapisz listę
	pokazListe(); //zaktualizuj widok na stronie
}
let index = 0;
function zmienZadanie(i){
	document.getElementById("zmien").style.display = 'block';
	let lista = JSON.parse(localStorage.getItem('lista'));
	index = i;
	document.getElementById('godzina').value = lista[i].godzina;
	document.getElementById('data').value = lista[i].data;
	document.getElementById('zadanie').value = lista[i].zadanie;
	
	// pokazListe();
}
function zmienZadanie1(){
	let i = index;
	let lista = JSON.parse(localStorage.getItem('lista'));
	lista[i].godzina = document.getElementById('godzina').value;
	lista[i].data = document.getElementById('data').value;
	lista[i].zadanie = document.getElementById('zadanie').value;
	localStorage.setItem('lista', JSON.stringify(lista)); //zapisz nową listę
	pokazListe();
}

