// import * as homeBtn from "./edit_category";
document.body.style.backgroundColor = 'white';

// let loadMoreBtn = document.querySelector('.LoadMoreProduct')
function loadMore(){
    console.log('hellow');
    let formData = new FormData();
    formData.append('process_category_page', 'LoadMoreProducts');
    axios.post('/api/Edit_products_category', formData).then(Response =>{
        console.log(Response.data.offset);
        renderProductsWithCat(Response.data.data, Response.data.rowsRecived);
    })
  }

document.querySelector('.searchCategory').addEventListener('click', (e)=>{
    e.preventDefault();
    console.log('in');
    let form = document.querySelector('.searchCatForm');
    let formData = new FormData(form);
    formData.append('process_category_page', 'SearchRecords');
    axios.post('/api/Edit_products_category', formData).then(Response=>{
        console.log(Response);
        document.querySelector('.tableBody').innerHTML = '';
        indexOfProducts = 1;
        renderProductsWithCat(Response.data.data, Response.data.totalRecords);
    })
    console.log(formData.get('category_name'));

})

function updateProductCategoryTable(event, button){
    event.preventDefault();
    let index = button.parentNode.parentNode.rowIndex;
    console.log(index)
    let dataRows = [document.querySelectorAll('.dataRows')[index-1].childNodes]
    dataRows.forEach(element => {
        console.log(element[7].childNodes[1].value, element[11].childNodes[1].value)

        let formData = new FormData();

        formData.append('Price', element[7].childNodes[1].value);
        formData.append('QOH', element[11].childNodes[1].value);
        formData.append('process_category_page', 'update_product');
        formData.append('productId', element[3].childNodes[1].value)
        axios.post('/api/Edit_products_category', formData).then(Response =>{
            if(Response.data.text == 'productUpdated'){
                createAlert('success', 'Product updated!','');
            }
        })
    });
}
function deltePro(event, button){
    event.preventDefault();
    // console.log('in del')
    let index = button.parentNode.parentNode.rowIndex;

    let dataRows = [document.querySelectorAll('.dataRows')[index-1].childNodes]
    dataRows.forEach(element => {

        let formData = new FormData();

        formData.append('productId', element[3].childNodes[1].value)
        formData.append('process_category_page', 'delete_product');

        axios.post('/api/Edit_products_category', formData).then(Response =>{
            if(Response.data.text == 'productDeleted'){
                createAlert('success', 'Product Deleted!','');
                document.querySelectorAll('.dataRows')[index-1].remove()
                
            }
            
        })
    });
}
