let searchBtn = document.querySelector('.serachBtn')
let searchInput = document.querySelector('.searchInput')

searchBtn.addEventListener('click', (e)=>{
    let form = document.querySelector('.searchbar');
    let formData = new FormData(form);

    e.preventDefault();
    axios.post('/api/search_product', formData).then(Response =>{
        // console.log(Object.values(Response.data));
        renderProducts(Object.values(Response.data));
    })
})
function renderProducts(data){
    let container = document.querySelector('.card-main');
    document.querySelectorAll('.addToCart').forEach((element, index)=>{
        element.removeEventListener('click', addToCart);
        element.remove();
    })
    container.innerHTML = '';
    data.forEach((element, index) => {
        // console.log(element)
        if(element.ProductTitle == undefined){
            return 0;
        }

        container.innerHTML += `<div class='col-md-4 mb-2 cards' style='height:431px;'>
        <form action='manage_cart.php' method='post' class='cartForm'>
            <div class='card'>
                <img src='.${data[6][index]}' class='card-img-top banner-img' style='height : 220px;'>
                <div class='card-body'>
                    <h3 class='card-title'>${element.ProductTitle}</h3>
                    <p class='card-text'>Rs ${element.ProductPrice}</p>
                        <a href=''><input type='submit' name='detail' value='Detail' class='button outline'></a>
                        <input type='button' name='addtocart' value='Buy Now' class='button fill  ' onClick='addToCart(event, this, ${index})'>
                    
                    <input type='hidden' name='Item_Name' value='${element.ProductTitle}'>
                    <input type='hidden' name='Item_Price' value='${element.ProductPrice}'>
                    <input type='hidden' name='item_Id' value='${element.ProductId}'>
                </div>
            </div>
        </form>
    </div>	`
    });
}