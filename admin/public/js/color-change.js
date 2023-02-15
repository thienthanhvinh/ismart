let colorInput = document.querySelector('#color-sl');
let codeInput = document.querySelector('#color-code');

colorInput.addEventListener('input', function(){
    let color = colorInput.value;
    console.log(color);
    codeInput.value = color;
    
});



