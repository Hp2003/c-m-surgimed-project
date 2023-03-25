displayPagination(paginationEditCategory);
addNewCat();
let paginationBtns = document.querySelectorAll(".page-link");

// console.log(paginationBtns);
paginationBtns[1].classList.add("active");
let prevActiveElem = paginationBtns[1];
paginationBtns.forEach((element, index) => {
  element.addEventListener("click", (e) => {
    e.preventDefault();
    if (prevActiveElem != undefined) {
      prevActiveElem.classList.remove("active");
    }
    let formData = new FormData();
    formData.append("process", "get_more_data");
    formData.append("number", index  -1 );
    axios.post("/api/edit_category", formData).then((Response) => {
      // console.log(Response.data.offset)
      currentIndex = Response.data.offset;
      console.log(currentIndex)
      // console.log(Response.data.records);
      renderData(Response.data.data, Response.data.html, currentIndex, Response.data.records);
      dataBuffer = [];
      dataBuffer = [...Response.data.data]
      // clickListener();
      // adding new category
      // addNewCat();
    });
    element.classList.add("active");
    prevActiveElem = element;
  });
});
// for work after re rendering
function deleteCategory(event, button){
    event.preventDefault();
    let index = button.parentNode.parentNode.rowIndex;
    idForms = document.querySelectorAll(".catIdForm");
    let formData = new FormData(idForms[index -1 ]);
    formData.append("process", "delete_cat");
    console.log(idForms[index]);
    axios.post("api/edit_category", formData).then((Response) => {
      console.log(currentIndex);
      console.log(Response.data);
      if (Response.data.text == "cateGoryDeleted") {
        document.querySelectorAll(".table-data")[index -1 ].remove();
        console.log(index);
        dataBuffer.splice(index -1, 1);
        createAlert("success", "Category Deleted Successfully", "");
        renderData(dataBuffer, Response.data.html, currentIndex, 25);
      }
      // location.reload();
    });
}




function submitNewCat(){
  let saveBtn = document.querySelector('.catNameBtn');
    console.log('hello in catname')
    let form = document.querySelector('.addCategoryForm');

    let formData = new FormData(form);
    // adding category to db
    formData.append('process', 'add_cat')
    
    axios.post('/api/edit_category', formData).then(Response =>{
      console.log('req sent');
      console.log(Response);
      let tableBody = document.querySelector('.table-body');
        // currentIndex ++;

        tableBody.innerHTML += `
        <tr class="text-center table-data">
          <td class="serNo"><form class='catIdForm'><input type = 'hidden' name="CategoryId" value=''></form></td>
          <td class="title cat-title">${Response.data.name}</td>
          <td><a href="" name="edit_category" class="text-light"><i class="fa-solid fa-pen-to-square"></i></a></td>
          <td><a href="" class="text-light"><i class="fa-solid fa-trash deleteCategory"></i></a> </td>
    
      </tr>
        `;
      // submitNewCat();
  })

}
// submitNewCat();
// clickListener();
