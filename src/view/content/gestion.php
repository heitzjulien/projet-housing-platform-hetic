<main>
    <h2>Gestion des employés et des clients</h2>
    <div class="settings">
        <button>Create</button>
        <div class="toggle">
            <button>Employés</button>
            <button>Clients</button>
        </div>
        <form action="GET">
            <input type="text" placeholder="Rechercher par Nom ou Prénom">
            <button type="submit">Chercher</button>
        </form>
    </div>
    <section class="everyone">
        <div class="listing">
            <div class="name">
                <p>Nom</p>
                <p>Prénom</p>
            </div>
            <button>Role</button>
            <button>Désactiver</button>
            <button class="delete">Delete</button>
        </div>
    </section>

</main>
<script>
    function createListEmployeCustomer() {
        let div = document.createElement("div")
        div.className = "name"

        let nom = document.createElement("p")
        let prenom = document.createElement("p")
        nom.textContent = "Nom"
        prenom.textContent = "Prénom"
        div.appendChild(nom)
        div.appendChild(prenom)

        let roleButton = document.createElement("button")
        let desactiverButton = document.createElement("button")
        let deleteButton = document.createElement("button")
        roleButton.textContent = "Role"
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

    createListEmployeCustomer()
</script>