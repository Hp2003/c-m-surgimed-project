let desicion ;
function genTableFromDesicion(data, removePrev){
    desicion = data.desicion;
    // console.log(data);

    if(data.desicion == 'sub_with_rows'){
        document.querySelector('.report-btns').style.display = 'block';
        document.querySelector('.combineRevBtn').removeAttribute('onclick');
        document.querySelector('.combineRevBtn').setAttribute('onclick', "genrateCombineRevenue(event, this)")
        document.querySelector('.combineSellingBtn').removeAttribute('onclick')
        document.querySelector('.combineSellingBtn').setAttribute('onclick', "genrateCombineSelling(event, this)")
        document.querySelector('.combineCancelledBtn').removeAttribute('onclick')
        document.querySelector('.combineCancelledBtn').setAttribute('onclick', "genrateCombineCancelled(event, this)")
        // console.log(data);
        let listClasses = ['title','units-sold-main', 'revenue-main', 'cancelled-orders']
        genrateHeaderSummary(['Serial No.', 'Id', 'Name', 'Units Sold', 'Revenue', 'Cancelled Orders','Pi Chart']);
        
        // removing rows from summery table
        let con = document.querySelector(".summery-tableBody");
            con.innerHTML = '';
        
        // console.log('in prec');
        data.data.forEach((element, index) => {
            let newDict = filterData(element, ['product_id', 'product_name', 'total_units_sold', 'total_selling', 'cancelled_orders']);
            fillData(newDict, index + 1,listClasses, [2,3,4,5]);
        });
        // console.log(data.data1);
        let container = document.querySelector(".detail-tableBody");
        if(removePrev){
            container.innerHTML = '';
        }
        // rendring details header
        genrateHeaderDetails(['Serial No.', 'Id', 'Name', 'Quantity', 'Price', 'OrderId', 'Customer Id' , `Total Price`,  'Placed On', `Status`])
    
        data.data1[0].forEach(element=>{
    
          const newData = filterData(element, ['product_id', 'product_title', 'unit_sold', 'product_price','order_id', 'cutomer_id', `total_price`,`placed_on`, `order_status` ])
          rednderDetails(newData, ++currentOffset );
        })
        if(data.data1[0].length >= 100){
            document.querySelector('.button-container').innerHTML = '	<button type="button" class="btn btn-primary" onclick = "loadMore(event)">Load More</button>';
        }
    }

    else if(data.desicion == 'main_with_rows'){
        document.querySelector('.report-btns').style.display = 'block';
        document.querySelector('.combineRevBtn').removeAttribute('onclick');
        document.querySelector('.combineRevBtn').setAttribute('onclick', "genrateCombineRevenue(event, this,true)")
        document.querySelector('.combineSellingBtn').removeAttribute('onclick')
        document.querySelector('.combineSellingBtn').setAttribute('onclick', "genrateCombineSelling(event, this,true)")
        document.querySelector('.combineCancelledBtn').removeAttribute('onclick')

        document.querySelector('.combineCancelledBtn').setAttribute('onclick', "genrateCombineCancelled(event, this,true)")
        let listClasses = ['units-sold-main', 'revenue-main', 'cancelled-orders']
        let con = document.querySelector(".summery-tableBody");
        con.innerHTML = '';
        // creating headers for summary table
        genrateHeaderSummary(['Serial No.', 'Id', 'Name', 'Units Sold', 'Revenue', 'Cancelled Orders', 'Total']);
    
        let newDict = filterData(data.data[0], ['main_category_id', 'main_category_name', 'total_units_sold', 'total_selling', 'cancelled_orders']);
        // console.log(newDict)
        fillData(newDict,1,listClasses, [3,4,5]);
        // console.log(data.data1);
        let container = document.querySelector(".detail-tableBody");
        if(removePrev){
            container.innerHTML = '';
        }
        // rendring details header
        genrateHeaderDetails(['Serial No.', 'Id', 'Name', 'Units Sold', 'Revenue', 'Cancelled Orders'])
    
        listClasses = ['title', 'units-sold-main', 'revenue-main', 'cancelled-orders']
        data.data1.forEach(element=>{
    
          const newData = filterData(element, ['category_id', 'category_name', 'total_units_sold', 'total_selling','cancelled_orders' ])
          rednderDetails(newData, ++currentOffset,listClasses, [2,3,4,5] );
        })

        if(data.data1[0].length >= 100){
            document.querySelector('.button-container').innerHTML = '	<button type="button" class="btn btn-primary" onclick = "loadMore(event)">Load More</button>';
        }
    }
    else if(data.desicion == 'product_with_id'){
        let listClasses = ['title','units-sold-main', 'revenue-main', 'cancelled-orders']
        document.querySelector('.report-btns').style.display = 'none';
        console.log('with id')
        // document.querySelector('.combineRevBtn').removeAttribute('onclick');
        // document.querySelector('.combineRevBtn').setAttribute('onclick', "genrateCombineRevenue(event, this)")
        // document.querySelector('.combineSellingBtn').removeAttribute('onclick')
        // document.querySelector('.combineSellingBtn').setAttribute('onclick', "genrateCombineSelling(event, this)")
        // document.querySelector('.combineCancelledBtn').removeAttribute('onclick')
        // document.querySelector('.combineCancelledBtn').setAttribute('onclick', "genrateCombineCancelled(event, this)")
        // currentForm = data;
        console.log(data.data);
        // creating headers for summary table
        let con = document.querySelector(".summery-tableBody");
        con.innerHTML = '';
        genrateHeaderSummary(['Serial No.', 'Id', 'Name', 'Units Sold', 'Revenue', 'Cancelled Orders','Pi Chart']);
        
        data.data.forEach((element, index) => {
            // console.log(index);
            let newDict = filterData(element, ['product_id', 'product_name', 'total_units_sold', 'total_selling', 'cancelled_orders']);
            fillData(newDict, index + 1, listClasses, [2,3,4,5]);
        });
        // currentForm = data;
        console.log(data.data1);
        let container = document.querySelector(".detail-tableBody");
        container.innerHTML = '';
        // rendring details header
        genrateHeaderDetails(['Serial No.', 'Product Id', 'Order Id', 'Cutstomer Id', 'Placed On', 'Revenue', 'Product Price', 'Quantity', 'Order Status'])
    
        data.data1[0].forEach(element=>{
        //  console.log(element)
          const newData = filterData(element, ['product_id','order_id','cutomer_id', 'placed_on','total_price', 'product_price', 'unit_sold', 'order_status' ])
          rednderDetails(newData, ++currentOffset );
        })

        if(data.data1[0].length >= 100){
            document.querySelector('.button-container').innerHTML = '	<button type="button" class="btn btn-primary loadMore" onclick = "loadMore(event)">Load More</button>';
        }else{
            if(document.querySelector('.loadMore') != undefined ){
                if(data.data1[0].length < 100){
                    document.querySelector('.loadMore').remove()
                }
            }
        }
    }else if(data.desicion == 'default_view'){
        document.querySelector('.report-btns').style.display = 'block';
        document.querySelector('.combineRevBtn').removeAttribute('onclick');
        document.querySelector('.combineRevBtn').setAttribute('onclick', "genrateCombineRevenue(event, this,true)")
        document.querySelector('.combineSellingBtn').removeAttribute('onclick')
        document.querySelector('.combineSellingBtn').setAttribute('onclick', "genrateCombineSelling(event, this,true)")
        document.querySelector('.combineCancelledBtn').removeAttribute('onclick')
        document.querySelector('.combineCancelledBtn').setAttribute('onclick', "genrateCombineCancelled(event, this,true)")
        let con = document.querySelector(".summery-tableBody");
        con.innerHTML = '';
        let listClasses = ['units-sold-main', 'revenue-main', 'cancelled-orders'];
            genrateHeaderSummary(['Serial No.', 'Units Sold', 'Revenue', 'Cancelled Orders', 'Pi Chart']);
            let newDict = filterData(data.data, ['total_units_sold', 'total_selling', 'cancelled_orders']);
            fillData(newDict, 1,listClasses,[1,2,3]);

        let container = document.querySelector(".detail-tableBody");
        // console.log(data.data1)
        if(removePrev){
            container.innerHTML = '';
        }
        // rendring details header
        genrateHeaderDetails(['Serial No.', 'Id', 'Name', 'Total Orders', 'Revenue', 'Cancelled Orders'])

        data.data1.forEach(element=>{
          listClasses = ['title', 'units-sold-main', 'revenue-main', 'cancelled-orders']
          const newData = filterData(element, ['main_category_id', 'main_category_name', 'total_units_sold', 'total_selling','cancelled_orders' ])
          rednderDetails(newData, ++currentOffset, listClasses, [2,3,4,5]);
        })

        if(data.data1[0].length >= 100){
            document.querySelector('.button-container').innerHTML = '	<button type="button" class="btn btn-primary" onclick = "loadMore(event)">Load More</button>';
        }
    }
}

function loadMore(e){
    e.preventDefault();
    console.log(currentForm);
    let formData = new FormData(currentForm);
    formData.set("start_time", formData.get("start_time").replace("T", " "));
    formData.set("end_time", formData.get("end_time").replace("T", " "));
    formData.set('get_summery', true);
    formData.append("process", "get_data");
    formData.append("offset",currentOffset);
    console.log(formData);
    axios.post("/api/get_report", formData).then((Response) => {
      console.log(Response);
      genTableFromDesicion(Response.data, false);
    });

}