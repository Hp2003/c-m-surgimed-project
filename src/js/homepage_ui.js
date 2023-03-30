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
let offset1 = 0;
function searchByCat(event, link , Index){
  event.preventDefault();
  const clickedValue = link.getAttribute('value') // get the value of the clicked button
  console.log(clickedValue)
  let formData = new FormData();
  formData.append('process', 'loadFistTime');
  formData.append('categoryId' ,clickedValue);
  formData.append('offset', '0');
  axios.post('/api/search_by_category',formData ).then(Response =>{
    console.log(Response.data.text[Response.data.text.length -1 ]  )
      offset1 = 0;
      renderProducts(Response.data.text, 0, true);

      // inserting images
      let images = document.querySelectorAll('.banner-img');
      console.log(Response.data.text);
      images.forEach((element, index) =>{
        // element.src = "";
        element.src = Response.data.text[index].ProductImg + '/' + Response.data.text[Response.data.text.length - 2][index];
      })
    if(Response.data.text[Response.data.text.length -1 ]  == "notend"){
      document.querySelector('.pagination-main').innerHTML = `<button type="button" class="btn btn-primary loadMore" onclick = "loadmoreProducts()">Load more...</button>`
    }

  })

}

function loadmoreProducts(){
  // e.preventDefault();
  let formData = new FormData();
  offset1 += 16;
formData.append('process', 'pagination');
formData.append('offset', offset1);
  axios.post('/api/search_by_category',formData ).then(Response =>{
    console.log(Response.data)


      renderProducts(Response.data.text, offset1,false);

      // inserting images
      let images = document.querySelectorAll('.banner-img');
      let imgArray = Array.from(images);
      imgArray.slice(0, offset1);
      
      // console.log(imgArray.length);
      imgArray.forEach((element, index) =>{
        
        if(Response.data.text[index] == undefined){
          return 0;
        }
        if(images[index + offset1] == undefined){
          return 0;
        }
        // element.src = "";
        images[index + offset1].src = Response.data.text[index]['ProductImg'] + '/' + Response.data.text[Response.data.text.length -2][index];
      })
      
    if(Response.data.text[Response.data.text.length -1 ]  == "end"){

      document.querySelector('.loadMore').remove();
    }

  })
}
