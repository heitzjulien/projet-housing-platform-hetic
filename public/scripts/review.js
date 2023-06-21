const fileInput = document.getElementById('file-input');
const preview = document.getElementById('preview');

fileInput.addEventListener('change', (event) => {
  const files = event.target.files;
  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    const reader = new FileReader();
    
    reader.onload = (e) => {
      const img = document.createElement('img');
      img.src = e.target.result;
      preview.appendChild(img);
    };
    
    reader.readAsDataURL(file);
  }
});
