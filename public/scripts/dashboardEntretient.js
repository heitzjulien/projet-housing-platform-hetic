function toggle(){
    var brightness = document.getElementById('brightness');
    brightness.classList.toggle('active')
    var popup = document.getElementById('popup');
    popup.classList.toggle('active')
}


const formEl = document.querySelector('form');
const tbodyEl = document.querySelector('tbody');
const tableEl = document.querySelector('table');


function onAddRow(event) {
event.preventDefault();
const adresse = document.getElementById('adresse').value;
const employe = document.getElementById('employe').value;
const date = document.getElementById('date').value;
const horaire = document.getElementById('horaire').value;
const taches = document.getElementById('taches').value;

tbodyEl.innerHTML +=
`<tr>
    <td>${adresse}</td>
    <td>${employe}</td>
    <td>${taches}</td>
    <td>${date}</td>
    <td>${horaire}</td>
    <td>
        <select id="choix_statut">
            <option value="done"><span>Done</span></option>
            <option value="undone">Undone</option>
        </select>
    </td>
    <td>
        <button class="edit">Edit</button>
        <button class="delete">Delete</button>
    </td>
</tr>`;
}

formEl.addEventListener("submit", onAddRow);


function onDeleteRow(event) {
if (!event.target.classList.contains("delete")) {
  return;
}

const btn = event.target;
btn.closest("tr").remove();
}

tableEl.addEventListener("click", onDeleteRow);



function onEdit(event) {
const row = event.target.closest("tr");
const adresseCell = row.cells[0];
const employeCell = row.cells[1];
const tachesCell = row.cells[2];
const dateCell = row.cells[3];
const horaireCell = row.cells[4];

const adresseInput = document.createElement("input");
adresseInput.type = "text";
adresseInput.value = adresseCell.textContent;
adresseCell.textContent = "";
adresseCell.appendChild(adresseInput);

const employeInput = document.createElement("input");
employeInput.type = "text";
employeInput.value = employeCell.textContent;
employeCell.textContent = "";
employeCell.appendChild(employeInput);

const tachesInput = document.createElement("input");
tachesInput.type = "text";
tachesInput.value = tachesCell.textContent;
tachesCell.textContent = "";
tachesCell.appendChild(tachesInput);

const dateInput = document.createElement("input");
dateInput.type = "text";
dateInput.value = dateCell.textContent;
dateCell.textContent = "";
dateCell.appendChild(dateInput);

const horaireInput = document.createElement("input");
horaireInput.type = "text";
horaireInput.value = horaireCell.textContent;
horaireCell.textContent = "";
horaireCell.appendChild(horaireInput);

const editButton = row.querySelector(".edit");
editButton.textContent = "Update";
editButton.classList.remove("edit");
editButton.classList.add("update");
}

function onUpdate(event) {
const row = event.target.closest("tr");
const adresseInput = row.cells[0].querySelector("input");
const employeInput = row.cells[1].querySelector("input");
const tachesInput = row.cells[2].querySelector("input");
const dateInput = row.cells[3].querySelector("input");
const horaireInput = row.cells[4].querySelector("input");

row.cells[0].textContent = adresseInput.value;
row.cells[1].textContent = employeInput.value;
row.cells[2].textContent = tachesInput.value;
row.cells[3].textContent = dateInput.value;
row.cells[4].textContent = horaireInput.value;

const updateButton = row.querySelector(".update");
updateButton.textContent = "Edit";
updateButton.classList.remove("update");
updateButton.classList.add("edit");
}

tableEl.addEventListener("click", function (event) {
if (event.target.classList.contains("edit")) {
onEdit(event);
} else if (event.target.classList.contains("update")) {
onUpdate(event);
}
});