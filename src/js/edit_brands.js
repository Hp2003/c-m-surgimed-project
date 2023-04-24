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
        console.log(data);
        data.forEach((Element , index) => {
            console.log(Element)
            container.innerHTML += `
        <tr>
                            <td>${index + 1}</td>
                            <td>${Element.BrandId}</td>
                            <td class="brandName">${Element.BrandName}<input type='hidden' class='iprice' value='1'></td>
                            <input type="hidden" class='brandId' name="UserId" value="${Element.BrandId}">
                            <td >${Element.CreatedAt}</td>
                            <td >${Element.UpdatedAt}</td>
                            <td >${Element.ProductCount}</td>
                            <td ><a onclick = 'editBrandName(event, this , ${index})'><i class="fa fa-pencil" aria-hidden="true" style="cursor:pointer"></i></a>
                            </td>
                            
                           
                            <td>${
                                Element.IsDeleted == 1 ? `<form action='manage_cart.php' method='post'>
                                <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled removeBrand' onclick="removeBrand(event, this ${index})" style="position:unset"><i
                                        class='fa-solid fa-trash'></i></button>
                                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                            </form>
    
                        </td>`:`<form action='manage_cart.php' method='post'>
                                <button name='Remove_Item' class='btn btn-sm btn-outline-danger removeBrand' onclick="removeBrand(event, this, ${index})" style="position:unset"><i
                                        class='fa-solid fa-trash'></i></button>
                                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                            </form>
    
                        </td>`
                            }
                            <td>${
                                Element.IsDeleted != 1? `<form action='manage_cart.php' method='post'>
                                <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled re-openBrand' onclick="reOpenBrand(event, this, ${index})" style="position:unset"><i class="fa-solid fa-door-open"></i></button>
                                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                            </form>
    
                        </td>`:`<form action='manage_cart.php' method='post'>
                                <button name='Remove_Item' class='btn btn-sm btn-outline-danger re-openBrand' onclick="reOpenBrand(event, this, ${index})" style="position:unset"><i class="fa-solid fa-door-open"></i></button>
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
                createAlert('warning', 'Failed creating brand!', '');
                return 0;
            }
        })
    }
}
function removeBrand(e,btn,index){
    e.preventDefault();

    const confirmation = window.prompt('Please type confirm to  continue : ');
    if(confirmation == null ){
        return 0;
    }
    if(confirmation != undefined || confirmation.trim() != ""  ){

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
                console.log(Response.data)
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

function editBrandName(event, btn , index){
    event.preventDefault();
    let newName = window.prompt('Enter new Name ');
    let form = new FormData();
    form.append('process', 'changeBrandName')
    form.append('name', newName)
    form.append('id', document.querySelectorAll('.brandId')[index].value);
    
    if(newName != null && newName.trim() != ""){
        console.log(newName.length)
        if(newName.length <= 140){
            axios.post('/api/edit_brand', form).then(Response =>{
                if(Response.data.data == 1){
                    createAlert('success', 'Brand Name changed ', '');
                    document.querySelectorAll('.brandName')[index].textContent = newName;
                    return 1;
                }
            })
        }else{
            createAlert('warning', 'please enter small brand name ','');
            return 0;
        }

    }
}