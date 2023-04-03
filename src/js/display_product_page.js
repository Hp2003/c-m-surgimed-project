
let detailPagehtml;
let proData;
let currentOffset = 0;

let currentIndexproduct ;
function get_details(event, btn, index) {
  currentIndexproduct = index;
  event.preventDefault();
  // getting page and details
  // console.log(document.querySelectorAll('.item_id')[index].value)
  if (document.querySelector(".tempDetailMain") != undefined) {
    document.querySelector(".tempDetailMain").remove();
  }
  let formData = new FormData();
  formData.append(
    "productId",
    document.querySelectorAll(".Item_id")[index].value
  );
  axios.post("/api/get_details_page", formData).then((Response) => {
    detailPagehtml = Response.data.html;

    // console.log(Response.data.details);
    let newElem = document.createElement("div");
    newElem.innerHTML = Response.data.html;
    newElem.style.height = "100%";
    newElem.classList.add("tempDetailMain");
    newElem.style.width = "100%";
    newElem.style.top = "0";
    newElem.style.position = "absolute";
    newElem.style.pointerEvents = "none";
    newElem
      .querySelectorAll("*")
      .forEach((child) => (child.style.pointerEvents = "auto"));
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0;
    document.body.appendChild(newElem);
    proData = Response.data.details;
    addDataInProductPage(Response.data.details);
    currentOffset = 0;
  });
}
function closeContainer(event) {
  event.preventDefault();
  document.querySelector(".tempDetailMain").style.display = "none";

  // Set the scrollTop property to scroll to the bottom of the page
  document.documentElement.scrollTop = 491;
  currentOffset = 0;
}

function addDataInProductPage(data) {
  console.log(data.ProductDesc);
  document.querySelector(".title").textContent = data.ProductTitle;
  document.querySelector(".price").textContent = data.ProductPrice;
  document.querySelector(".stock").textContent = data.QuantityOnHand;
  // let desc = data.ProductDesc.replace(/\t/g, "&#9;").replace(/\n/g, "&#10;");
  // console.log(desc);
  let contianer = document.querySelector(".desc");
  contianer.style.whiteSpace = "pre-wrap";
  contianer.innerHTML =   data.ProductDesc ;

  document.querySelector(".productId").textContent = data.ProductId;
  document.querySelector(".addToCartBtn").setAttribute('onclick', `addToCart(event, this, ${currentIndexproduct} )`);
  currentIndexproduct = 0;

  // console.log(document.querySelector('.productId').value);
  document.querySelector(".biggerImg").src = data.imgs[0];
  let imgs = document.querySelectorAll(".small-img");
  imgs.forEach((Element, index) => {
    if (data.imgs[index] != null || data.imgs[index] != undefined) {
      Element.src = data.imgs[index];
    } else {
      Element.remove();
    }
  });
}
// Review page part
let reviewPageHtml;
function showReview(e) {
  e.preventDefault();
  if (reviewPageHtml == undefined) {
    let formData = new FormData();
    formData.append("ProductId", proData.ProductId);
    formData.append("process_for_review_page", "displayPage");
    axios.post("/api/show_review", formData).then((Response) => {
      console.log(Response.data.data);
      reviewPageHtml = Response.data.html;

      document.querySelector(".product1").innerHTML = Response.data.html;
      document.querySelector(".product1").style.width = "90vw";
      document.querySelector(".product1").style.maxWidth = "";
      document.querySelector(".review-rows").style.color = "black";

      displayReview(Response.data.data);
      console.log(Response.data.data.length);
      if (Response.data.data.length < 10) {
        // console.log('in');
        document.querySelector(".loadmore").remove();
      }
    });
  } else {
    document.querySelector(".product1").innerHTML = reviewPageHtml;
    document.querySelector(".product1").style.width = "90vw";
    document.querySelector(".product1").style.maxWidth = "";
    document.querySelector(".review-rows").style.color = "black";
    addDataInProductPage(proData);
  }
}
function closeReview(e, btn) {
  document.querySelector(".product1").innerHTML = "";
  // document.querySelector('.product1').remove();
  document.querySelector(".tempDetailMain").style.display = "block";
  document.querySelector(".tempDetailMain").style.pointerEvents = "";
  document.querySelector(".tempDetailMain").style.position = "absolute";
  document.querySelector(".tempDetailMain").style.zIndex = "1000000";
  document.querySelector(".tempDetailMain").innerHTML = detailPagehtml;
  document.querySelector(".product1").style.width = "90%";
  document.querySelector(".product1").style.maxWidth = "900px";
  addDataInProductPage(proData);
  currentOffset = 0;
}

function addReview(e) {
  let formData = new FormData();
  if (e.key === "Enter") {
    e.preventDefault();
    formData.append("productId", proData.ProductId);
    let reviewText = document.querySelector(".reviewText").value.trim();
    formData.append("process_for_review_page", reviewText);
    if (reviewText != "") {
      if (reviewText.length > 100) {
        createAlert("warning", "Enter small Review", "");
      } else {
        formData.append("process_for_review_page", "addReview");
        formData.append("ReviewText", "addReview");

        axios.post("/api/show_review", formData).then((Response) => {
          console.log(Response);
          if (Response.data.text == "added") {
            createAlert("success", "Review Added", "");
            appendReview(Response.data.UserName);
            document.querySelector(".reviewText").value = "";
          }
        });
      }
    } else {
      createAlert("warning", "Please write something...!", "");
    }
  }
}
function displayReview(data) {
  data.forEach((Element, index) => {
    console.log(document.querySelectorAll(".username")[index]);

    document.querySelectorAll(".username")[index].childNodes[1].textContent =
      Element.UserName;
    document.querySelectorAll(".review")[index].textContent =
      Element.ReviewText;
  });
}
function appendReview(data) {
  document.querySelector(".review-rows").innerHTML += `<div class="review-row">
    <div class="container-profileimg">
    </div>
    <div class="username">
        <h4>${data}</h4>
    </div>
    <div class="review">
        ${document.querySelector(".reviewText").value}
    </div>

</div> `;
}

function getMoreReviews(e) {
  e.preventDefault();
  let formData = new FormData();
  formData.append("process_for_review_page", "loadMoreReview");
  formData.append("CurrentOffset", (currentOffset += 10));

  axios.post("/api/show_review", formData).then((Response) => {
    if (Response.data.data.length < 10) {
      document.querySelector(".loadmore").style.display = "none";
    }
    console.log(Response.data.data);
  });
}
