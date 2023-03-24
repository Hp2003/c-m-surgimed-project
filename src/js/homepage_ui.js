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
    if(Response.data.cats != undefined){
      Response.data.cats.forEach((element, index) => {
        menu.innerHTML += `<a class="dropdown-item" role="presentation" value="${element}" href="#">${element}</a>`;
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
