// displayPagination(paginationEditCategory);
// addNewCat();
// let paginationBtns = document.querySelectorAll(".page-link");

// // console.log(paginationBtns);
// paginationBtns[1].classList.add("active");
// let prevActiveElem = paginationBtns[1];
// paginationBtns.forEach((element, index) => {
//   element.addEventListener("click", (e) => {
//     e.preventDefault();
//     if (prevActiveElem != undefined) {
//       prevActiveElem.classList.remove("active");
//     }
//     let formData = new FormData();
//     formData.append("process", "get_more_data");
//     formData.append("number", index  -1 );
//     axios.post("/api/edit_category", formData).then((Response) => {
//       // console.log(Response.data.offset)
//       currentIndex = Response.data.offset;
//       console.log(currentIndex)
//       // console.log(Response.data.records);
//       renderData(Response.data.data, Response.data.html, currentIndex, Response.data.records);
//       dataBuffer = [];
//       dataBuffer = [...Response.data.data]
//       // clickListener();
//       // adding new category
//       // addNewCat();
//     });
//     element.classList.add("active");
//     prevActiveElem = element;
//   });
// });
// // for work after re rendering

let currentPlace = 'mainPage';




// // submitNewCat();
// // clickListener();
let editCatBtn = document.querySelector('.categoryedit');
editCatBtn.addEventListener('click', (e)=>{
  e.preventDefault();
  displayEditCat();
})
// console.log(editCatBtn);
function displayEditCat(){
  let formData = new FormData();
  formData.append('process', 'getView');
  axios.post('/api/edit_category', formData).then(response =>{
    // dataBuffer = [...response.data.data];
    console.log(response.data.data)
    rederCategory(response.data.html);
    createMainCategoryTable(response.data.data);
  })
}

function rederCategory(html){
  // console.log(html);
  document.body.style.backgroundColor = 'white';
const contentParent = document.getElementById("content").innerHTML = html;
// document.body.innerHTML = html;
// Create a temporary div element and set its innerHTML to the response HTML
 const tempDiv = document.createElement("div");
 tempDiv.innerHTML = html;

 // Get the new content element from the temporary div
 const newContent = tempDiv.firstChild;

 // Replace the existing content with the new content
 const contentElement = document.getElementById("content");
//  contentElement.innerHTML = '';
 contentElement.appendChild(newContent);
}
console.log(document.getElementById("content"))


function createMainCategoryTable(data ){
  let container = document.querySelector('.tableBody')
  let prevemail;
  data.forEach((Element, index) => {  
    // console.log(data[data.length -1][index]);
    if(Element.MainCategoryId == undefined){
      return 0;
    }

      container.innerHTML += `
  <tr>
          <td>${index + 1}</td>
          <td>${Element.MainCategoryId}</td>
          <input type="hidden" class='MainCategoryId' name="MainCatId" value="${Element.MainCategoryId}">
          <td onclick="listCategorys(event, this, ${index})" class="mainCatName" style="cursor:pointer;">${Element.MainCategoryName}</td>
          <td >${Element.CreatedTime}</td>
          <td >${Element.UpdatedOn}</td>
          <td class="" >${data[data.length -1][index]}</td>
          <td > <i class="fa fa-pencil"onclick="re_nameMainCategory(event, this, ${index})" aria-hidden="true" style="cursor:pointer;"></i>
          </td>

          <td>${
                  Element.IsDeleted == true? `<form action='manage_cart.php' method='post'>
                  <button name='Remove_Item' class='btn btn-sm btn-outline-danger mainCatDelBtn disabled' onclick="removeMainCategory(event, this, ${index})"><i
                          class='fa-solid fa-trash'></i></button>
                  <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
              </form>

          </td>`:`<form action='manage_cart.php' method='post'>
                  <button name='Remove_Item' class='btn btn-sm btn-outline-danger mainCatDelBtn' onclick="removeMainCategory(event, this, ${index})"><i
                          class='fa-solid fa-trash'></i></button>
                  <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
              </form>

          </td>`
              }
              <td>${
                Element.IsDeleted == 1? `<form action='manage_cart.php' method='post'>
                <button name='Remove_Item' class='btn btn-sm btn-outline-danger  mainCatOpenBtn' onclick="openMainCategory(event, this, ${index})"><i class="fa-solid fa-door-open"></i></button>
                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
            </form>

        </td>`:`<form action='manage_cart.php' method='post'>
                <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled mainCatOpenBtn' onclick="openMainCategory(event, this, ${index})"><i class="fa-solid fa-door-open"></i></button>
                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
            </form>

        </td>`
            }  
                      
                      
            
        </tr>
  `;
  // console.log(prevemail)
});
// console.log(currentUsrCount);
//   if(data[data.length -1 ] ){
//       if(document.querySelector('.paginationBtnUser')  == undefined){
//           document.querySelector('.pagination-btn').innerHTML += `<button type="button" class="btn btn-primary paginationBtnUser" onclick="loadMoreUser()">Load More...</button>`;
//       }
//   }else{
//       if(document.querySelector('.paginationBtnUser') != undefined){
//           document.querySelector('.paginationBtnUser').remove();
//       }
//   }
} 
function listCategorys(event, btn, index){
  let formData = new FormData();
  formData.append('process', 'openCategory');
  // alert(document.querySelectorAll('.MainCategoryId')[index].value)
  formData.append('id', document.querySelectorAll('.MainCategoryId')[index].value);
  axios.post("/api/edit_category", formData).then(response =>{
    renderCategory(response.data.data);
  })
}

// //////////////////////////////////////////////////////////////////////

function renderCategory(data){
  console.log(data);
  if(data == 0 || data == undefined){
    return 0;
  }
  document.querySelector('.add_category').value = 'subCategory';

  document.querySelector('.subCatCount').textContent = 'Product Count';
  let container = document.querySelector('.tableBody')
  let prevemail;
  container.innerHTML = '';
  document.querySelector('.headings').innerHTML += `<th scope="col">Move Category</th>`;
  data.forEach((Element, index) => {  
    // console.log(data[data.length -1][index]);
    if(Element.CategoryId == undefined){
      return 0;
    }
    container.innerHTML += `
  <tr class='subcatRows'>
          <td>${index + 1}</td>
          <td>${Element.CategoryId}</td>
          <input type="hidden" class='catIdForm' name="MainCatId" value="${Element.CategoryId}">
          <input type="hidden" class='mainCatId' name="catId" value="${Element.MainCategoryId}">
          <td  class="categoryName" onclick="editCategoryBtnHandler(event, this, ${index})" style="cursor:pointer;">${Element.CategoryName}</td>
          <td >${Element.CreateAt}</td>
          <td >${Element.UpdateAt}</td>
          <td class="" >${data[data.length -1][index]}</td>
          <td onclick="re_nameSubCategory(event, this, ${index})" style="cursor:pointer;"> <i class="fa fa-pencil" aria-hidden="true"></i>
          </td>

          <td>${
                  Element.IsDeleted == true? `<form action='manage_cart.php' method='post'>
                  <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled deleteCatBen' onclick="deleteCategory(event, this ,${index})"><i
                          class='fa-solid fa-trash'></i></button>
                  <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
              </form>

          </td>`:`<form action='manage_cart.php' method='post'>
                  <button name='Remove_Item' class='btn btn-sm btn-outline-danger deleteCatBen' onclick="deleteCategory(event, this ,${index})"><i
                          class='fa-solid fa-trash'></i></button>
                  <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
              </form>

          </td>`
              }
          <td>${
                  Element.IsDeleted == 1? `<form action='manage_cart.php' method='post'>
                  <button name='Remove_Item' class='btn btn-sm btn-outline-danger  openCategoryBtn' onclick="re_openCategory(event, this ,${index})"><i class="fa-solid fa-door-open"></i></button>
                  <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
              </form>

          </td>`:`<form action='manage_cart.php' method='post'>
                  <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled openCategoryBtn' onclick="re_openCategory(event, this ,${index})"><i class="fa-solid fa-door-open"></i></button>
                  <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
              </form>

          </td>`
              }
              <td>
              <form action='manage_cart.php' method='post'>
              <button name='Remove_Item' class='btn btn-sm btn-outline-danger '  onclick = "moveCategory(event, this, ${index})"><i class="fas fa-dolly"></i>  </button>
              <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
          </form>
              </td>
        </tr>
  `;
  // console.log(prevemail)
  currentPlace = 'category';
});
}   
 function submitNewCategory(e,btn){
    
      const NewName = window.prompt('Please Enter New Category Name ')
    if(NewName != null || NewName.trim() != ""){

    if(btn.getAttribute('value') == 'MainCategory'){

      let formData = new FormData();
      formData.append('process', 'add_cat');
      formData.append('type', 'main_category');
      formData.append('catName', NewName);
      
      axios.post('/api/edit_category', formData).then(Response =>{
        console.log(Response);
        if(Response.data.text == 'alreadyAvilabel'){
          createAlert('warning', 'Category already available !', '');
          return 0;
        }
        if(Response.data.text == 'categoryCreated'){
          createAlert('success', 'Category Created !', '');
          return 0;
        }
      })
    }else if(btn.getAttribute('value') == 'subCategory'){
      let formData = new FormData();
      formData.append('process', 'add_cat');
      formData.append('type', 'sub_category');
      formData.append('catName', NewName);
      formData.append('main_cat_id', document.querySelectorAll('.mainCatId')[0].value);
      
      axios.post('/api/edit_category', formData).then(Response =>{
        console.log(Response);
        if(Response.data.text == 'alreadyAvilabel'){
          createAlert('warning', 'Category already available !', '');
          return 0;
        }
        if(Response.data.text == 'categoryCreated'){
          createAlert('success', 'Category Created !', '');
          return 0;
        }
      })
    }
    }
  }
  function deleteCategory(event, button , index){
    event.preventDefault();
    // let index = button.parentNode.parentNode.rowIndex;

    let idForms = document.querySelectorAll(".catIdForm");
if(window.confirm('Do you really want to delete this ' + document.querySelectorAll('.categoryName')[index].textContent)){
  let formData = new FormData();
  formData.append("process", "delete_cat");
  formData.append("CategoryId", idForms[index].value);
  console.log(idForms[index]);
  axios.post("api/edit_category", formData).then((Response) => {
    console.log(Response)
    if (Response.data.text == "cateGoryDeleted") {
      
      createAlert("success", "Category Deleted Successfully", "");
      document.querySelectorAll('.deleteCatBen')[index].classList.add('disabled');
      document.querySelectorAll('.openCategoryBtn')[index].classList.remove('disabled');
    }
  });

}

}
function re_openCategory(e,btn,index){
  e.preventDefault();
  let idForms = document.querySelectorAll(".catIdForm");
  let formData = new FormData();
  formData.append("process", "re-open_category");
  formData.append("CategoryId", idForms[index].value);
  console.log(idForms[index]);
  axios.post("api/edit_category", formData).then((Response) => {
    console.log(Response)
    if (Response.data.data == true) {
      
      createAlert("success", "Category Re-Opened Successfully", "");
      document.querySelectorAll('.openCategoryBtn')[index].classList.add('disabled')
      document.querySelectorAll('.deleteCatBen')[index].classList.remove('disabled');
    }
    if(Response.data.data == false){
      createAlert('warning', 'Main category is Deleted Please re-Open it !', '');
      return 0;
    }
    
  });
}

function re_nameSubCategory(e,btn,index){
  e.preventDefault();
  let newName = window.prompt('Enter new Name For category ');
  
  if(newName != null || newName.trim() != ""){

    let idForms = document.querySelectorAll(".catIdForm");
    let formData = new FormData();
    formData.append("process", "re-nameCategory");
    // formData.append("process", "re-");
    formData.append("CategoryId", idForms[index].value);
    formData.append("newName", newName);
    
    

     if(document.querySelector('.add_category').value== 'subCategory'){
      formData.append("type", 'subCategory');
      formData.append('mainCatId', document.querySelectorAll('.mainCatId')[0].value);
      axios.post("api/edit_category", formData).then((Response) => {
        console.log(Response)
        if (Response.data.data == 1) {
          createAlert("success", "Category Re-nammed Successfully", "");
    
          document.querySelectorAll('.categoryName')[index].textContent = newName;
        }
        if (Response.data.data == 2) {
          createAlert("warning", "Category name already exist ", "");
    
          // document.querySelectorAll('.categoryName')[index].textContent = newName;
        }
        console.log(Response)
    })
  }
  }
}
let buttonChangeIndex = 0;
function moveCategory(event , btn, index){
  event.preventDefault();
  index -= buttonChangeIndex;
  buttonChangeIndex ++;
  const newName = window.prompt('Enter New Category Name : ');
  let formData = new FormData();
    formData.append('process', 'move_category') ;
    console.log(index);
    formData.append('CategoryId' , document.querySelectorAll('.catIdForm')[index].value);
    formData.append('newCatName', newName);
    if(newName != null && newName.trim() != ""){
      axios.post('/api/edit_category',formData ).then(Response =>{
        if(Response.data.data == 3){
          createAlert('warning', `Main category ${newName} Does not exist`,'');
          return  1;
        }
        if(Response.data.data == 1){
          createAlert('success', `Successfully moved to ${newName} !`,'');
          document.querySelectorAll('.subcatRows')[index].remove();
          return 1;
        }
        console.log(Response);
      })
    }

}
function re_nameMainCategory(e, btn, index){
  const newName = window.prompt('Enter New Name for Categroy : ');

  if(newName != null || newName.trim() != ""){
        let formData = new FormData();
        formData.append('newName', newName.trim());
        formData.append('catid', document.querySelectorAll('.MainCategoryId')[index].value);
        formData.append("process", 'change_main_cat_name');
        axios.post("api/edit_category", formData).then((Response) => {
          console.log(Response)
          if (Response.data.text   == true) {
            
            createAlert("success", "Category Re-nammed Successfully", "");
      
            document.querySelectorAll('.mainCatName')[index].textContent = newName;
          }else if(Response.data.text   == 2){
            createAlert("warning", "Category name already exist!", "");
          }
    
        });
      }
}

function removeMainCategory(e,btn,index){
  e.preventDefault();
  let name = document.querySelectorAll('.mainCatName')[index].textContent;
  const confirm = prompt(`Type "confirm" to delete this will delete everything related to ${name} `);

  if(confirm === "confirm"){
    let formData = new FormData();
    formData.append('CategoryId', document.querySelectorAll('.MainCategoryId')[index].value);
    formData.append('process', 'delete_main_category');
    axios.post("api/edit_category", formData).then((Response) => {
      console.log(Response.data.data)
      if (Response.data.data == true) {
      
        createAlert("success", "Category Deleted Successfully", "");
        document.querySelectorAll('.mainCatDelBtn')[index].classList.add('disabled');
        document.querySelectorAll('.mainCatOpenBtn')[index].classList.remove('disabled');
      } 

    });
  }
}

function openMainCategory(event, button, index){
  event.preventDefault();
  let formData = new FormData();
    formData.append('mainCategoryId', document.querySelectorAll('.MainCategoryId')[index].value);
    formData.append('process', 'open_main_caegory');
    axios.post("api/edit_category", formData).then((Response) => {
      console.log(Response.data)
      if (Response.data.data == true) {
      
        createAlert("success", "Category Re-Opened Successfully", "");
        document.querySelectorAll('.mainCatDelBtn')[index].classList.remove('disabled');
        document.querySelectorAll('.mainCatOpenBtn')[index].classList.add('disabled');
      } 

    });
}

function refreshChart(){
  console.log('here');
  displayEditCat();
}
function searchCategory(){

}