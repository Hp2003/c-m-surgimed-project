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
// let popup = document.querySelector('.popup')

function getData(){
  let images = [];
  let imagesSrc = []
  axios.post('/api/getHomePageData',{
    responseType: 'blob'
  }).then(Response =>{
    images = Response.data.Products
    .forEach((element, index) => {
      // console.log(element.ProductImg)
      imagesSrc.push(element.ProductImg + '/' + Response.data.Images[index]);
    });
      console.log()
      renderImages(imagesSrc);
      renderData(Response.data);
    })
  }
function renderImages(imgs){
  let containers = document.querySelectorAll('.postcard__img')
  containers.forEach((element, index) =>{
    element.src = imgs[index];
  })
}
function renderData(data){
  console.log(data.data)
}
getData();
