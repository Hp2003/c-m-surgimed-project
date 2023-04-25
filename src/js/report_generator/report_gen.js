let currentForm;
function fillMainCategorys() {
  let formData = new FormData();
  let container = document.querySelector(".main_category");
  formData.append("process", "get_main_categorys");
		container.innerHTML = '<option value="" selected>Default</option>'
    let select = true;
  axios.post("/api/get_report", formData).then((Response) => {
    
    Response.data.data.forEach((element, index) => {
      if(select == true){
        container.innerHTML += `<option value="${element.MainCategoryId}" selected>${element.MainCategoryName}</option>`;
        select = false;
        return;
      }else{
        container.innerHTML += `<option value="${element.MainCategoryId}">${element.MainCategoryName}</option>`;
      }
    });
  });
}
fillMainCategorys();

function getSubCategory(e, btn) {
  // console.log(btn.value)
  // making request to get sub category
  let formData = new FormData();
  let container = document.querySelector(".sub_category");
  if (btn.value == "") {
    container.innerHTML = `<option value="" selected>Default</option>`;
    return 1;
  }
  formData.append("process", "get_sub_categorys");
  formData.append("mainId", btn.value);

  container.innerHTML = `<option value="" selected>Default</option>`;
  axios.post("/api/get_report", formData).then((Response) => {
    // rendering sub category
    // console.log(Response);
    Response.data.data.forEach((element, index) => {
      container.innerHTML += `<option value="${element.CategoryId}" >${element.CategoryName}</option>`;
    });
  });
}

function rednerDefaultView() {
  let formData = new FormData();
  let form = document.querySelector('.reportForm');
  formData.append("process", "start_page");

  axios
    .post("/api/get_report", formData)
    makeRequest(form);
}
rednerDefaultView();

function renderDetailView(data) {
  let container = document.querySelector(".detail-tableBody");
  data.forEach((element, index) => {
    container.innerHTML += `<tr>
            <td>${index + 1}</td>
            <td>${element.main_category_id}</td>
            <td>${element.main_category_name}</td>
            <td>${element.total_units_sold}</td>
            <td>&#8377; ${parseInt(element.total_selling).toLocaleString(
              "en-us",
              { useGrouping: true }
            )}</td>
            <td> - </td>
            <td>${element.cancelled_orders}</td>
            <td>${parseInt(element.cancelled_orders + element.total_units_sold).toLocaleString(
                "en-us",
                { useGrouping: true }
              )}</td>
        </tr>`;
  });
}

function renderSummeryView(data) {
  let container = document.querySelector(".summery-tableBody");
  data.forEach((element, index) => {
    container.innerHTML = "";
    container.innerHTML += `<tr>
            <td>${index + 1}</td>
            <td> - </td>
            <td> - </td>
            
            <td>${parseInt(element.total_units_sold).toLocaleString("en-us", {
              useGrouping: true,
            })}</td>
            <td>&#8377; ${parseInt(element.total_selling).toLocaleString(
              "en-us",
              { useGrouping: true }
            )}</td>
            <td>${parseInt(element.cancelled_orders).toLocaleString("en-us", {
              useGrouping: true,
            })}</td>
            <td>${parseInt(
              element.cancelled_orders + element.total_units_sold
            ).toLocaleString("en-us", { useGrouping: true })}</td>
        </tr>`;
  });
}
// ////////////////////////////////////////////////////////////////////////////////////////////////
function generateReport(e, btn) {
  e.preventDefault();
  let form = document.querySelector(".reportForm");
  currentForm = form;
  // console.log(form);
  makeRequest(form);
}

function makeRequest(data) {
  let formData = new FormData(data);

  formData.set("start_time", formData.get("start_time").replace("T", " "));
  formData.set("end_time", formData.get("end_time").replace("T", " "));
  formData.set('get_summery', true);
  formData.append("process", "get_data");
  // console.log(formData);
  axios.post("/api/get_report", formData).then((Response) => {
    currentOffset = 0;
    console.log(Response.data);
    genTableFromDesicion(Response.data, true);

  });
}
function changeHeader() {
  let container = document.querySelector(".header-summary");
  container.innerHTML = "";
  container.innerHTML += `
        <th scope="col">Serial No.</th>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
    `;
}
function renderSummary(data) {
  let container = document.querySelector(".summery-tableBody");
  data.forEach((element, index) => {
    container.innerHTML = "";
    container.innerHTML += `<tr>
            <td>${index + 1}</td>
            <td> ${element.main_category_id}</td>
            <td> ${element.main_category_name} </td>
            
            <td>${parseInt(element.total_units_sold).toLocaleString("en-us", {
              useGrouping: true,
            })}</td>
            <td>&#8377; ${parseInt(element.total_selling).toLocaleString(
              "en-us",
              { useGrouping: true }
            )}</td>
            <td>${parseInt(element.cancelled_orders).toLocaleString("en-us", {
              useGrouping: true,
            })}</td>
            <td>${parseInt(
              element.cancelled_orders + element.total_units_sold
            ).toLocaleString("en-us", { useGrouping: true })}</td>
        </tr>`;
  });
}
function renderDetails(data) {
  let container = document.querySelector(".detail-tableBody");
  container.innerHTML = "";
  data.forEach((element, index) => {
    container.innerHTML += `<tr>
            <td>${index + 1}</td>
            <td>${element.category_id}</td>
            <td>${element.category_name}</td>
            <td>${element.total_units_sold}</td>
            <td>&#8377; ${parseInt(element.total_selling).toLocaleString(
              "en-us",
              { useGrouping: true }
            )}</td>
            <td> - </td>
            <td>${element.cancelled_orders}</td>
            <td>${parseInt(
                element.cancelled_orders + element.total_units_sold
              ).toLocaleString("en-us", { useGrouping: true })}</td>
        </tr>`;
  });
}
function renderProducts() {}


  function dateRender() {
    const currentDate = new Date();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const date = String(currentDate.getDate()).padStart(2, '0');
    const year = String(currentDate.getFullYear());
    const hour = String(parseInt(currentDate.getHours()) < 12 ? "0" + currentDate.getHours() : currentDate.getHours());
    const minutes = String(currentDate.getMinutes()).padStart(2, '0');
    const seconds = String(currentDate.getSeconds()).padStart(2, '0');
 
    // console.log(hour)
    const fullDate = `${year}-${month}-${date}T${hour}:${minutes}:${seconds}`;
    // console.log(fullDate);
    document.querySelector('.max-date').value = fullDate;
    document.querySelector('.max-date').setAttribute('max', currentDate.toISOString().slice(0, 16));
    document.querySelector('.start-time').max = fullDate;
    console.log(fullDate);
  }

  dateRender();
