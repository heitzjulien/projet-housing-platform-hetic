export function createDashboardCard(jsonFilePath) {
    fetch(jsonFilePath)
        .then(response => response.json())
        .then(data => {
            for (let card = 0; card < data.length; card++) {
                let img = document.createElement('img')
                let h2 = document.createElement('h2')
                let p = document.createElement('p')
                let a = document.createElement('a')
                let container = document.querySelector('.container')


                a.classList.add('dashboardCard')
                a.setAttribute("href", data[card].href);
                container.appendChild(a)

                img.setAttribute('src', data[card].src)
                img.setAttribute('alt', data[card].alt)
                a.appendChild(img)

                h2.textContent = data[card].title
                a.appendChild(h2)

                p.textContent = data[card].description
                a.appendChild(p)

            }
        })
        .catch(error => console.error("Une erreur s'est produite lors du chargement du fichier JSON :", error));


}

