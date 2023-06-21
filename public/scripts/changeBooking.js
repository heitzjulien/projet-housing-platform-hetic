let toggle = document.querySelector('#guests');
let currentLi = document.querySelector("#currentLi");


toggle.onclick = dropdownMenu;
document.querySelector("#li1").addEventListener("click", selectNbGuest);
document.querySelector("#li2").addEventListener("click", selectNbGuest); 
document.querySelector("#li3").addEventListener("click", selectNbGuest); 
document.querySelector("#li4").addEventListener("click", selectNbGuest); 
 

function dropdownMenu() {
    toggle.classList.toggle("opened");
}

function selectNbGuest(event) {
    if (event.target.nodeName === 'LI') {
        const value = event.target.textContent;
        currentLi.innerText = value;
      }
}

