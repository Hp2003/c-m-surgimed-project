let desicion ;
function genTableFromDesicion(data, removePrev){
    desicion = data.desicion;
    // console.log(data);
    if(data.desicion == 'sub_with_rows'){
        // currentForm = data;
        console.log(data.data);
        // creating headers for summary table
        genrateHeaderSummary(['Serial No.', 'Id', 'Name', 'Units Sold', 'Revenue', 'Cancelled Orders']);
    
        // removing rows from summery table
        let con = document.querySelector(".summery-tableBody");
            con.innerHTML = '';
        
        // console.log('in prec');
        data.data.forEach((element, index) => {
            let newDict = filterData(element, ['product_id', 'product_name', 'total_units_sold', 'total_selling', 'cancelled_orders']);
            fillData(newDict, index + 1);
        });
        console.log(data.data1);
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
        // currentForm = data;
        console.log(data.data);
    
        // creating headers for summary table
        genrateHeaderSummary(['Serial No.', 'Id', 'Name', 'Units Sold', 'Revenue', 'Cancelled Orders', 'Total']);
    
        let newDict = filterData(data.data[0], ['main_category_id', 'main_category_name', 'total_units_sold', 'total_selling', 'cancelled_orders']);
        console.log(newDict)
        fillData(newDict);
        console.log(data.data1);
        let container = document.querySelector(".detail-tableBody");
        container.innerHTML = '';
        // rendring details header
        genrateHeaderDetails(['Serial No.', 'Id', 'Name', 'Total Selling', 'Revenue', 'Cancelled Orders'])
    
        data.data1.forEach(element=>{
    
          const newData = filterData(element, ['category_id', 'category_name', 'total_units_sold', 'total_selling','cancelled_orders' ])
          rednderDetails(newData, ++currentOffset );
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
      console.log('in');
      genTableFromDesicion(Response.data, false);
    });
}