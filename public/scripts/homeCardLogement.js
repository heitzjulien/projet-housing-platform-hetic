const firstCard = document.getElementById("card0");
const secondCard = document.getElementById("card1");
const thirdCard = document.getElementById("card2");

const firstCta = document.getElementById("carouselButton1");
const secondCta = document.getElementById("carouselButton2");
const thirdCta = document.getElementById("carouselButton3");

firstCta.classList.add("selectedCta");
secondCard.classList.add("hideCard");
thirdCard.classList.add("hideCard");

const cardsList = [firstCard, secondCard, thirdCard]
const ctaList = [firstCta, secondCta, thirdCta]

let currentCard = 0;
let carouselInterval;

const updateCards = () => {
    if (window.innerWidth < 780) {
        if (currentCard > 2) {
            currentCard = 0;
        }

        cardsList.map(card => card.classList.add("hideCard"))
        ctaList.map(cta => cta.classList.remove("selectedCta"))
        cardsList[currentCard].classList.remove("hideCard");
        ctaList[currentCard].classList.add("selectedCta");
        currentCard++
    }
}

ctaList.map((cta, key) => {
    cta.addEventListener("click", () => {
        currentCard = key;
        updateCards();
        stopInterval();
        startInterval()
    })
})

const startInterval = () => {
    carouselInterval = setInterval(updateCards, 2000);
}

const stopInterval = () => {
    clearInterval(carouselInterval);
}

startInterval();
