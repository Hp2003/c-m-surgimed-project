let currentOffset = 0;

function genrateHeaderSummary(list) {
  let container = document.querySelector(".header-summary");
  container.innerHTML = "";
  list.forEach((element, index) => {
    container.innerHTML += `<th scope="col">${element}</th>`;
  });
}
// genrate headers for details 
function genrateHeaderDetails(list) {
  let container = document.querySelector(".detail-header");
  container.innerHTML = "";
  list.forEach((element, index) => {
    container.innerHTML += `<th>${element}</th>`;
  });
}
function fillData(data, index = 1 ) {

    //   let len = Object.keys(data).length;
    let container = document.querySelector(".summery-tableBody");
    let headers = document.querySelector(".header-summary");
    let thTags = headers.querySelectorAll("th");
    const columns = thTags.length;



    // Create the row element
    const row = document.createElement("tr");

    const indexCell = document.createElement("td");
    const indexCellData = index;
    indexCell.innerHTML = indexCellData;
    row.appendChild(indexCell);
    for (let i = 0; i < columns-1; i++) {

    // Create the cell element
    const cell = document.createElement("td");

    // Get the data for this cell
    const cellData = data[i];

    // Set the cell content
    cell.innerHTML = cellData;

    // Append the cell to the row
    row.appendChild(cell);
}

// Append the row to the container
container.appendChild(row);

}



// converting dict to array in given format
function filterData(oldDict, newFormat) {
  let newDict = [];
  
//   return Object.values(newObject);
  newFormat.forEach((element, index) => {
    for(const key in oldDict){
        if(key == element){
            newDict.push(oldDict[key]);
        }
    }
  });
//   console.log(newDict);
  return newDict
}
function rednderDetails(data, offset ){
        //   let len = Object.keys(data).length;
        let container = document.querySelector(".detail-tableBody");
        let headers = document.querySelector(".detail-header");
        let thTags = headers.querySelectorAll("th");
        const columns = thTags.length;
    
    
        // Create the row element
        const row = document.createElement("tr");
    
        const indexCell = document.createElement("td");
        const indexCellData = offset;
        indexCell.innerHTML = indexCellData;
        row.appendChild(indexCell);
        for (let i = 0; i < columns-1; i++) {
        
            // Create the cell element
            const cell = document.createElement("td");
        
            // Get the data for this cell
            const cellData = data[i];
        
            // Set the cell content
            cell.innerHTML = cellData;
        
            // Append the cell to the row
            row.appendChild(cell);
        }
        container.appendChild(row);
}