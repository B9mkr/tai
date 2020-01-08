const cards = document.querySelectorAll('.card');

// while(1)
for (let i = 0; i < cards.length; i++) {
    const card = cards[i];
    // console.log(i);
    card.addEventListener('mousemove', StartRotate);
    card.addEventListener('mouseout', StopRotate);
}

function StopRotate(event){
    const cardItem = this.querySelector('.card-item');

    cardItem.style.transform = 'rotate(0)';
}

function StartRotate(event){
    const cardItem = this.querySelector('.card-item');
    const halfHeight = cardItem.offsetHeight / 2;
    const halfWidth = cardItem.offsetWidth / 2;

    cardItem.style.transform = 
    'rotateX(' + -(event.offsetY - halfHeight) / 5 + 'deg) rotateY(' + (event.offsetX - halfWidth) / 5 + 'deg) ';
}