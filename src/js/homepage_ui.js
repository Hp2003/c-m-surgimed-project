// Startup Scripts
$(document).ready(function () {
  $(".hero").css(
    "height",
    $(window).height() - $("header").outerHeight() + "px"
  ); // Set hero to fill page height

  $("#scroll-hero").click(function () {
    $("html,body").animate({ scrollTop: $("#hero-bloc").height() }, "slow");
  });
});

// Window resize
$(window).resize(function () {
  $(".hero").css(
    "height",
    $(window).height() - $("header").outerHeight() + "px"
  ); // Refresh hero height
});
let logoutBtn = document.querySelector('.logout')
if(logoutBtn != null){
  logoutBtn.addEventListener('click', (e)=>{
    // console.log('in');
    e.preventDefault();
    axios.post('/api/logout').then(Response =>{
      window.location.href = Response.data;
      
    })
  })
}

function display_categorys(){
  let menu = document.querySelector('.dropdown-menu');
  axios.post('/api/get_categorys').then(Response =>{
    console.log(Response.data)
    if(Response.data != undefined){
      Response.data.cats.forEach((element, index) => {
        menu.innerHTML += `<a class="dropdown-item" role="presentation" value="${element.CategoryId}" href="#" onClick="searchByCat(event, this, ${index+1})">${element.CategoryName}</a> `;
      });
    }
  })
}

display_categorys();
function updateProCount(){
  let text = document.querySelector('.cart-btn') ;
  var numericString = text.textContent.match(/\d+/); // This regular expression pattern matches one or more digits
  var number = parseInt(numericString[0]); // Extract the first match as a string and parse it to an integer
  text.textContent = `Cart(${number + 1})`
}   

// updateProCount();
// let popup = document.querySelector('.popup')

// function getData(){
//   let images = [];
//   let imagesSrc = []
//   axios.post('/api/getHomePageData',{
//     responseType: 'blob'
//   }).then(Response =>{
//     images = Response.data.Products
//     .forEach((element, index) => {
//       // console.log(element.ProductImg)
//       imagesSrc.push(element.ProductImg + '/' + Response.data.Images[index]);
//     });
//       console.log()
//       renderImages(imagesSrc);
//       renderData(Response.data);
//     })
//   }
// function renderImages(imgs){
//   let containers = document.querySelectorAll('.postcard__img')
//   containers.forEach((element, index) =>{
//     element.src = imgs[index];
//   })
// }
// function renderData(data){
//   console.log(data.data)
// }
// getData();



// useful for pagination 
let offset1 = 0
let crurenCategory = '';
function searchByCat(event, link , Index){

  event.preventDefault();
  const clickedValue = link.getAttribute('value') // get the value of the clicked button
  console.log(clickedValue)
  crurenCategory = clickedValue;
  let formData = new FormData();
  formData.append('process', 'loadFistTime');
  formData.append('categoryId' ,clickedValue);
  formData.append('offset', '0');
  axios.post('/api/search_by_category',formData ).then(Response =>{
    console.log(Response  )
      offset1 = 0;
      renderProductsWithCats(Response.data.text, 0, true);

      // inserting images
      let images = document.querySelectorAll('.banner-img');
      console.log(Response.data.text);
      images.forEach((element, index) =>{
        // element.src = "";
        // element.src = 
      })
    if(Response.data.text[Response.data.text.length -1 ]  == "notend"){
      document.querySelector('.pagination-main').innerHTML = `<button type="button" class="btn btn-primary loadMore" onclick = "loadmoreProducts()">Load more...</button>`
    }

  })

}
function sendFeedback(){
  let feedbackfrom = document.querySelector('#contactUs_form');
  let formData = new FormData(feedbackfrom);
  axios.post('/api/send_feedback').then(Response =>{
    if(Response.data.text == 'eamilSentSuccessFully'){
      createAlert('succecss', 'Email Sent Successfully..', '');
    }
  })
}
// function loadmoreProducts(){
//   // e.preventDefault();
//   let formData = new FormData();

// formData.append('process', 'pagination');
// formData.append('offset', offset1);
//   axios.post('/api/search_by_category',formData ).then(Response =>{
//     console.log(Response.data)


//     renderProductsWithCats(Response.data.text, offset1,false);

//       // inserting images
//       let images = document.querySelectorAll('.banner-img');
//       let imgArray = Array.from(images);
//       imgArray.slice(0, offset1);
      
//       // console.log(imgArray.length);
//       imgArray.forEach((element, index) =>{
        
//         if(Response.data.text[index] == undefined){
//           return 0;
//         }
//         if(images[index + offset1] == undefined){
//           return 0;
//         }
//         // element.src = "";
//         images[index + offset1].src = Response.data.text[index]['ProductImg'] + '/' + Response.data.text[Response.data.text.length -2][index];
//       })
      
//     if(Response.data.text[Response.data.text.length -1 ]  == "end"){

//       document.querySelector('.loadMore').remove();
//     }

//   })
// }
function renderProductsWithCats(data, customIndex = 0 , remove = true){
  // console.log(data[2][1])
  let container = document.querySelector('.card-main');
  document.querySelectorAll('.addToCart').forEach((element, index)=>{
      element.removeEventListener('click', addToCart);
      element.remove();
  })
  if(remove == true){
      container.innerHTML = '';
  }
  console.log(data);
  data.forEach((element, index) => {
      // console.log(element)
      if(element.ProductTitle == undefined){
          return 0;
      }
      console.log(data[data.length-1][offset1])
      container.innerHTML += `<div class='col-md-4 mb-2 cards' style='height:431px;'>
      <form action='manage_cart.php' method='post' class='cartForm'>
          <div class='card'>
              <img src = ' ${element.ProductImg + '/'  + data[data.length-1][index]}' class='card-img-top banner-img' style='height : 220px;'>
              <div class='card-body'>
                  <p class='card-title text-white' style='font-size:1em'>${element.ProductTitle}</p>
                  <p class='card-text'>Rs ${element.ProductPrice}</p>
                      <a href='' onclick="get_details(event, this, ${offset1})"><input type='submit' name='detail' value='Detail' class='button outline' ></a>
                      <input type='button' name='addtocart' value='Buy Now' class='button fill  ' onClick='addToCart(event, this, ${offset1})'>
                  <input type='hidden' name='Item_Name' value='${element.ProductTitle}'>
                  <input type='hidden' name='Item_Price' value='${element.ProductPrice}'>
                  <input type='hidden' name='item_Id' value='${element.ProductId}'class='Item_id'>
              </div>
          </div>
      </form>
  </div>	`

  offset1 ++;
  });
  if(data.length >= 17){
      if(document.querySelector('.loadMoreProducts') == undefined){
          document.querySelector(".pagination-main").innerHTML = `<button type="button" onclick = "loadMoreProductsWithCategory(event, this)"class="btn btn-primary loadMoreProducts">Load More...</button>`
      }
  }else{
      if(document.querySelector('.loadMoreProducts') != undefined){
          document.querySelector('.loadMoreProducts').remove();
      }
      offset1 = 0;
  }
}

function loadMoreProductsWithCategory(){
  let formData = new FormData();
  formData.append('process', 'loadFistTime');
  formData.append('categoryId' ,crurenCategory);
  formData.append('offset', offset1);
  axios.post('/api/search_by_category',formData ).then(Response =>{
    console.log(Response  )
      renderProductsWithCats(Response.data.text, 0, false);
      // inserting images
      let images = document.querySelectorAll('.banner-img');
    //   images.forEach((element, index) =>{
    //     if(Response.data.text[index].ProductImg == undefined ){
    //       return 0;
    //     }
    //     console.log(element);
    //     // element.src = "";
    // element.src = Response.data.text[index].ProductImg + '/' + Response.data.text[Response.data.text.length - 2][index];

    //   })
    })
  
}