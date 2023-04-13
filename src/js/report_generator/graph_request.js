let obj = null;
function genGraph(e, b) {
  e.preventDefault();
  if (obj != null) {
    obj.destroy();
  }
  let form = document.querySelector(".graphForm");
  let formData = new FormData(form);
  formData.append("graph_process", "get_normal_graph_data");
  axios.post("/graph_genrator", formData).then((Response) => {
    // let data = [...Response.data.data];
    let type = document.querySelector(".type").value;
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
    if (
      document.querySelector(".main-year").value != "" &&
      document.querySelector(".main-month").value == ""
    ) {
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
      if(document.querySelector(".inputProductId").value.trim() == ""){
        data = Response.data.data[0].map((element) => {
            return element.revenue;
        });
      }else if(document.querySelector(".inputProductId").value.trim() != ""){
        data = Response.data.data[0].map((element) => {
            return element.quty;
        });
      }

      data = fillMissingValues(data, dates,days,last_day_of_month)
      console.log(data);
      obj = graphGen(days, data);
    }
  });
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
    for (let i = 0; i < last_day_of_month; i++) {
        const num = parseInt(days[i]);
        if (dates.includes(i)) {
        } else {
          data.splice(i, 0, 0);
        }
      }
      return data;
}
