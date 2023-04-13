// import { admin_view_edit } from '../../src/js/admin_view_edit_category.js';
let addBtn = document.querySelector(".add-product");
addNewCat();
let currentIndex = 0;
addBtn.addEventListener("click", (e) => {
  document.querySelector(".side-bar").classList.remove("active");
  document.querySelector(".menu-btn").style.visibility = "visible";
  e.preventDefault();
  let formData = new FormData();
  formData.append("type", "GetPage");
  axios
    .post("/api/add_product", formData)
    .then((Response) => {
      // console.log(Response.data)
      // console.log('here')
      let isAdded = DisplayAdminViews(Response.data.html);
      // console.log(Response);
      createScriptElem("./src/js/add_product_ui.js", "addProScript");
      createScriptElem("./src/js/addProduct.js", "addProScript");
    })
    .catch((error) => {
      // console.log(error);
    });
});
function createScriptElem(
  path,
  name,
  elem = document.head,
  callback = undefined
) {
  var scriptElement = document.createElement("script");
  scriptElement.src = path;
  scriptElement.className = name;
  // Append the script element to the body of the document
  elem.appendChild(scriptElement);
  if (callback) {
    scriptElement.onload = callback;
  }
  // document.querySelector('.addProScript').remove();
}

// render admin views from api call
function DisplayAdminViews(Contetnt) {
  const container = document.querySelector(".change");
  let scripts = document.querySelectorAll(".addProScript");

  if (scripts.length <= 0) {
    const newElement = document.createElement("div");
    newElement.className = "temp-form";
    newElement.style.position = "absolute";
    newElement.style.width = "100%";
    newElement.style.top = "0";
    newElement.style.height = "100%";

    newElement.innerHTML = Contetnt;
    container.appendChild(newElement);
    return 1;
  } else {
    return 0;
  }
}

// edit product page part
let ProId;
let editProductBtn = document.querySelectorAll(".editProduct");
let allForms = document.querySelectorAll(".cartForm");
editProductBtn.forEach((element, index) => {
  element.addEventListener("click", (e) => {
    e.preventDefault();
    const cardData = new FormData(allForms[index]);
    axios.post("/api/edit_product", cardData).then((Response) => {
      console.log(Response.data.formData);
      ProId = Response.data.formData.ProductId;
      DisplayAdminViews(Response.data.html);
      // console.log(Response.data.formData);
      fillDataEditForm(Response.data.formData);
      createScriptElem("./src/js/edit_product_ui.js", "editProductScript");
      createScriptElem("./src/js/edit_product.js", "editProductScript");
      // createScriptElem('./src/js/add_product_ui.js', "editProductScript");
    });

    const formData = new FormData();

    axios
      .post("/api/edit_product", formData)
      .then((response) => {})
      .catch((error) => {
        console.error(error);
      });
  });
});

function openEditFormWrapper(event, element, index) {
  openEditForm(index);
}

function openEditForm(event, element, index) {
  event.preventDefault();
  let editProductBtn = document.querySelectorAll(".editProduct");
  let allForms = document.querySelectorAll(".cartForm");
  const cardData = new FormData(allForms[index]);
  axios.post("/api/edit_product", cardData).then((Response) => {
    ProId = Response.data.formData.ProductId;
    console.log(Response.data.formData);
    DisplayAdminViews(Response.data.html);
    // console.log(Response.data.formData);
    fillDataEditForm(Response.data.formData);
    createScriptElem("./src/js/edit_product_ui.js", "editProductScript");
    createScriptElem("./src/js/edit_product.js", "editProductScript");
    // createScriptElem('./src/js/add_product_ui.js', "editProductScript");
  });

  const formData = new FormData();

  axios
    .post("/api/edit_product", formData)
    .then((response) => {})
    .catch((error) => {
      console.error(error);
    });
}

function fillDataEditForm(data) {
  let editProForm = document.querySelectorAll(
    "#editProduct input, #editProduct textarea"
  );
  // console.log(editProForm);
  // console.log(data);
  editProForm.forEach((element) => {
    if (element.name == "product_title") {
      element.value = data.ProductTitle;
      return;
    }
    if (element.name == "product_price") {
      element.value = data.ProductPrice;
      return;
    }
    if (element.name == "product_desc") {
      element.value = data.ProductDesc;
      return;
    }
    if (element.name == "product_keywords") {
      element.value = data.ProductKeywords;
      return;
    }
    if (element.name == "QOH") {
      element.value = data.QuantityOnHand;
      return;
    }
    if (element.name == "img_dir") {
      element.value = data.ProductImg;
    }
  });
  let imgView = document.querySelectorAll(".img-text");
  // console.log(data.imgs);

  data.imgs.forEach((element, index) => {
    // console.log('running');
    imgView[index].style.display = "block";
    imgView[index].innerHTML = element;
  });
  let drop = document.querySelector(".Subcategory");
  data.cats.forEach((element, index) => {
    // console.log(element)
    drop.innerHTML += `
    <option value="${element.CategoryName}" class="option">${element.CategoryName}</option>`;
  });
  let mainCats = document.querySelector(".MainCategory");

  data.mainCats.forEach((element, index) => {
    mainCats.innerHTML += `<option value="${element.MainCategoryId}" class="option">${element.MainCategoryName}</option>`;
  });
  let brands = document.querySelector(".Brand");
  data.brands.forEach((element) => {
    brands.innerHTML += `<option value="${element.BrandId}" class="option">${element.BrandName}</option>`;
  });
}
let dataBuffer = [];

let paginationEditCategory;
// edit category
// let editCatBtn = document.querySelector('.categoryedit');
// // console.log(editCatBtn);
// editCatBtn.addEventListener('click', (e)=>{
//   e.preventDefault();
//   let formData = new FormData();
//   formData.append('process', 'getView');
//   axios.post('/api/edit_category', formData).then(response =>{
//     dataBuffer = [...response.data.data];

//     // console.log(response.data.data);
//     renderData(dataBuffer, response.data.html, 0, response.data.records);
//     // console.log(response.data.records)
//     createScriptElem('./src/js/edit_category.js','categoryJs');
//     // console.log(response.data);
//     paginationEditCategory = response.data.records;
//   })

// })

function renderData(data, html, currentIndex, records) {
  const contentParent = document.getElementById("content").parentElement;

  // Create a temporary div element and set its innerHTML to the response HTML
  const tempDiv = document.createElement("div");
  tempDiv.innerHTML = html;

  // Get the new content element from the temporary div
  const newContent = tempDiv.firstChild;

  // Replace the existing content with the new content
  const contentElement = document.getElementById("content");
  contentElement.innerHTML = "";
  contentElement.appendChild(newContent);

  // console.log(response.data.data);

  createDataTable(data, currentIndex, records);

  // console.log('here');
}
// function createDataTable(data,currentIndex, records){
//   let tableBody = document.querySelector('.table-body');
//     data.forEach((element, index)=>{
//       currentIndex ++;
//       tableBody.innerHTML += `
//       <tr class="text-center table-data">
//         <td class="serNo"><form class='catIdForm'>${currentIndex}<input type = 'hidden' name="CategoryId" value='${element.CategoryId}'></form></td>
//         <td class="title cat-title">${element.CategoryName}</td>
//         <td><a href="" name="edit_category" class="text-light edit_category" onClick="editCategoryBtnHandler(event, this)"><i class="fa-solid fa-pen-to-square"></i></a></td>
//         <td><a href="#" class="text-light deleteCategory" onClick = "deleteCategory(event, this)" ><i class="fa-solid fa-trash " ></i></a></td>

//     </tr>
//       `;
//     })
//       tableBody.innerHTML+= `
//       <tr class="text-center">
//       <td></td>
//       <td class="addBtn"><a href="" class="text-light addNewCategory" >+</a></td>
//       <td></td>
//       <td><button class="catNameBtn" name="catName" onClick='submitNewCat()'>save</button></td>
//       </tr>
//       `;
//       addNewCat();
//       // editCategoryBtnHandler();
//       // clickListener();

// }
function displayPagination(records) {
  // console.log(Math.ceil(records/25));
  // console.log(records);
  let paginationMain = document.querySelector(".pagination-main");
  paginationMain.innerHTML = `	<nav aria-label="Page navigation example container">
  <ul class="pagination">
    
  
    
    
  </ul>`;
  let pagingation = document.querySelector(".pagination");
  pagingation.innerHTML += `<li class="page-item "><a class="page-link" href="#">Previous</a></li>`;
  for (let i = 0; i < Math.ceil(records / 25); i++) {
    pagingation.innerHTML += `<li class="page-item"><a class="page-link" href="">${
      i + 1
    }</a></li>`;
  }
  pagingation.innerHTML += `<li class="page-item "><a class="page-link" href="#">Next</a></li>`;
}

function addNewCat() {
  // console.log("hel");
  let newCatBtn = document.querySelector(".addNewCategory");
  if (newCatBtn != undefined) {
    newCatBtn.addEventListener("click", (e) => {
      e.preventDefault();
      // adding text box same place where + button is
      document.querySelector(".addBtn").innerHTML =
        '<form class="addCategoryForm"><input type="text" name="catName"></form>';

      // submitNewCat();
    });
  }
}
let indexOfProducts = 1;
// function to open edit category page
function editCategoryBtnHandler(event, button, index) {
  // let index = button.parentNode.parentNode.rowIndex;
  console.log(document.querySelectorAll(".catIdForm")[index].value);
  event.preventDefault();
  // getting edit page
  let reqMessage = new FormData();
  reqMessage.append(
    "CategoryId",
    document.querySelectorAll(".catIdForm")[index].value
  );
  reqMessage.append("process_category_page", "get_page");
  axios.post("/api/Edit_products_category", reqMessage).then((response) => {
    console.log(response.data.totalRecords);

    renderEditCategoryPage(response.data.html);

    renderProductsWithCat(response.data.data, response.data.totalRecords);

    createScriptElem(
      "../src/js/admin_view_edit_category.js",
      "admin_view_edit_category",
      document.body
    );

    document.querySelector(".pagination-main").remove();

    document.querySelector(".search_cat_input").value =
      response.data.data[0].CategoryName;

    // renderProductsWithCat(response.data.data);
  });
}

function renderEditCategoryPage(html) {
  // console.log(html);
  const contentParent = document.getElementById("content").parentElement;

  // Create a temporary div element and set its innerHTML to the response HTML
  const tempDiv = document.createElement("div");
  tempDiv.innerHTML = html;

  // Get the new content element from the temporary div
  const newContent = tempDiv.firstChild;

  // Replace the existing content with the new content
  const contentElement = document.getElementById("content");
  contentElement.innerHTML = "";
  contentElement.appendChild(newContent);
}
function renderProductsWithCat(data, records) {
  let container = document.querySelector(".tableBody");
  data.forEach((element, index) => {
    if (element.ProductId == undefined) {
      return 0;
    }
    container.innerHTML += `<tbody class="text-center">

          <tr class="dataRows">

            <td>${indexOfProducts++}</td>

            <td>${element.ProductId} <input type="hidden" name="proId" value="${
      element.ProductId
    }"></td>

            <td>${
              element.ProductTitle
            }<input type='hidden' class='iprice' value='' > </td>

            <td>


                <input type='number' class='text-center iqty' name='mod_qty' onchange='' min='1'

                  max='' value='${element.ProductPrice}'>

            </td>

            <input type='hidden' name='Item_Name' value=''>


            <td class='itotal'> <input type='number' class='text-center iqty' name='mod_qty' onchange='' min='0'

            max='' value='${element.QuantityOnHand}'> </td>

            <td>${
              element.ProductStatus != "Available"
                ? `<form action='manage_cart.php' method='post'>
              <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled' onclick = 'deltePro(event,this)'><i
                      class='fa-solid fa-trash'></i></button>
              <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
          </form>

      </td>`
                : `<form action='manage_cart.php' method='post'>
              <button name='Remove_Item' class='btn btn-sm btn-outline-danger' ><i
                      class='fa-solid fa-trash'></i></button>
              <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
          </form>

      </td>`
            }

            <td>${
              element.ProductStatus != "Available"
                ? `<form action='manage_cart.php' method='post'>
              <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled' onclick = "updateProductCategoryTable(event, this)">Save</button>
              <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
              </form>
              
              </td>`
                : `<form action='manage_cart.php' method='post'>
              <button name='Remove_Item' class='btn btn-sm btn-outline-danger ' >Save</button>
              <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
              </form>
              
              </td>`
            }
            
            
          </tr>

          </tbody>
          `;
  });
  if (records > 20) {
    // <button name='Remove_Item' class='btn btn-sm btn-outline-danger' onclick="">Save</button>
    if (document.querySelector(".LoadMoreProduct") != undefined) {
      document.querySelector(".LoadMoreProduct").remove();
    }
    // document.getElementById('content').innerHTML += `<div class="container-fluid d-flex justify-content-center"><button name="Load more " onClick = "loadMore()" value="Load More.." class="btn btn-info px-3 mb-3 LoadMoreProduct "></button></div>`
    const container = document.createElement("div");
    container.innerHTML = `<button name="Load more " onClick = "loadMore()" value="Load More.." class="btn btn-info px-3 mb-3 LoadMoreProduct ">Load More..</button>`;
    document.getElementById("content").appendChild(container);
  } else {
    if (document.querySelector(".LoadMoreProduct") != undefined) {
      document.querySelector(".LoadMoreProduct").remove();
    }
  }
}

let currentOffsetAllOrders = 0;
let currentStatusSearch = 'Default';
let currentSearch = null;
function getAllOrders(event) {
  currentOffsetAllOrders = 0;
  event.preventDefault();
  document.body.style.backgroundColor = "white";
  event.preventDefault();
  let formData = new FormData();
  formData.append("admin_order_page_process", "get_order_page");
  formData.append("offset", currentOffsetAllOrders);
  formData.append("orderStatus", "Default");
  // formData.append("search", currentSearch);
  console.log(formData);
  axios.post("/api/get_all_orders", formData).then((Response) => {
    renderEditCategoryPage(Response.data.html);
    document.querySelector(".orderStatus").value = currentStatusSearch;
    renderOrders(Response.data.orderData);
    document.querySelector('.default-selection').selected = true;
    console.log(Response.data.orderData);
  });
}

function renderOrders(data) {
  let container = document.querySelector(".tableBody");
  data.forEach((element, index) => {
    container.innerHTML += `<tr>
        <td>${++currentOffsetAllOrders}</td>
        <td>${element.ProductId}</td>
        
        <td>${
          element.CustomerId
        }<input type='hidden' class="orderId" value='${element.OrderId}'></td>
        <td >
        ${element.OrderId}
        <td >${element.Quantity}</td>
        <td >${element.TotalPrice}</td>
        <td >${element.PlacedOn}</td>
        <td class="status">${element.OrderStatus}</td>
        <td>
        ${
          element.OrderStatus == "Cancelled"
            ? `<form action='manage_cart.php' method='post'>
        <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled cancelOrder' onclick= "cancelOrder(event,this,${currentOffsetAllOrders})"><i
            class='fa-solid fa-trash'></i></button>
        <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
      </form>`
            : `<form action='manage_cart.php' method='post'>
      <button name='Remove_Item' class='btn btn-sm btn-outline-danger cancelOrder' onclick= "cancelOrder(event,this,${currentOffsetAllOrders})"><i
          class='fa-solid fa-trash'></i></button>
      <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
    </form>`
        }

        
        </td>
        <td>
        ${
 element.OrderStatus  != 'Placed' ? `<form action='manage_cart.php' method='post'>
      <button name='Remove_Item' class='btn btn-sm btn-outline-danger  placeOrder' onclick = "placeOrderAdmin(event, this, ${currentOffsetAllOrders})"><i class="fas fa-save"></i></button>
      <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
    </form>`:`<form action='manage_cart.php' method='post'>
    <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled placeOrder' onclick= " placeOrderAdmin(event, this, ${currentOffsetAllOrders})"><i class="fas fa-save"></i></button>
    <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
  </form>`
        }
      </td>
      </tr>`;
  });
  if (data.length >= 50) {
    if (document.querySelector(".paginationBtnUser") == undefined) {
      document.querySelector(
        ".pagination-main"
      ).innerHTML += `<button type="button" class="btn btn-primary paginationBtnUser" onclick="laodMoreOrdersAdmin()">Load More...</button>`;
    }
  } else {
    if (document.querySelector(".paginationBtnUser") != undefined) {
      document.querySelector(".paginationBtnUser").remove();
    }
  }
}
function laodMoreOrdersAdmin() {
  let formData = new FormData();
  formData.append("admin_order_page_process", "get_order_page");
  formData.append("orderStatus", currentStatusSearch);
  formData.append("search", currentSearch);

  formData.append("offset", currentOffsetAllOrders);
  axios.post("/api/get_all_orders", formData).then((Response) => {
    renderOrders(Response.data.orderData);
  });
}

function filterOrders(e, btn) {
  let formData = new FormData();
  formData.append("admin_order_page_process", "get_order_page");
  formData.append("search", currentSearch);
  formData.append("offset", 0);
    currentStatusSearch = btn.value;
  console.log(currentStatusSearch);
  formData.append("orderStatus", currentStatusSearch);
  axios.post("/api/get_all_orders", formData).then((Response) => {
    currentOffsetAllOrders = 0;
    // console.log(Response.data);
    console.log(formData);
    renderEditCategoryPage(Response.data.html);
    document.querySelector(".orderStatus").value = currentStatusSearch;

    renderOrders(Response.data.orderData);
  });
}

function serachOrder(e) {
  e.preventDefault();
  if(document.querySelector('#CusId').value == ""){
    getAllOrders(e);

  }
  if(isPositiveInteger(document.querySelector('#CusId').value)){
    currentSearch = document.querySelector('#CusId').value;
    let formData = new FormData();
    formData.append("admin_order_page_process", "get_order_page");
    formData.append("search", currentSearch);
    formData.append("offset", 0);
    // currentStatusSearch = btn.value;
    console.log(currentStatusSearch);
  
    formData.append("orderStatus", currentStatusSearch);
    axios.post("/api/get_all_orders", formData).then((Response) => {

      currentOffsetAllOrders = 0;
      console.log(Response.data);
      console.log(formData);
      renderEditCategoryPage(Response.data.html);
      document.querySelector(".orderStatus").value = currentStatusSearch;
  
      renderOrders(Response.data.orderData);
    });
  }
}
function isPositiveInteger(n) {
  return /^\d+$/.test(n);
}
function placeOrderAdmin(e,btn, index){
  e.preventDefault();
  let formData = new FormData();
  formData.append("admin_order_page_process", "placeOrder");
  // console.log(document.querySelectorAll('.orderId')[index].value)
  formData.append("OrderId", document.querySelectorAll('.orderId')[index -1].value);
  axios.post('/api/get_all_orders', formData).then(response =>{
    console.log(response.data);
    if(response.data.text == 1){
      createAlert('success', 'Order has been placed successfully!', '');
      btn.classList.add('disabled');
      document.querySelectorAll('.cancelOrder')[index-1].classList.remove('disabled');
      document.querySelectorAll('.status')[index -1].textContent = "Placed";

      return;
    }else{
      createAlert('warning', 'Failed Placing Order', '');
      return;
    }
  })
}
function cancelOrder(e,btn,index){
  e.preventDefault();
  let formData = new FormData();
  formData.append("admin_order_page_process", "cancelOrder");
  console.log(document.querySelectorAll('.orderId')[index -1].value);
  // console.log(document.querySelectorAll('.orderId')[index].value)
  formData.append("OrderId", document.querySelectorAll('.orderId')[index -1].value);
  axios.post('/api/get_all_orders', formData).then(response =>{
    console.log(response.data);

    if(response.data.text == 1){
      createAlert('success', 'Order has been cancelled successfully!', '');
      btn.classList.add('disabled');
      document.querySelectorAll('.status')[index-1].textContent  = "Cancelled";
      document.querySelectorAll('.placeOrder')[index-1].classList.remove('disabled');
      btn.classList.add('disabled')
      return;
    }else{
      createAlert('warning', 'Failed cancelling Order', '');
      return;
    }
  })
}
// //////////////////////////////////////////////////////////////////////////
// User section
