<main>
    <h2>Gestion des employés et des clients</h2>
    <div class="settings">
        <button>Create</button>
        <div class="toggle">
            <button class="royal" id="employe">Employés</button>
            <button class="colorless hauss" id="customer">Clients</button>

        </div>
        <form action="GET">
            <input type="text" placeholder="Rechercher par Nom ou Prénom">
            <button type="submit">Chercher</button>
        </form>
    </div>
    <section class="everyone">
    </section>

</main>

</html>
<script>let customerArray = [{
        lastname: 'Lepers',
        firstname: "Julien",
        role: "Iencli"
    }, {
        lastname: 'Le',
        firstname: "Benjos",
        role: "PHP fan"
    }
    ]
    let employeArray = [{
        lastname: 'LeMeilleur',
        firstname: "Dylan",
        role: "leBest"
    }, {
        lastname: 'ff',
        firstname: "le projet",
        role: "hate"
    }
    ]
    function removeAllElements() {
        let everyoneSection = document.querySelector('.everyone');
        while (everyoneSection.firstChild) {
            everyoneSection.removeChild(everyoneSection.firstChild);
        }
    }

    function createListEmployeCustomer(custoArray, emploArray, state) {
        if (state) {
            for (let i = 0; i < emploArray.length; i++) {
                let div = document.createElement("div")
                div.className = "name"

                let nom = document.createElement("p")
                let prenom = document.createElement("p")
                nom.textContent = emploArray[i].lastname
                prenom.textContent = emploArray[i].firstname
                div.appendChild(nom)
                div.appendChild(prenom)

                let roleButton = document.createElement("button")
                let desactiverButton = document.createElement("button")
                let deleteButton = document.createElement("button")
                roleButton.textContent = emploArray[i].role
                desactiverButton.textContent = "Désactiver"
                deleteButton.textContent = "Delete"
                deleteButton.className = "delete"

                let listingDiv = document.createElement("div")
                listingDiv.className = "listing"
                listingDiv.appendChild(div)
                listingDiv.appendChild(roleButton)
                listingDiv.appendChild(desactiverButton)
                listingDiv.appendChild(deleteButton)

                let everyoneSection = document.querySelector('.everyone')
                everyoneSection.appendChild(listingDiv)
            }
        } else {
            for (let i = 0; i < custoArray.length; i++) {
                let div = document.createElement("div")
                div.className = "name"

                let nom = document.createElement("p")
                let prenom = document.createElement("p")
                nom.textContent = custoArray[i].lastname
                prenom.textContent = custoArray[i].firstname
                div.appendChild(nom)
                div.appendChild(prenom)

                let roleButton = document.createElement("button")
                let desactiverButton = document.createElement("button")
                let deleteButton = document.createElement("button")
                roleButton.textContent = custoArray[i].role
                desactiverButton.textContent = "Désactiver"
                deleteButton.textContent = "Delete"
                deleteButton.className = "delete"

                let listingDiv = document.createElement("div")
                listingDiv.className = "listing"
                listingDiv.appendChild(div)
                listingDiv.appendChild(roleButton)
                listingDiv.appendChild(desactiverButton)
                listingDiv.appendChild(deleteButton)

                let everyoneSection = document.querySelector('.everyone')
                everyoneSection.appendChild(listingDiv)
            }
        }
    }

    function colorSwitch(button, state) {
        if (state) {
            button.classList.add('royal')
            button.classList.remove('colorless')
            button.classList.remove('hauss')
        } else {
            button.classList.remove('royal')
            button.classList.add('colorless')
            button.classList.add('hauss')
        }
    }


    let employe = document.querySelector('#employe');
    let customer = document.querySelector('#customer');

    let employeState = true
    let customerState = false
    console.log(customer)
    customer.addEventListener('click', () => {
        if (!customerState) {
            customerState = !customerState
            employeState = !customerState
            console.log('custo' + customerState)
            console.log('otherButton' + employeState)

            colorSwitch(customer, customerState)
            colorSwitch(employe, employeState)
            removeAllElements();

            createListEmployeCustomer(customerArray, employeArray, employeState)

        }
    });

    employe.addEventListener('click', () => {
        if (!employeState) {
            employeState = !employeState
            customerState = !employeState
            console.log('custo' + employeState)
            console.log('otherButton' + customerState)

            colorSwitch(employe, employeState)
            colorSwitch(customer, customerState)
            removeAllElements();

            createListEmployeCustomer(customerArray, employeArray, employeState)

        }
    })

    createListEmployeCustomer(customerArray, employeArray, employeState)


</script>