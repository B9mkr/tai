/* IN HTML
<div class="progress-barm floating-header floating-active"></div> 
*/
// scroll progress bar
const progress = document.querySelector('.progress-barm');
window.addEventListener('scroll', progressBar);
function progressBar(e){
    let windowsScroll = document.body.scrollTop || document.documentElement.scrollTop;
    let windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    let per = windowsScroll / windowHeight * 100;
    progress.style.width = '' + per + '%';
}