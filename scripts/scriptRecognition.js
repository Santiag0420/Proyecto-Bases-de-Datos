const video = document.getElementById("video");
const alert = document.getElementById("alertaFace");
Promise.all([
  faceapi.nets.ssdMobilenetv1.loadFromUri('models'),
  faceapi.nets.faceRecognitionNet.loadFromUri('models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('models'),
]).then(startWebcam);

function startWebcam() {
  navigator.mediaDevices
    .getUserMedia({
      video: true,
      audio: false,
    })
    .then((stream) => {
      video.srcObject = stream;
    })
    .catch((error) => {
      console.error(error);
    });
}

var labels = [];
fetch('includes/usuarios.php',{
    method: 'GET'
  })
  .then(response => response.json())
  .then((responseServer) =>{
    responseServer.shift()
    for(var i=0; i<responseServer.length; i++){
      labels.push(responseServer[i].substring(0, responseServer[i].lastIndexOf('@')));
    }
  })

  function verificarExistenciaArchivo(url) {
    return fetch(url, { method: 'HEAD' })
      .then(response => {
        if (response.status === 404) {
          return false; // El archivo no existe
        }
        return true; // El archivo existe
      })
      .catch(() => false);
  }

function getLabeledFaceDescriptions() {
  return Promise.all(
    labels.map(async (label) => {
      const descriptions = [];
      for(var i = 0; i <= 0; i++){
        const img = await faceapi.fetchImage(`labels/${label}/${i}.png`)
        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
        descriptions.push(detections.descriptor);
      }
      return new faceapi.LabeledFaceDescriptors(label, descriptions);
    })
  );
}

video.addEventListener("play", async () => {
  const labeledFaceDescriptors = await getLabeledFaceDescriptions();
    const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors);
    const canvas = faceapi.createCanvasFromMedia(video);
    document.body.append(canvas);

    const displaySize = {width: video.width, height: video.height};

    faceapi.matchDimensions(canvas, displaySize);

    setInterval(async () => {
      const detections = await faceapi.detectAllFaces(video).withFaceLandmarks().withFaceDescriptors();

      const resizedDetections = faceapi.resizeResults(detections, displaySize);

      canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

      const results = resizedDetections.map((d) => {
        return faceMatcher.findBestMatch(d.descriptor);
      });
      results.forEach((result) => {
        console.log(result._label+"@gmail.com");
        if(result._label != "unknown"){
          const datos = new FormData();
          datos.append("user", result._label+"@gmail.com")
          fetch('includes/faceRecognition.php',{
            method: 'POST',
            body: datos
          })
          .then( res => res.json())
          .then( data => {
            localStorage.setItem('mail', data);
            location.href = "inicio.php"
          })
        }else if(result._label == "unknown"){
          alert.innerHTML = `<p>no se encuentra el rostro en la base, por favor tome una foto para registrar sus datos</p>`
        }
      });
    }, 100);
    
});

/* snap.addEventListener("click", function() {
  const canvas = faceapi.createCanvasFromMedia(video);
  var context = canvas.getContext('2d');
  context.drawImage(video,-100,-100,800,600);
  var dataURL = canvas.toDataURL("image/jpeg", 1);
  var formFaceB64 = new FormData();
  formFaceB64.append("faceB64",dataURL);
  formFaceB64.append("user", "santiagoballa2003");
    fetch("includes/saveFace.php",{
        method: "POST",
        body: formFaceB64
    })
    .then(response => response.json())
    .then(responseServer => {
        console.log(responseServer);
    })
}); */