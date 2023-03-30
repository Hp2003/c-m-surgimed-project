let currentUsrCount = 0;
document.querySelector('.getUserBtn').addEventListener('click', (e)=>{
    e.preventDefault();
    let formData = new FormData();
  
    formData.append('process_for_all_user_page', 'get_ui');
    formData.append('offset', 0);
    currentUsrCount = 0;
    axios.post('/api/list_all_user', formData).then(response =>{
      document.body.style.backgroundColor = 'white';
      console.log(response.data.userData);
      renderUserTable(response.data.html);
      createUserDataTable(response.data.userData);
    })
})

function renderUserTable(html){
     // console.log(html);
  const contentParent = document.getElementById("content").parentElement;

  // Create a temporary div element and set its innerHTML to the response HTML
    const tempDiv = document.createElement("div");
    tempDiv.innerHTML = html;
  
    // Get the new content element from the temporary div
    const newContent = tempDiv.firstChild;
  
    // Replace the existing content with the new content
    const contentElement = document.getElementById("content");
    contentElement.innerHTML = '';
    contentElement.appendChild(newContent);
}

function createUserDataTable(data){
    let container = document.querySelector('.tableBody')
    data.forEach((Element) => {
        if(Element.Email == undefined){
            return 0;
        }
        container.innerHTML += `
    <tr>
						<td>${currentUsrCount + 1}</td>
						<td>${Element.UserId}</td>
						<td>${Element.UserName}<input type='hidden' class='iprice' value='1'></td>
						<input type="hidden" class='userId' name="UserId" value="${Element.UserId}">
						<td >${Element.FirstName}</td>
						<td >${Element.LastName}</td>
						<td >${Element.Email}</td>
						<td >${Element.order_count}</td>
						<td >${Element.total_order_count}</td>
						<td >${Element.Gender}</td>
						<td>
							<form action='manage_cart.php' method='post'>
								<button name='Remove_Item' class='btn btn-sm btn-outline-danger' onclick="removeUser(event, element, ${currentUsrCount})"><i
										class='fa-solid fa-trash'></i></button>
								<input type='hidden' name='Item_Name' value='$value[Item_Name]'>
							</form>

						</td>
					</tr>
    `;
    currentUsrCount++;

    });
    if(data[data.length -1 ] ){
        if(document.querySelector('.paginationBtnUser')  == undefined){
            document.querySelector('.pagination-btn').innerHTML += `<button type="button" class="btn btn-primary paginationBtnUser" onclick="loadMoreUser()">Load More...</button>`;
        }
    }
} 
function loadMoreUser(){
    let formData = new FormData();
  
    formData.append('process_for_all_user_page', 'loadMoreUser');
    formData.append('offset', currentUsrCount);
    
    axios.post('/api/list_all_user', formData).then(response =>{
      document.body.style.backgroundColor = 'white';
      console.log(response.data.userData);
    //   renderUserTable(response.data.html);
      createUserDataTable(response.data.userData);
        document.querySelector('.paginationBtnUser').remove();
        console.log(response.data.userData[response.data.userData.length - 1])
        if(response.data.userData[response.data.userData.length - 1]){
            document.querySelector('.pagination-btn').innerHTML += `<button type="button" class="btn btn-primary paginationBtnUser" onclick="loadMoreUser()">Load More...</button>`;
        }
    })
}
function searchUser(event){
    if(event.keyCode === 13 ){
        let id = document.querySelector('.search_user_input').value;
        if(/^#!:\d+$/.test(id)){
            let formData = new FormData()
            formData.append('id', id);
            formData.append('process_for_all_user_page', 'searchWithUserId');
            axios.post('/api/list_all_user', formData).then(response =>{
                
                console.log(response.data.userData); 
                createUserDataTable([response.data.userData]);
            })
            
            event.preventDefault();
            return 0;
        }else{
            createAlert('warning', 'enter valid id','');
        }
        event.preventDefault();
        // formData.append('id', )
    }
    console.log('he')

}