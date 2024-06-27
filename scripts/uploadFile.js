const modalFiles = new bootstrap.Modal(document.getElementById('modalFiles'))
const inputFile = document.getElementById('file')
const modal = document.getElementById('modalFiles');
const tituloModal = document.getElementById('tituloModal');
var form = document.getElementById('formArchivos');
const email = localStorage.getItem('mail');
const fecha = new Date();
const barProgress = document.getElementById('barProgress');
const barProgressContainer = document.getElementById('barProgressContainer');
const botonArchivo = document.getElementById('botonArchivo');
const validFiles = ["jpg","jpeg","png","gif","pdf","mp3","txt"];
console.log(email)
botonArchivo.addEventListener('click', (e) => {
  e.preventDefault();
  inputFile.click(); // Simula el clic en el input tipo file
});

 const formatoMap = {
  dd: fecha.getDate(),
  mm: fecha.getMonth()+1,
  yy: fecha.getFullYear()
};

var fechaCompleta = formatoMap.dd + "/"+ formatoMap.mm + "/"+ formatoMap.yy
console.log(fechaCompleta); 

form.addEventListener('change', function(event) {
  event.preventDefault();
  var formData = new FormData(form);
  formData.append('fechaSubida',fechaCompleta)
  formData.append('email', email);
  fetch('includes/uploadFile.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    console.log(data);
    if(data[1]=="fileUploadSucessfully"){
      var ramdom= (Math.floor(Math.random() * 2) + 1);
      modalFiles.show();
      progressBar(ramdom);
      setTimeout(() => {
        location.reload();
      }, ramdom*3000);
    }else if(data[1] == "fileTypeInvalid"){
      barProgress.remove();
      barProgressContainer.remove();
      modalFiles.show();
      tituloModal.textContent = 'Tipo de archivo invalido';
    }else{
      barProgress.remove();
      barProgressContainer.remove();
      modalFiles.show();
      tituloModal.textContent = 'Error al subir el archivo';
    }
  })


});

function progressBar(duracion) {
  const progressBar = document.querySelector('.progress-bar');
  let progress = 0;
  const increment = 10 / (duracion / 5); 
  const intervalId = setInterval(() => {
    progress += increment;
    progressBar.style.width = progress + '%';
    if (progress >= 100) {
      clearInterval(intervalId);
      tituloModal.textContent = 'Archivo subido';
    }
  }, 1000);
}
