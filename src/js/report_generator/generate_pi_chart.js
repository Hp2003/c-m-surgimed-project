function genrateChart(event, btn, index){
    event.preventDefault();
    let totalUintsSold = parseInt(document.querySelectorAll('.units-sold-main')[index].textContent)
    let revenuemain = document.querySelectorAll('.revenue-main')[index].textContent
    let cancelledOrders = parseInt(document.querySelectorAll('.cancelled-orders')[index].textContent)

    createElement();
    const totalUnits = totalUintsSold + cancelledOrders;

    const soldUitsInPercentage =( totalUintsSold/totalUnits )* 100;
    const cancelledUitsInPercentage =( cancelledOrders/totalUnits )* 100;

    createCanvas([soldUitsInPercentage, cancelledUitsInPercentage], ['Units Sold', 'Cancelled Orders']);
}
function closeChart(){
    document.querySelector('.chart-container').remove();
}

function createCanvas(data1, names){
    var ctx = document.querySelector('.chart1').getContext('2d');
    let bgColors = [];
        // Define the data for the chart
        for(let i = 0 ; i< names.length ; i++){
            bgColors.push(`rgb(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.8)`);
        }
        var data = {
            labels: names,
            datasets: [{
                data: data1 ,
                backgroundColor: bgColors,
                borderColor: bgColors,
                borderWidth: 1
            }]
    };
    
    // Create the pie chart
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {}
    });
}
function createElement(){
    // Create a parent element for the canvas
    var parent = document.createElement('div');
    parent.className = 'chart-container';
    parent.style.width = '100vw' ;
    parent.style.height = '100vh' ;
    parent.style.position = 'absolute';
    parent.style.top = 1;
    parent.style.left = 0;
    parent.style.color = 'white';
    parent.style.backgroundColor = 'black';
    parent.style.zIndex = 999;
    parent.classList.add('d-flex','justify-content-center')
    parent.setAttribute('ondblclick','closeChart()')
    // Create the canvas element
    var canvas = document.createElement('canvas');
    canvas.className = 'chart1';
    
    canvas.style.height = '40%';
    canvas.style.width = '40%';
    canvas.style.position = 'absolute';
    canvas.style.zIndex = 9999;

    // Append the canvas to the parent
    parent.appendChild(canvas);

    // Append the parent to the document
    document.body.prepend(parent);
}

// functions to genrate charts
function genrateCombineRevenue(e,btn,condition){
    if(condition){
        let container = document.querySelector('.detail-tableBody');
        let sum = 0;
        const vals = container.querySelectorAll('.revenue-main')
        const titles = [];
        vals.forEach((Element, index)=>{
            sum += parseInt(Element.textContent)
            titles.push( container.querySelectorAll('.title')[index].textContent)
        })
        // console.log(sum);
        createElement();
        let chartData = [];
        vals.forEach((Element =>{
            chartData.push((parseInt(Element.textContent) / sum) * 100);
            console.log((parseInt(Element.textContent)));
        }))
        createCanvas(chartData,titles);
    }else{
        let container = document.querySelector('.summery-tableBody');
        let sum = 0;
        const vals = container.querySelectorAll('.revenue-main')
        const titles = [];
        vals.forEach((Element, index)=>{
            sum += parseInt(Element.textContent)
            titles.push( container.querySelectorAll('.title')[index].textContent)
        })
        // console.log(sum);
        createElement();
        let chartData = [];
        vals.forEach((Element =>{
            chartData.push((parseInt(Element.textContent) / sum) * 100);
            console.log((parseInt(Element.textContent)));
        }))
        createCanvas(chartData,titles);
    }
}
function genrateCombineSelling(e,btn,condition){
    let container = document.querySelector('.detail-tableBody');
    if(condition){
        let sum = 0;
        const vals = container.querySelectorAll('.units-sold-main')
        const titles = [];
        vals.forEach((Element, index)=>{
            sum += parseInt(Element.textContent)
            titles.push( container.querySelectorAll('.title')[index].textContent)
        })
        // console.log(sum);
        createElement();
        let chartData = [];
        vals.forEach((Element =>{
            chartData.push((parseInt(Element.textContent) / sum) * 100);
            console.log((parseInt(Element.textContent)));
        }))
        createCanvas(chartData,titles);
    }else{
        let container = document.querySelector('.summery-tableBody');
        let sum = 0;
        const vals = container.querySelectorAll('.units-sold-main')
        const titles = [];
        vals.forEach((Element, index)=>{
            sum += parseInt(Element.textContent)
            titles.push( container.querySelectorAll('.title')[index].textContent)
        })
        // console.log(sum);
        createElement();
        let chartData = [];
        vals.forEach((Element =>{
            chartData.push((parseInt(Element.textContent) / sum) * 100);
            console.log((parseInt(Element.textContent)));
        }))
        createCanvas(chartData,titles);
    }
}
function genrateCombineCancelled(e,btn,condition){
    let container = document.querySelector('.detail-tableBody');
    if(condition){
        let sum = 0;
        const vals = container.querySelectorAll('.cancelled-orders')
        const titles = [];
        vals.forEach((Element, index)=>{
            sum += parseInt(Element.textContent)
            titles.push( container.querySelectorAll('.title')[index].textContent)
        })
        // console.log(sum);
        createElement();
        let chartData = [];
        vals.forEach((Element =>{
            chartData.push((parseInt(Element.textContent) / sum) * 100);
            console.log((parseInt(Element.textContent)));
        }))
        createCanvas(chartData,titles);
    }else{
        let container = document.querySelector('.summery-tableBody');
        let sum = 0;
        const vals = container.querySelectorAll('.cancelled-orders')
        const titles = [];
        vals.forEach((Element, index)=>{
            sum += parseInt(Element.textContent)
            titles.push( container.querySelectorAll('.title')[index].textContent)
        })
        // console.log(sum);
        createElement();
        let chartData = [];
        vals.forEach((Element =>{
            chartData.push((parseInt(Element.textContent) / sum) * 100);
            console.log((parseInt(Element.textContent)));
        }))
        createCanvas(chartData,titles);
    }
}