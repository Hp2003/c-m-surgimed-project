let searchBtn = document.querySelector('.serachBtn')
let searchInput ;
let currentoffsetSearch  = 0;
if(searchBtn != undefined){
    searchBtn.addEventListener('click', (e)=>{
        e.preventDefault();
        currentoffsetSearch  = 0;
        searchInput = document.querySelector('.searchInput').value;
        let form = document.querySelector('.searchbar');
        let formData = new FormData(form);
        formData.append('offset_search',0);
        
        axios.post('/api/search_product', formData).then(Response =>{
            
            if (Response.data.text == 'couldNotFind'){
                createAlert('warning', 'Sorry Product Not available','');
                return;
            }else{
                console.log(Response); 
                renderProducts(Object.values(Response.data), 0,true);
                document.documentElement.scrollTop =  600;
            }
        })
    })
}



function renderProducts(data, customIndex = 0 , remove = true){
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
    index = customIndex;
    data.forEach((element) => {
        // console.log(element)
        if(element.ProductTitle == undefined){
            return 0;
        }
        container.innerHTML += `<div class='col-md-4 mb-2 cards' style='height:431px;'>
        <form action='manage_cart.php' method='post' class='cartForm'>
            <div class='card'>
                <img src='.${data[data.length-1][index]}' class='card-img-top banner-img' style='height : 220px;'>
                <div class='card-body'>
                    <p class='card-title text-white' style='font-size:1em'>${element.ProductTitle}</p>
                    <p class='card-text'>Rs ${element.ProductPrice}</p>
                        <a href='' onclick="get_details(event, this, ${currentoffsetSearch})"><input type='submit' name='detail' value='Detail' class='button outline' ></a>
                        <input type='button' name='addtocart' value='Buy Now' class='button fill  ' onClick='addToCart(event, this, ${currentoffsetSearch})'>
                    <input type='hidden' name='Item_Name' value='${element.ProductTitle}'>
                    <input type='hidden' name='Item_Price' value='${element.ProductPrice}'>
                    <input type='hidden' name='item_Id' value='${element.ProductId}'class='Item_id'>
                </div>
            </div>
        </form>
    </div>	`
    index++;
    currentoffsetSearch ++;
    });
    if(data.length >= 17){
        if(document.querySelector('.loadMoreProducts') == undefined){
            document.querySelector(".pagination-main").innerHTML = `<button type="button" onclick = "loadMoreProducts(event, this)"class="btn btn-primary loadMoreProducts">Load More...</button>`
        }
    }else{
        if(document.querySelector('.loadMoreProducts') != undefined){
            document.querySelector('.loadMoreProducts').remove();
        }
        currentoffsetSearch = 0;
    }
}
function loadMoreProducts(e, btn){
    e.preventDefault();
    let form = document.querySelector('.searchbar');
    let formData = new FormData(form);

    console.log(searchInput);
    formData.append('offset_search', currentoffsetSearch);
    formData.append('search_data', searchInput);
    
    axios.post('/api/search_product', formData).then(Response =>{
        if (Response.data.text == 'couldNotFind'){
            createAlert('warning', 'Sorry Product Not available','');
            return;
        }else{
            console.log(Response); 
            renderProducts(Object.values(Response.data), 0,false);
            // document.documentElement.scrollTop =  600;
        }
    })
}