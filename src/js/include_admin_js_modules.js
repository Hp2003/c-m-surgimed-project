document.querySelector(".add-product").addEventListener("click", (e) => {
    e.preventDefault();
    let formData = new FormData();
    formData.append("type", "GetPage");
    axios
      .post("/api/add_product", formData)
      .then((Response) => {
        // console.log(Response.data)
        let isAdded = DisplayAdminViews(Response.data.html);
        
        // console.log(Response.data.html);
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
let editProductBtn = document.querySelector(".editProduct");
editProductBtn.addEventListener("click", () => {
  // getting edit product page

  axios.post("/api/edit_product").then((Response) => {
    // popup.innerHTML = Response.data;
    DisplayAdminViews(Response.data);
    createScriptElem('./src/js/edit_product_ui.js', "editProductScript");
    // container.style.display = 'block';
    // console.log(Response);

    
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
});
