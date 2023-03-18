const allTextBoxes = document.querySelectorAll('.main-text');
const allButtons = document.querySelectorAll('.enable_me');

function createClickListener(index) {
    return function(){
        if(allTextBoxes[index].disabled === true){
            allTextBoxes[index].disabled = false;
            allTextBoxes[index].style.borderColor = "yellow";
            allTextBoxes[index].focus();
            const length = allTextBoxes[index].value.length;
            allTextBoxes[index].setSelectionRange(length, length);
        }else{
            allTextBoxes[index].disabled = true;
            allTextBoxes[index].style.borderColor = "white";
        }
    }
}

allButtons.forEach((element,index)=>{
    const listener = createClickListener(index);
    element.addEventListener('click', listener);
})
const input = document.getElementById('Female').checked;
console.log(input);