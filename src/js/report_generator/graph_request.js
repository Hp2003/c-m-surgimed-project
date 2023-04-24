let obj = null;
function genGraph(e, b) {
  let type = document.querySelector(".type").value;
  // console.log(type);
  e.preventDefault();
  if (obj != null) {
    obj.destroy();
  }
  
  let form = document.querySelector(".graphForm");
  let formData = new FormData(form);
  
  if(b.value == 'normalGraph'){

    formData.append("graph_process", "get_normal_graph_data");
    formData.append('normal_data',true)
    axios.post("/graph_genrator", formData).then((Response) => {
      // let type = document.querySelector(".type").value;
      if (document.querySelector(".main-year").value == "") {
        let data = [];
        if (type == "Revenue") {

          Response.data.data.forEach((element) => {
            data.push(parseInt(element.total_selling));
          });
  
          obj = graphGen(Response.data.years, data);
        } else {
          Response.data.data.forEach((element) => {
            data.push(parseInt(element.total_units_sold));
          });
          obj = graphGen(Response.data.years, data);
        }

    }
      // console.log(Response.data.data);
      if (document.querySelector(".main-year").value != "" &&
        document.querySelector(".main-month").value == "") {

        let labels = filterYeras(Response.data.labels[0]);
        if (type == "Revenue") {
          let data = Response.data.data.map((element) => {
            return element.total_selling;
          });
          let monthNames = Object.values(Months).slice(labels[0] - 1);
          obj = graphGen(monthNames, data);
        } else {

          if (document.querySelector(".inputProductId").value.trim() != "") {

            let data = Response.data.data.map((element) => {
              return element.qty;
            });
            let monthNames = Object.values(Months).slice(labels[0] - 1);
            obj = graphGen(monthNames, data);
          } else {
            let data = Response.data.data.map((element) => {
              return element.total_units_sold;
            });
            let monthNames = Object.values(Months).slice(labels[0] - 1);
            obj = graphGen(monthNames, data);
          }
        }
      }
      if (document.querySelector(".main-month").value != "") {
          let data;
        // console.log(Response);
        console.log(Response);
        let days = [];
        const last_day_of_month = new Date(
          parseInt(document.querySelector(".main-year").value),
          parseInt(document.querySelector(".main-month").value) + 1,
          0
        ).getDate();
        for (let i = 1; i <= last_day_of_month; i++) {
          days.push(i);
        }
        
        let dates = Response.data.data[0].map((element) => {
          return parseInt(element.Day)
        });
        // let type1 = getType();

        if(type == 'Revenue'){

          if(document.querySelector(".inputProductId").value.trim() == ""){
            data = Response.data.data[0].map((element) => {
                return element.revenue;
            });
        }
      }else{
        console.log('here');

        console.log(type)

          data = Response.data.data[0].map((element) => {
            return element.total_units_sold;
          });
        }if(document.querySelector(".inputProductId").value.trim() != ""){
        data = Response.data.data[0].map((element) => {
          return element.quty;
        });
      }
      
      console.log(data);
        data = fillMissingValues(data, dates,days,last_day_of_month)
        // console.log(data);
        obj = graphGen(days, data);
      }
    });
  }else{
// ///////////////////////////////////////////
    // generating double bar graph   ////////
// /////////////////////////////////////////

    if(!checkInput()){
      return 0;
    }
    formData.append("graph_process", "get_normal_graph_data");
    formData.append('normal_data',true);
    axios.post("/graph_genrator", formData).then((Response) => {

      let resArray = [];
      let resLabels = [];
      // getting data for both inputs
      resArray['data1'] = Response.data
      
      formData.delete('normal_data');
      axios.post('/graph_genrator', formData).then(response =>{
        resArray['data2'] = response.data;
        console.log(resArray);
        genDoubleBarGraph(resArray);
      })
      
    })
  }
}
function getType(){
  let type = document.querySelector(".type").value;
  return type;
}
function checkInput(){
  let mainYear = document.querySelector('.main-year');
  let subYear = document.querySelector('.sub-year');
  let mainMonth = document.querySelector('.main-month');
  let subMonth = document.querySelector('.sub-month');
  let mainMainCategory = document.querySelector('.main-main_category');
  let subMainCategory = document.querySelector('.sub-main_category');
  let mainProId = document.querySelector('.main-pro_id');
  let subProid = document.querySelector('.sub-pro_id');
  let mainUserId = document.querySelector('.main-user_id');
  let subUsrId = document.querySelector('.sub-user_id');
  if(mainYear.value != "" && subYear.value == ""){
    window.alert('select Sub Year');
    return 0;
  }
  else if(mainYear.value == "" && subYear.value != ""){
    createAlert('warning', 'select Main Year', '');
    return 0;
  }
  else if(subMainCategory.value == "" && mainMainCategory.value != ""){
    // window.alert('');
    createAlert('warning', 'select Main Categroy', '');
    return 0;
  }else if(mainMonth.value != "" && subMonth.value == ""){
    // window.alert('select Sub Month');
    createAlert('warning', 'select Sub Month', '');
    return 0;
  }else if(mainMonth.value == "" && subMonth.value != ""){
    // window.alert('select Main Month');
    createAlert('warning', 'select Main Month', '');
    return 0;
  }
  else if(subMainCategory.value != "" && mainMainCategory.value == ""){
    // window.alert('select Sub Category');
    createAlert('warning', 'select Sub Categroy', '');
    return 0;
  }else if(mainProId.value.trim() != "" && subProid.value.trim() == ""){
    // window.alert('Enter Sub product Id')
    createAlert('warning', 'select Sub Product Id', '');
    return 0;
  }else if(mainProId.value.trim() == "" && subProid.value.trim() != ""){
    // window.alert('Enter Main product Id')
    createAlert('warning', 'select Main Product Id', '');
    return 0;
  }else if(mainUserId.value.trim() == "" && subUsrId.value.trim() != ""){
    // window.alert('Enter Main User Id')
    createAlert('warning', 'select Main User Id', '');

    return 0;
  }else if(mainUserId.value.trim()!== "" && subUsrId.value.trim() == ""){
    // window.alert('Enter Sub UserId Id')
    createAlert('warning', 'select Main Sub User Id', '');
    return 0;
  }
  // console.log('else');
  return 1;
}








// //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








function genDoubleBarGraph(Response){
  // console.log(document.querySelector(".main-month").value)

  let dataSetLabels ;
  let data1 = Response.data1.data;
  let data2 = Response.data2.data;
  let labels
  if(Response.data1.labels != undefined){
    labels = Response.data1.labels;
  }
  else if(Response.data1.years != undefined){
    labels = Response.data1.years;
  }
  let type = document.querySelector(".type").value;
  
  if (document.querySelector(".main-year").value == "") {
    let dataset1 = [];
    let dataset2 = [];
    if (type == "Revenue") {
      data1.forEach((element) => {
        dataset1.push(parseInt(element.total_selling));
      });
      data2.forEach((element) => {
        dataset2.push(parseInt(element.total_selling));
      });
      // console.log(labels);
      obj =  doubleBarGraph(labels, dataset1, dataset2);
      // graphGen(Response.data.years, data);
    } else {
      // selling based
      let dataset1 = [];
      let dataset2 = [];
      dataset1 = data1.map(element =>{
        return element.total_units_sold;
      })
      dataset2 = data2.map(element =>{
        return element.total_units_sold;
      })
      // console.log(data2.total_units_sold)
      obj = doubleBarGraph(labels, dataset1, dataset2);
    }
  }
  if (
    document.querySelector(".main-year").value != "" &&
    document.querySelector(".main-month").value == "" ||
    document.querySelector('.sub-year').value != "" &&
    document.querySelector('.sub-month').value == ""
  ) {

    // let labels = filterYeras(Response.data.labels[0]);
    if (type == "Revenue") {
      let dataset1 = [];
      let dataset2 = [];
       dataset1 = data1.map((element) => {
        return element.total_selling;
      });
       dataset2 = data2.map((element) => {
        return element.total_selling;
      });
      // console.log(data1)
      // getting  month names
       monthNames = Object.values(Months).slice(1 - 1);
      //  console.log(monthNames);
       let months1 = data1.map(element => {
        let monthInt = parseInt(element.month);
        return isNaN(monthInt) ? 0 : monthInt ;
      });

       let months2 = data2.map(element => {
        let monthInt = parseInt(element.month);
        return isNaN(monthInt) ? 0 : monthInt;
      });
      // console.log(dataset1);

      // removing nulls

      dataset1 = dataset1.map(element => Number.isNaN(parseInt(element)) ? 0 : parseInt(element));
      dataset2 = dataset2.map(element => Number.isNaN(parseInt(element)) ? 0 : parseInt(element));
      
      // console.log(dataset1)
      // console.log(data1)
      // console.log(dataset2)
      dataset1 = fillMissingValuesMonth(dataset1, months1)
      dataset2 = fillMissingValuesMonth(dataset2, months2)

      console.log(months1);
      // console.log(dataset2);

      obj = doubleBarGraph(monthNames, dataset1, dataset2);
    } else {
      let dataset1 = [];
      let dataset2 = [];
       dataset1 = data1.map((element) => {
        return element.total_units_sold;
      });
       dataset2 = data2.map((element) => {
        return element.total_units_sold;
      });
      // console.log(data1)
      // getting  month names
       monthNames = Object.values(Months).slice(1 - 1);
      //  console.log(monthNames);
       let months1 = data1.map(element => {
        let monthInt = parseInt(element.month);
        return isNaN(monthInt) ? 0 : monthInt ;
      });

       let months2 = data2.map(element => {
        let monthInt = parseInt(element.month);
        return isNaN(monthInt) ? 0 : monthInt;
      });
      // removing nulls
      dataset1 = dataset1.map(element => Number.isNaN(parseInt(element)) ? 0 : parseInt(element));
      dataset2 = dataset2.map(element => Number.isNaN(parseInt(element)) ? 0 : parseInt(element));
      
      dataset1 = fillMissingValuesMonth(dataset1, months1)
      dataset2 = fillMissingValuesMonth(dataset2, months2)
      console.log(dataset1);
      console.log(dataset2);
      obj = doubleBarGraph(monthNames, dataset1, dataset2);
    }
  }
  // //////////////////////////////////////////////////////////
  /////////     MONTH                        /////////////////
  /////////////////////////////////////////////////////////// 
  if (document.querySelector(".main-month").value != "") {
    // console.log(data1);
      console.log('in');
    // console.log(Response);
    let days = [];
    const last_day_of_month1 = new Date(
      parseInt(document.querySelector(".main-year").value),
      parseInt(document.querySelector(".main-month").value) + 1,
      0
    ).getDate();
    const last_day_of_month2 = new Date(
      parseInt(document.querySelector(".sub-year").value),
      parseInt(document.querySelector(".sub-month").value) + 1,
      0
    ).getDate();
      let dataset1 = [];
      let dataset2 = [];
      let dd = [];
      if(document.querySelector(".inputProductId").value.trim() == ""){
        dd =  getDatasetsMonth(data1, data2, 'revenue');
      }
      if(getType() == 'Sales'){
        dd =  getDatasetsMonth(data1, data2, 'total_units_sold');
      }if(document.querySelector(".inputProductId").value.trim() != ""){
        dd =  getDatasetsMonth(data1, data2, 'quty');
      }

      dataset1 = dd[0];
      dataset2 = dd[1];

      console.log(dataset1, dataset2)
    let dates1 = data1[0].map((element) => {
      return parseInt(element.Day)
    });
    let dates2 = data2[0].map((element) => {
      return parseInt(element.Day)
    });
    console.log(last_day_of_month2, last_day_of_month2);
    console.log(dates1, dates2);
    dataset1 = fillMissingValues(dataset1, dates1,[],last_day_of_month1)
    dataset2 = fillMissingValues(dataset2, dates2,[],last_day_of_month2)
    console.log(dataset1, dataset2);
    // // console.log(data);
    let date = [];
    for(let i = 1 ; i<=(last_day_of_month1 > last_day_of_month2?last_day_of_month1:last_day_of_month2) ; i++ ){
      date.push(i);
    }
    obj = doubleBarGraph(date,dataset1, dataset2);
  }
}

function getDatasetsMonth(data1, data2, type){
  let dataset1 = [], dataset2 = []
  dataset1 = data1[0].map((element) => {
    return element[type];
  });
   dataset2 = data2[0].map((element) => {
    return element[type];
  });
  return [dataset1, dataset2];
}

function graphGen(labels, data) {
  if (document.querySelector(".main-status").value == "Cancelled") {
    return genLineGraph(labels, data, "Cancelled");
  } else {
    return genLineGraph(labels, data, "Placed");
  }
}
function getData(data, key) {
  data.forEach((element) => {
    data.push(parseInt(element[key]));
  });
}
function filterYeras(data) {
  const years = data.map((element) => {
    return parseInt(element.substr(5, 2));
  });
  return years;
}

function fillMissingValues(data, dates,days,last_day_of_month){
  let resArray = [];
  let currentDate = 0;
  for(let i = 0 ; i<last_day_of_month ; i++){
      if(i + 1 != dates[currentDate] ){
          resArray.push(0);
      }else{
          resArray.push(data[currentDate])
          currentDate ++;
      }
  }
      return resArray;
}
function fillMissingValuesMonth(data, dates) {
  let output = [];
  let count = dates.indexOf(dates.find(val => val !== 0));
  let flag = false;
  for(let i = 0 ; i<12 ; i++){
    if(flag){
      count ++;
    }
    if(i + 1 == dates[count]){
      flag = true;
      output.push(data[count]);
    }else{
      output.push(0);
    }
  }
  return output;
}

