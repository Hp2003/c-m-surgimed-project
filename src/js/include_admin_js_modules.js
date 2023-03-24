let addBtn = document.querySelector(".add-product")
addBtn.addEventListener("click", (e) => {
    document.querySelector('.side-bar').classList.remove('active');
    document.querySelector('.menu-btn').style.visibility = "visible";
    e.preventDefault();
    let formData = new FormData();
    formData.append("type", "GetPage");
    axios
      .post("/api/add_product", formData)
      .then((Response) => {
        // console.log(Response.data)
        // console.log('here')
        let isAdded = DisplayAdminViews(Response.data.html);
        
        Response.data.categorys.forEach((element,index) => {
          document.querySelector('.dropDown').innerHTML += `
					<option value="${element}" class="option" style="color:black">${element}</option>`
        });
        // console.log(Response);
        createScriptElem("./src/js/add_product_ui.js", 'addProScript');
        createScriptElem("./src/js/addProduct.js", 'addProScript');
  
        
      })
      .catch((error) => {
        console.log(error);
      });
  });
  function createScriptElem(path, name) {
    var scriptElement = document.createElement("script");
    scriptElement.src = path;
    scriptElement.className = name;
    // Append the script element to the body of the document
    document.head.appendChild(scriptElement);
    // document.querySelector('.addProScript').remove();
  }
  // render admin views from api call
  function DisplayAdminViews(Contetnt) {
    const container = document.querySelector(".change");
    let scripts = document.querySelectorAll(".addProScript");
    
    if(scripts.length <= 0){
      const newElement = document.createElement("div");
      newElement.className = "temp-form";
      newElement.style.position = "absolute";
      newElement.style.width = "100%";
      newElement.style.top = "0";
      newElement.style.height = "100%";
  
      newElement.innerHTML = Contetnt;
      container.appendChild(newElement);
      return 1;
    }else{
      return 0;
    }
    
  }

// edit product
let editProductBtn = document.querySelectorAll(".editProduct");

let allForms = document.querySelectorAll('.cartForm');
console.log(allForms)
editProductBtn.forEach((element, index)=>{
  element.addEventListener('click', (e)=>{
    e.preventDefault();
    const cardData = new FormData(allForms[index]);
    axios.post("/api/edit_product", cardData).then((Response) => {
      // popup.innerHTML = Response.data;
      DisplayAdminViews(Response.data.html);
      createScriptElem('./src/js/edit_product_ui.js', "editProductScript");
      // createScriptElem('./src/js/add_product_ui.js', "editProductScript");
      
      fillDataEditForm(Response.data.formData);
  //     console.log(Response.data.formData);
  // console.log(Response.data.catname);

    });
    const formData = new FormData();
    formData.append("type", "some type");
    // append any other form data key-value pairs as needed
  
    axios
      .post("/api/edit_product", formData)
      .then((response) => {
      //   console.log(response);
      })
      .catch((error) => {
        console.error(error);
      });
  })
})
// fill data in edit product form
function fillDataEditForm(data){
  let editProForm = document.querySelectorAll('#editProduct input, #editProduct textarea');
  // console.log(editProForm);
  // console.log(data);
  editProForm.forEach(element =>{
    if(element.name == 'product_title'){
      element.value = data.ProductTitle;
      return;
    } if(element.name == 'product_price'){
      element.value = data.ProductPrice;
      return;
    } if(element.name == 'product_desc'){
      element.value = data.ProductDesc;
      return;
    } if(element.name == 'product_keywords'){
      element.value = data.ProductKeywords;
      return;
    }
  })
  let imgView = document.querySelectorAll('.img-name');
  console.log(data.imgs);
  
  data.imgs.forEach((element, index)=>{
    console.log('running');
    imgView[index].style.display = 'block';
    imgView[index].value = element;
  })
  let drop = document.querySelector('.dropDown');
  data.cats.forEach((element, index)=>{
    console.log(element)
    drop.innerHTML += `
    <option value="${element.CategoryName}" class="option">${element.CategoryName}</option>`
  })

}
let editCatBtn = document.querySelector('.categoryedit');
console.log(editCatBtn);
editCatBtn.addEventListener('click', (e)=>{
  e.preventDefault();
  let formData = new FormData();
  formData.append('process', 'getView');
  axios.post('/api/edit_category', formData).then(response =>{
    // Assuming you have the HTML response stored in a variable called `htmlResponse`

    // Get the parent element that contains the content to be replaced
    const contentParent = document.getElementById("content").parentElement;

    // Create a temporary div element and set its innerHTML to the response HTML
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = response.data.html;

    // Get the new content element from the temporary div
    const newContent = tempDiv.firstChild;

    // Replace the existing content with the new content
    contentParent.replaceChild(newContent, document.getElementById("content"));
    console.log(response.data.data);
    let tableBody = document.querySelector('.table-body');
    response.data.data.forEach((element, index)=>{
      tableBody.innerHTML += `
      <tr class="text-center table-data">
        <td class="serNo">${index + 1}</td>
        <td class="title">${element.CategoryName}</td>
        <td><a href="" name="edit_category" class="text-light"><i class="fa-solid fa-pen-to-square"></i></a></td>
        <td><form action=""><a href="" class="text-light"><i class="fa-solid fa-trash"></i></a> <input type="hidden" name="CatId" value=""></form></td>
      <!-- <td><form action=""><input type="submit" value="" class="delCat fa-solid fa-trash" style=""></form></td> -->
    </tr>
      `;
    })
    tableBody.innerHTML+= `
    <tr class="text-center">
    <td></td>
    <td><a href="" class="text-light addNewCategory">+</a></td>
    <td></td>
    <td><form action=""><input type="submit" value="save" class="addNewCat"> </form></td>
  </tr>
    `;
  })
})


