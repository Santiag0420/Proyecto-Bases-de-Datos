const inputSearch = document.getElementById('inputSearch');
const user = localStorage.getItem('mail');
var search = new FormData();
search.append("user",user);

fetch("includes/searchFiles.php", {
    method: 'POST',
    body: search
})
.then(response=>response.json())
.then( files => {
        inputSearch.addEventListener('input', (e)=>{
        e.preventDefault();
        const cartas = document.querySelectorAll('.card');
        var arrayDisplayCartas =[];
        cartas.forEach( carta => {
            var displayCarta = carta.parentElement.style.display;
            arrayDisplayCartas.push( displayCarta);
        });
       
        var inputValue = inputSearch.value;
        console.log(arrayDisplayCartas[0]);
        for(let j=0; j<files.length; j++){
            if(!files[j].includes(inputValue)){
                cartas.forEach( carta => {
                    if(carta.id === ""+j){
                        carta.parentElement.style.display = 'none';
                    }
                });
            }else{
                carta = document.getElementById(""+j);
                carta.parentElement.style.display = 'block';
            }
        }
        var contenido = inputSearch.ariaValueMax;
    })
})

