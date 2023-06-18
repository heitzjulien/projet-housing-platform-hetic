document.getElementById("dialogHeader").addEventListener("click", () => {
    document.getElementById("headerModal").classList.contains('hideModal') ?
        document.getElementById("headerModal").classList.remove('hideModal')
        : document.getElementById("headerModal").classList.add('hideModal')
})