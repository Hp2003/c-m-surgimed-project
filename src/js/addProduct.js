{
    document.querySelector('.add_product').addEventListener('click', (e)=>{
        e.preventDefault();

        const form  = document.getElementById('addProductForm');
        form.querySelector('.toggle').disabled = true;
        let formData = new FormData( form);
        // console.log(formData);
        if(checkInput(formData)){
            AddProduct(formData);
        }
    })

    function checkInput(form){
        const img = document.querySelector('.productImg');
        for(let pair of form){
            // console.log(pair[0] , pair[1]);
            if( img.files.length < 1){
                createAlert('warning', `Please Select an <b>Image</b>`, '')
                return 0;
            }else if(pair[1] === ''){
                createAlert('warning', `Please Enter <b>${pair[0]}</b>`, '')
                return 0;
            }else if(pair[0] === 'product_price'){
                console.log('in');
                const regex =/^\d+(\.\d{1,2})?$/;

                if (regex.test(pair[1])) {
                    // Valid input
                    // console.log('Product price:', Math.floor([1]));
                } else {
                    // Invalid input
                    createAlert('warning', `Please Enter <b>Valid Price </b>`, '')
                    return 0;
                }
            }else if(pair[0] === 'new_category'){
                const options = document.querySelectorAll('.option')
                options.forEach(Element =>{
                    if(Element.value.toUpperCase().trim() === pair[1].toUpperCase().trim() ){
                        createAlert('warning', `Please Enter <b>New category </b>`, '')
                        return 0;
                        if(pair[1].length > 100){
                            createAlert('warning', `Please Enter small name  max length <b>100</b> charcters on <b>New category </b>`, '')
                            return 0;

                        }
                    }
                })
            }else if(pair[0] === 'product_title' && pair[1].length > 255){
                createAlert('warning', `Please Enter small title  max length <b>255</b> charcters on <b>Title </b>`, '');
                return 0;
            }else if(pair[0] === 'product_desc' && pair[1].length > 1000){
                createAlert('warning', `Please Enter small title  max length <b>1000</b> charcters on <b>description </b>`, '');
                return 0;
            }else if(pair[0] === 'qoh' && pair[1] < 0  ){
                createAlert('warning', `Please Enter A Valid  <b>Qoh </b>`, '');
                return 0;
            }
        }
        // if(imgsCount <= 1){
        //     createAlert('warning', '', 'Please Select An <b>Image</b>')
        //     return 0;
        // }
        return 1;

    }
    function AddProduct(data){
        // make ajax request
        const img = document.querySelector('.productImg');
        
        const filesImg = Array.from(img.files);
  
        for(let i = 0; i < filesImg.length; i++) {
            data.append('proImages', filesImg[i]);
        }
        // data.getAll('proImages').forEach(element => {
        //     console.log(element);
        // });
        data.append('type', 'AddProduct');
        axios.post('/api/add_product', data).then(Response =>{
            if(Response.data.text != "" || Response.data.text != undefined){
                if(Response.data.text == 'noImg'){
                    createAlert('danger', 'please select an <b>Image</b>', '');
                }
                if(Response.data.text == 'failedUploadingImg'){
                    createAlert('warning', 'Failed uploading image', '');
                }if(Response.data.text =='ProductAdded'){
                    createAlert('success', 'Product Has Been Added Successfully!','');
                }
            }
            // console.log('here');
            // console.log(Response.data);
            // console.log(Response.data)
        })
    }

}



  

