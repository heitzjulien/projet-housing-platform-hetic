let test = [{
    'href': 'https://www.google.com',
    'name': 'Appartement 12 pièces • 200m²',
    'src': 'https://www.book-a-flat.com/magazine/wp-content/uploads/2017/11/appartement-location-interieur-paris.jpg',
    'alt': 'photo d\'intérieur d\'appartement de luxe',
    'place': 'Paris - 16ème',
    'description': 'Superbe triplex situé dans un des plus beaux quartiers de Paris'

}, {
    'href': 'https://www.google.com',
    'name': 'Appartement 12 pièces • 200m²',
    'src': 'https://www.book-a-flat.com/magazine/wp-content/uploads/2017/11/appartement-location-interieur-paris.jpg',
    'alt': 'photo d\'intérieur d\'appartement de luxe',
    'place': 'Paris - 16ème',
    'description': 'Superbe triplex situé dans un des plus beaux quartiers de Paris'

}, {
    'href': 'https://www.google.com',
    'name': 'Appartement 12 pièces • 200m²',
    'src': 'https://www.book-a-flat.com/magazine/wp-content/uploads/2017/11/appartement-location-interieur-paris.jpg',
    'alt': 'photo d\'intérieur d\'appartement de luxe',
    'place': 'Paris - 16ème',
    'description': 'Superbe triplex situé dans un des plus beaux quartiers de Paris'

}, {
    'href': 'https://www.google.com',
    'name': 'Appartement 12 pièces • 200m²',
    'src': 'https://www.book-a-flat.com/magazine/wp-content/uploads/2017/11/appartement-location-interieur-paris.jpg',
    'alt': 'photo d\'intérieur d\'appartement de luxe',
    'place': 'Paris - 16ème',
    'description': 'Superbe triplex situé dans un des plus beaux quartiers de Paris'

}

]

function createCardLogement(arrayAsso) {
    for (let i = 0; i < arrayAsso.length; i++) {

        let a = document.createElement('a')
        let img = document.createElement('img')
        let divDescription = document.createElement('div')
        let divName = document.createElement('div')
        let spanName = document.createElement('span')
        let spanPlace = document.createElement('span')
        let pDescription = document.createElement('p')

        a.setAttribute('href', arrayAsso[i].href)
        a.classList.add('cardLogement')

        img.setAttribute('src', arrayAsso[i].src)
        img.setAttribute('alt', arrayAsso[i].alt)

        spanName.textContent = arrayAsso[i].name

        spanPlace.textContent = arrayAsso[i].place

        pDescription.textContent = arrayAsso[i].description

        divDescription.classList.add('description')
        divName.classList.add('name')

        a.appendChild(img)
        a.appendChild(divDescription)
        divDescription.appendChild(divName)
        divDescription.appendChild(pDescription)
        divName.appendChild(spanName)
        divName.appendChild(spanPlace)

        document.querySelector(".container").appendChild(a)
    }
}

createCardLogement(test)