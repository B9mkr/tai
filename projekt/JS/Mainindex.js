function mainFunctionPosts(){
    pokazPosty('post-feed');
}
function pokazPosty(SrcId) {
	let post = JSON.parse(localStorage.getItem('post'));
	let el = document.getElementById(SrcId);
	let tresc = ''+ el.innerHTML;
    if (post === null) 
        el.innerHTML = tresc;
	else {
        for (let i = 0; i < post.length; i++) //pobierz informacje o zadaniach z listy
		{
            const documen = 'index5.html';

            const img300 = post[i].img300;
            const img600 = post[i].img600;
            const img1000 = post[i].img1000;
            const img2000 = post[i].img2000;

            const author = post[i].author;
            const title = post[i].title;
            const opis = post[i].opis;
            const tag = post[i].tag;
            const time = post[i].time;
            const fAuthora = post[i].fAuthora;
            // let faltAuthor = post[i].faltAuthor;

            tresc += "<article class=\"post-card post\">";

            tresc += "<a class=\"post-card-image-link\" href=\""+documen+"\" onclick=\"index("+i+")\">";
            tresc += "<img class=\"post-card-image\" srcset=\""+img300+" 300w\,"+img600 + " 600w\,"+img1000 + " 1000w\,"+img2000 + " 2000w\"";
            tresc += " sizes=\"(max-width: 1000px) 400px, 700px\" src=\"" + img2000 + "\" alt=\"document\"/> </a>";
            
            tresc += "<div class=\"post-card-content\"><a class=\"post-card-content-link\" href=\""+documen+"\" onclick=\"index("+i+")\">";
            tresc += "<header class=\"post-card-header\"><span class=\"post-card-tags\">" + tag + "</span>";
            tresc += "<h2 class=\"post-card-title\">"+title+"</h2></header><section class=\"post-card-excerpt\">";
            tresc += "<p>"+opis+"</p></section></a>";
            tresc += "<footer class=\"post-card-meta\"><ul class=\"author-list\"><li class=\"author-list-item\">";
            tresc += "<div class=\"author-name-tooltip\">"+author+"</div>";
            tresc += "<a href=\"#\" class=\"static-avatar\"><img class=\"author-profile-image\" src=\""+fAuthora+"\" alt=\"author\"/></a></li></ul>";
            tresc += "<span class=\"reading-time\">"+time+" min</span></footer></div></article>";
        }
        el.innerHTML = tresc;
	}
}
function index(i){
    localStorage.setItem('index', i);
}