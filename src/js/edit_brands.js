function openBrandPage(e,btn){
    e.preventDefault();

    let formData = new FormData();

    formData.append('process', 'getView');
    axios.post('/api/edit_brand', formData).then(Response =>{
        console.log(Response);
        document.body.style.backgroundColor = 'white';
        renderUserTable(Response.data.html);
        DisplayBrand(Response.data.brandData);
    })
}

function DisplayBrand(data, removeAll = false){
        let container = document.querySelector('.tableBody')
        let prevemail;
        if(removeAll){
            container.innerHTML = '';
            removeAll = false;
        }
        data.forEach((Element , index) => {

            container.innerHTML += `
        <tr>
                            <td>${index + 1}</td>
                            <td>${Element.BrandId}</td>
                            <td>${Element.BrandName}<input type='hidden' class='iprice' value='1'></td>
                            <input type="hidden" class='brandId' name="UserId" value="${Element.BrandId}">
                            <td >${Element.CreatedAt}</td>
                            <td >${Element.UpdatedAt}</td>
                            
                            <td>${
                                Element.IsDeleted == true? `<form action='manage_cart.php' method='post'>
                                <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled removeBrand' onclick="removeBrand(event, this ${index})"><i
                                        class='fa-solid fa-trash'></i></button>
                                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                            </form>
    
                        </td>`:`<form action='manage_cart.php' method='post'>
                                <button name='Remove_Item' class='btn btn-sm btn-outline-danger removeBrand' onclick="removeBrand(event, this, ${index})"><i
                                        class='fa-solid fa-trash'></i></button>
                                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                            </form>
    
                        </td>`
                            }
                            <td>${
                                Element.IsDeleted != true? `<form action='manage_cart.php' method='post'>
                                <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled re-openBrand' onclick="reOpenBrand(event, this, ${index})"><i class="fa-solid fa-door-open"></i></button>
                                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                            </form>
    
                        </td>`:`<form action='manage_cart.php' method='post'>
                                <button name='Remove_Item' class='btn btn-sm btn-outline-danger re-openBrand' onclick="reOpenBrand(event, this, ${index})"><i class="fa-solid fa-door-open"></i></button>
                                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                            </form>
    
                        </td>`
                            }
                                
                        </tr>
        `;
        // console.log(prevemail)
    });
}

function addNewBrand(e,btn){
    // console.log('aklfl');
    e.preventDefault();
    
    let BrandName = window.prompt('Enter new Brand name : ');
    if(BrandName != undefined || BrandName.trim() != ""){
        let formData  = new FormData();

        formData.append('brandName', BrandName);
        formData.append('process', 'addnewbrand');
        axios.post('/api/edit_brand', formData).then(Response=>{
            console.log(Response)
            if(Response.data.data == 3){
                createAlert('warning','Brand Name already exist ','');
                return 0;
            }
            if(Response.data.data == 1){
                createAlert('success','Brand Created Successfully! ','');
                return 1;
            }
            if(Response.data.data == 2){
                creataeAlert('warning', 'Failed creating brand!', '');
                return 0;
            }
        })
    }
}
function removeBrand(e,btn,index){
    e.preventDefault();

    const confirmation = window.prompt('Please type confirm to  continue : ');

    if(confirmation != undefined || confirmation.trim() != "" ){

        if(confirmation == 'confirm'){
            let formData  = new FormData();

            formData.append('brandId', document.querySelectorAll('.brandId')[index].value);
            formData.append('process', 'removebrand');
            axios.post('/api/edit_brand', formData).then(Response =>{
                console.log(Response)
                if(Response.data.data == 1){
                    createAlert('success','Brand Deleted Successfully! ','');
                    document.querySelectorAll('.re-openBrand')[index].classList.remove('disabled');
                    document.querySelectorAll('.removeBrand')[index].classList.add('disabled');

                    return 1;
                }
                if(Response.data.data == 2){
                    creataeAlert('warning', 'Failed Deleting brand!', '');
                    return 0;
                }
            })
        }
    }
}
function reOpenBrand(e,btn,index){
    e.preventDefault();

    let formData  = new FormData();

    formData.append('brandId', document.querySelectorAll('.brandId')[index].value);
    formData.append('process', 're-openbrand');
    axios.post('/api/edit_brand', formData).then(Response =>{
        console.log(Response)
    if(Response.data.data == 1){
        createAlert('success','Brand re-opened Successfully! ','');
        document.querySelectorAll('.re-openBrand')[index].classList.add('disabled');
        document.querySelectorAll('.removeBrand')[index].classList.remove('disabled');

        return 1;
    }
    if(Response.data.data == 0){
        creataeAlert('warning', 'Failed re-opening brand!', '');
        return 0;
    }
    })
}
function searchBrand(e,btn,index){
    e.preventDefault();

    let searchInput = document.querySelector('.search_brand_input').value;
    if(searchInput == ""){
        openBrandPage(e,btn);
    }
    let formData  = new FormData();

    formData.append('process', 'searchbrand');
    formData.append('name', searchInput);
    axios.post('/api/edit_brand', formData).then(Response =>{
        console.log(Response.data.data.length)
    if(Response.data.data == 0){
        createAlert('warning', 'Failed Brand is not available !', '');
        return 0;
    }
    console.log('here')
    DisplayBrand(Response.data.data, true);

    return 1;
    })
}