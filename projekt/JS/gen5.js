const i = localStorage.getItem('index');
const post = JSON.parse(localStorage.getItem('post'));

function Tresc(){
    PostFullMeta();
    PostFullTitle();
    PostFullImage();
    PostContent();
}

function PostFullMeta() {
    document.getElementById('post-full-meta').innerHTML = "<time class=\"post-full-meta-date\" datetime=\""+
    post[i].createTimeYear + "-"+post[i].createTimeMonth+"-"+post[i].createTimeDay+"\">"+post[i].createTimeDay + 'jun' +post[i].createTimeYear+"</time>"+
    "<span class=\"date-divider\">/</span> <a href=\"#\">"+
    post[i].tag+"</a>";
}
function PostFullTitle(){
    document.getElementById('post-full-title').innerHTML = post[i].title;
}
function PostFullImage(){
    document.getElementById('post-full-image').innerHTML = "<img id=\"post-full-image\""+
    "srcset=\""+post[i].img300+" 300w\,"+post[i].img600 + " 600w\,"+post[i].img1000 + " 1000w\,"+post[i].img2000 + " 2000w\""+
    " sizes=\"(max-width: 1000px) 400px, 700px\" src=\"" + post[i].img2000 + "\" alt=\"document\"/>"
}
function PostContent(){
    document.getElementById('post-content').innerHTML = "<h3 id=\"-\">"+post[i].title+"</h3>"+
    "<p>"+post[i].mainText+"</p>";
}
// 	let el = document.getElementById('post-content');
