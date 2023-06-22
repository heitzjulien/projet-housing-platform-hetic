function toggle(){
    var brightness = document.getElementById('brightness');
    brightness.classList.toggle('active')
    var popup = document.getElementById('popup');
    popup.classList.toggle('active')
}


let choix_statut = document.getElementById('choix_statut');

choix_statut.addEventListener('change', function() {
let selectedOption = choix_statut.options[choix_statut.selectedIndex].value;
console.log('Selected option:', selectedOption);

});

const formEl = document.querySelector('form');
const tbodyEl = document.querySelector('tbody');
const tableEl = document.querySelector('table');

function onAddRow(event) {
event.preventDefault();
const adresse = document.getElementById("adresse").value;
const IDReservation = document.getElementById("IDReservation").value;

tbodyEl.innerHTML += `<tr>
  <td>${adresse}</td>
  <td>${IDReservation}</td>
  <td>
    <select id="choix_statut">
        <option value="Reserved"><span>Reserved</span></option>
        <option value="unReserved">UnReserved</option>
    </select>
  </td>
  <td>
      <button class="edit">Edit</button>
      <button class="delete">Delete</button>
  </td>
</tr>`;

document.getElementById("adresse").value = "";
document.getElementById("IDReservation").value = "";
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
const IDReservationCell = row.cells[1];

const adresseInput = document.createElement("input");
adresseInput.type = "text";
adresseInput.value = adresseCell.textContent;
adresseCell.textContent = "";
adresseCell.appendChild(adresseInput);

const IDReservationInput = document.createElement("input");
IDReservationInput.type = "text";
IDReservationInput.value = IDReservationCell.textContent;
IDReservationCell.textContent = "";
IDReservationCell.appendChild(IDReservationInput);

const editButton = row.querySelector(".edit");
editButton.textContent = "Update";
editButton.classList.remove("edit");
editButton.classList.add("update");
}

function onUpdate(event) {
const row = event.target.closest("tr");
const adresseInput = row.cells[0].querySelector("input");
const IDReservationInput = row.cells[1].querySelector("input");

row.cells[0].textContent = adresseInput.value;
row.cells[1].textContent = IDReservationInput.value;

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