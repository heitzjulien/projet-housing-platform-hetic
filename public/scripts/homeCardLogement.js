const firstCard = document.getElementById("card0");
const secondCard = document.getElementById("card1");
const thirdCard = document.getElementById("card2");

secondCard.classList.add("hideCard");
thirdCard.classList.add("hideCard");

const cardsList = [firstCard, secondCard, thirdCard]
let currentCard = 0;

const updateCards = () => {
    if (window.innerWidth < 780) {
        if (currentCard > 2) {
            currentCard = 0;
        }
        cardsList.map(card => card.classList.add("hideCard"))
        cardsList[currentCard].classList.remove("hideCard");
        currentCard++
    }
}

setInterval(updateCards, 2000);


