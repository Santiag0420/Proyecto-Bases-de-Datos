function viewFilesShared (){
    fetch("showSharedMe", {
        method: 'POST',
        body: files
    })
    .then(response => response.json())
    .then(files => {
        console.log(files)
    })
}