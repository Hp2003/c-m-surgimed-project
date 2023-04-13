let list = [2190, 1460, 815, 1419];
let maxDatasetValue = 100000;
let maxYAxisTicks = 11;

var determineStepSize = function(maxDatasetValue) {
 var maxStepTemp = Math.ceil(maxDatasetValue / maxYAxisTicks);
 // Determine what the step should be based on the maxStepTemp value
    if (maxStepTemp > 4000000) step = 8000000;
    else if (maxStepTemp > 2000000) step = 4000000;
    else if (maxStepTemp > 1000000) step = 2000000;
    else if (maxStepTemp > 500000) step = 1000000;
    else if (maxStepTemp > 250000) step = 500000;
    else if (maxStepTemp > 100000) step = 200000;          
    else if (maxStepTemp > 50000) step = 100000;
    else if (maxStepTemp > 25000) step = 50000;
    else if (maxStepTemp > 10000) step = 20000;
    else if (maxStepTemp > 5000) step = 10000;
    else if (maxStepTemp > 2500) step = 5000;
    else if (maxStepTemp > 1000) step = 2000;
    else if (maxStepTemp > 500) step = 1000;
    else step = 500;                   
    return step;
}
// console.log(determineStepSize(maxDatasetValue) )
// let list = [2190, 1460, 815, 1419];

// let maxValue = Math.max(...list);
// stepSize = (maxValue, numberOfRowsYouWant) => {
//     return parseInt((maxValue / (numberOfRowsYouWant - 1)).toFixed(0));
//   } 
// console.log(stepSize(955,11));

function disableInputs(process){
  if (typeof process !== 'boolean' && typeof process !== 'number') {
    throw new Error('Parameter must be a boolean or a number');
  }
  let container = document.querySelector('.compareContainer')
  let inputs = container.querySelectorAll('input,select' );
  // console.log(inputs)
  inputs.forEach(Element =>{
    Element.disabled = process;
  })
}
function randerCompareBox(visiblity){
  let container = document.querySelector('.compareContainer')
  container.style.display = visiblity;
}
disableInputs(true);
randerCompareBox('none');

function showCompareForm(e,btn){
  let graphBtn = document.querySelector('.genGraph');
  if(btn.checked == true){
    graphBtn.style.display = 'none';
    disableInputs(false);
    randerCompareBox('block')
  }else{
    graphBtn.style.display = 'inline';

    disableInputs(true);
    randerCompareBox('none')
  }
}

// ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function genGraph(event, button){
  event.preventDefault();
  if(button.value == 'normalGraph'){
    console.log('generating normal graph')
  }else{
    console.log('comparing graph')
  }
}

function fillMainCategory(){
  // making request to get main categorys
  let formData = new FormData();
  formData.append('process', 'get_main_categorys')
  axios.post('/graph_genrator', formData).then(Response =>{
    // console.log(Response)
    fillSelectionBoxes('main-main_category', Response.data.data,['MainCategoryId','MainCategoryName'], false)
    
})
}
fillMainCategory();

function fillSelectionBoxes(classname, valueArray,attributName, removeDefault = true, defaulValue = ``){
  let contaiener = document.querySelector(`.${classname}`)
  if(removeDefault){
    contaiener.innerHTML = defaulValue;
  }
  valueArray.forEach((Element, index)=>{
    contaiener.innerHTML += `<option value="${Element[attributName[0]]}" >${Element[attributName[1]]}</option>`
  })
}
function getSubCategory(e,btn){
  let formData = new FormData();
  formData.append('process', 'get_sub_categorys') ;
  formData.append('id', btn.value);
  // console.log(btn.value)
  axios.post('/graph_genrator', formData).then(Response =>{
    fillSelectionBoxes('main-sub_category',Response.data.data,['CategoryId', 'CategoryName'],true, '<option value="" selected>Default</option>' );
  })
}
let year ;
async function getFirstYear() {
  let currentYear;
  // getting starting point
  let formData = new FormData();
  formData.append("process", "get_first_year");
  const response = await axios.post("/graph_genrator", formData);
  document.querySelector(".main-year").innerHTML += `<option value="" >Default</option>`;
  console.log(response.data.data);
   year = response.data.data;
  let years = getYears(response.data.data.substr(0, 4));
  let first = true;

  years.forEach((element) => {
    if(first ){
      document.querySelector(".main-year").innerHTML += `<option value="${response.data.data}" >${element}</option>`;
      first = false;
      return 0;
    }else{
      document.querySelector(".main-year").innerHTML += `<option value="${element}-01-01 00:00:00" >${element}</option>`;
    }
  });
  return year;
}

getFirstYear().then(()=>{
  // getMonths(year);
})
// console.log(year)
// getting all years form beginning
function getYears(startYear) {
  const currentYear = new Date().getFullYear();
  const years = [];
  for (let year = startYear; year <= currentYear; year++) {
    years.push(year);
  }
  return years;
}
let Months = {
  1:'january',
  2:'fabruary',
  3:'march',
  4:'April',
  5:'May',
  6:'June',
  7:'Julay',
  8:'Augast',
  9:'September',
  10:'Octomber',
  11:'November',
  12:'December'
};
function getMonths(year){
    let month 
    month = parseInt(year.substr(5,2));
    let months = (Object.values(Months).slice(month - 1));
    let container = document.querySelector('.main-month');
    container.innerHTML = `<option value="" >Default</option>`;
    // adding months to select
    months.forEach(element =>{
      container.innerHTML += `<option value="${month++}" >${element}</option>`
    })
}
function changeMonth(e,b){
  if(b.selectedIndex == 0){
    document.querySelector('.main-month').innerHTML = `<option value="" >Default</option>`
  }
  if(b.selectedIndex > 1 ){
    if(parseInt(b.value.substr(0,4)) == new Date().getFullYear() ){
      let month = new Date().getMonth();
      let months = (Object.values(Months).slice(0,month + 1));
      console.log(months)
      renderMonths('main-month',months, 1)
      return 0;
    }
    renderMonths('main-month',Object.values(Months), 1)
    return 0;
  }else if(b.selectedIndex == 1){
    getMonths(b.value);
  }
}
function renderMonths(classContainer, list, index){
  let container = document.querySelector(`.${classContainer}`);
  container.innerHTML = `<option value="" >Default</option>`
  list.forEach(element =>{
    container.innerHTML += `<option value="${index++}" >${element}</option>`
  })
}
// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
