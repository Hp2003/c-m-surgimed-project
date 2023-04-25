{
let currentUsrCount = 0;
let currentOrder = 'old';
let condition = 'normal';
let userSearchInput = '';
document.querySelector('.getUserBtn').addEventListener('click', (e)=>{
    e.preventDefault();
    let formData = new FormData();
    if(document.querySelector('.loadMoreProducts') != null){
        document.querySelector('.loadMoreProducts').remove();
    }
  
    formData.append('process_for_all_user_page', 'get_ui');
    formData.append('offset', 0);
    currentUsrCount = 0;
    condition = 'normal';
    axios.post('/api/list_all_user', formData).then(response =>{
      
      document.body.style.backgroundColor = 'white';
      console.log(response.data.userData);
      renderUserTable(response.data.html);
      createUserDataTable(response.data.userData, true);
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

function createUserDataTable(data ,firstTime = false){
    let container = document.querySelector('.tableBody')
    let prevemail;
    data.forEach((Element) => {
        if(prevemail == Element.Email){
            return;
        }
        if(Element.Email == undefined ){
            return ;
        }
        if(firstTime){
            container.innerHTML = '';
            firstTime = false;
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
						<td >${Element.JoinedAt}</td>
						
						<td >${Element.Gender}</td>
						<td >${Element.IsDeleted}</td>
						
						<td>${
                            Element.IsDeleted == true? `<form action='manage_cart.php' method='post'>
                            <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled del' onclick="removeUser(event, this, ${currentUsrCount})" style="position:unset"><i
                                    class='fa-solid fa-trash'></i></button>
                            <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                        </form>

                    </td>`:`<form action='manage_cart.php' method='post'>
                            <button name='Remove_Item' class='btn btn-sm btn-outline-danger del' onclick="removeUser(event, this, ${currentUsrCount})" style="position:unset"><i
                                    class='fa-solid fa-trash'></i></button>
                            <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                        </form>

                    </td>`
                        }
                        <td>${
                            Element.IsDeleted == false? `<form action='manage_cart.php' method='post'>
                            <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled reopen' onclick="OpenAccount(event, this, ${currentUsrCount})" style="position:unset"><i class='fas fa-door-open'></i></button>
                            <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                        </form>
    
                    </td>`:`<form action='manage_cart.php' method='post'>
                            <button name='Remove_Item' class='btn btn-sm btn-outline-danger reopen' onclick="OpenAccount(event, this, ${currentUsrCount})" style="position:unset"><i class='fas fa-door-open'></i></button>
                            <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                        </form>
    
                    </td>`
                        }
							
					</tr>
    `;
    currentUsrCount++;
    prevemail = Element.Email;
    // console.log(prevemail)
});
console.log(currentUsrCount);
    if(data[data.length -1 ] ){
        if(document.querySelector('.paginationBtnUser')  == undefined){
            document.querySelector('.pagination-btn').innerHTML += `<button type="button" class="btn btn-primary paginationBtnUser" onclick="loadMoreUser()">Load More...</button>`;
        }
    }else{
        if(document.querySelector('.paginationBtnUser') != undefined){
            document.querySelector('.paginationBtnUser').remove();
        }
    }
} 
let count = 0;
function loadMoreUser(){
    
    // console.log(condition);
if(condition == 'normal'){
    let formData = new FormData();
    console.log(++count);
    formData.append('process_for_all_user_page', 'loadMoreUser');
    formData.append('offset', currentUsrCount);
    console.log(currentUsrCount);
    formData.append('order', currentOrder);
    axios.post('/api/list_all_user', formData).then(response =>{
        createUserDataTable(response.data.userData);
        console.log(currentOrder);
        if(document.querySelector('.paginationBtnUser') != null || document.querySelector('.paginationBtnUser') != undefined){
            document.querySelector('.paginationBtnUser').remove();
        }
        //   console.log(response.data.userData[response.data.userData.length - 1])
          if(response.data.userData[response.data.userData.length - 1] ){
            //   console.log('here displaying btn');
              document.querySelector('.pagination-btn').innerHTML += `<button type="button" class="btn btn-primary paginationBtnUser" onclick="loadMoreUser()">Load More...</button>`;
          }
      })
}else if(condition = 'search'){
    let formData = new FormData();

    formData.append('process_for_all_user_page', 'searchWithUserName');
    formData.append('offset', currentUsrCount);
    // formData.append('order', currentOrder);
    formData.append('id', userSearchInput);

    axios.post('/api/list_all_user', formData).then(response =>{
        document.body.style.backgroundColor = 'white';
        // console.log(response.data.userData);
      //   renderUserTable(response.data.html);
        createUserDataTable(response.data.userData);
        // console.log(userSearchInput);
        if(document.querySelector('.paginationBtnUser') != null || document.querySelector('.paginationBtnUser') != undefined){
            document.querySelector('.paginationBtnUser').remove();
        }
          console.log(response.data.userData[response.data.userData.length - 1])
          if(response.data.userData[response.data.userData.length - 1] ){
            //   console.log('here displaying btn');
              document.querySelector('.pagination-btn').innerHTML += `<button type="button" class="btn btn-primary paginationBtnUser" onclick="loadMoreUser()">Load More...</button>`;
          }
      })
}

}
function searchUser(event){
    event.preventDefault();
    console.log('in');
        let id = document.querySelector('.search_user_input').value;
        if(id.trim() != ""){
            let formData = new FormData();

            formData.append('process_for_all_user_page', 'get_ui');
            formData.append('offset', 0);
            currentUsrCount = 0;
            axios.post('/api/list_all_user', formData).then(response =>{
                
            document.body.style.backgroundColor = 'white';
            // console.log(response.data.userData);
            // renderUserTable(response.data.html);
            createUserDataTable(response.data.userData, true);
                event.preventDefault();
                return 0;
            })
        if(id[0] == '#'){
            if(/^#!:\d+$/.test(id) ){
                searchUserWithIdName(id, 'searchWithUserId');
                event.preventDefault();
                return 0;
            }else{
                createAlert('warning', 'enter valid id','');
                event.preventDefault();
                return 0;
            }
        }else{
            if(id != ""){
                searchUserWithIdName(id, 'searchWithUserName');
                condition = 'search';
                userSearchInput = id;
                event.preventDefault();
                return 0;
            }
        }  

        
        // formData.append('id', )
    }
    // console.log('he')

}
function searchUserWithIdName(id, process){

    let formData = new FormData()
    formData.append('id', id);
    formData.append('offset', 0);
    formData.append('process_for_all_user_page', `${process}`);
    axios.post('/api/list_all_user', formData).then(response =>{
        if(response.data.userData == 'UserNotFound'){
            createAlert('warning', 'User not found!', '') ;

        }else{
            currentUsrCount = 0;

            if(process == 'searchWithUserName'){
                // console.log(response.data.userData)
                if(response.data.userData == 'UserNotFound'){
                    createAlert('warning', 'User Not Found', '');
                    return;
                }
                // renderUserTable(response.data.html);
                currentUsrCount = 0
                createUserDataTable(response.data.userData, true);
                document.querySelector('.paginationBtnUser').style.display = 'block';
            }if(process == 'searchWithUserId'){
                currentUsrCount = 0;

                listSingleUser(response.data.userData);
                document.querySelector('.paginationBtnUser').style.display = 'none';
            }
        }
    })
}
function listSingleUser(data){
    let container = document.querySelector('.tableBody')
    container.innerHTML = `
<tr>
                    <td>${1}</td>
                    <td>${data.UserId}</td>
                    <td>${data.UserName}<input type='hidden' class='iprice' value='1'></td>
                    <input type="hidden" class='userId' name="UserId" value="${data.UserId}">
                    <td >${data.FirstName}</td>
                    <td >${data.LastName}</td>
                    <td >${data.Email}</td>
                    <td >${data.order_count}</td>
                    <td >${data.JoinedAt}</td>
                    <td >${data.Gender}</td>
                    <td >${data.IsDeleted}</td>
                    <td>${
                        data.IsDeleted == true? `<form action='manage_cart.php' method='post'>
                        <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled del' onclick="removeUser(event, this, ${currentUsrCount})" style="position:unset"><i
                                class='fa-solid fa-trash'></i></button>
                        <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                    </form>

                </td>`:`<form action='manage_cart.php' method='post'>
                        <button name='Remove_Item' class='btn btn-sm btn-outline-danger del' onclick="removeUser(event, this, ${currentUsrCount})" style="position:unset"><i
                                class='fa-solid fa-trash'></i></button>
                        <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                    </form>

                </td>`
                    }
                    <td>${
                        data.IsDeleted == false? `<form action='manage_cart.php' method='post'>
                        <button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled reopen' onclick="OpenAccount(event, this, ${currentUsrCount})" style="position:unset"><i class='fas fa-door-open'></i></button>
                        <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                    </form>

                </td>`:`<form action='manage_cart.php' method='post'>
                        <button name='Remove_Item' class='btn btn-sm btn-outline-danger reopen' onclick="OpenAccount(event, this, ${currentUsrCount})" style="position:unset"><i class='fas fa-door-open'></i></button>
                        <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                    </form>

                </td>`
                    }
                </tr>
`;
currentUsrCount = 0;
}

function orderBy(event, btn){
    // console.log('in');
    let formData = new FormData();
    // console.log(event.target.value)
    formData.append('process_for_all_user_page', 'get_ui');
    formData.append('offset', 0);
    formData.append('order', event.target.value);
    currentOrder = event.target.value;
    currentUsrCount = 0;
    condition = 'normal';
    axios.post('/api/list_all_user', formData).then(response =>{
      document.body.style.backgroundColor = 'white';
    //   console.log(response.data.userData);
    //   renderUserTable(response.data.html);
      createUserDataTable(response.data.userData, true);

    })
}

function removeUser(e, btn, index){
    e.preventDefault();
    const idS = document.querySelectorAll('.userId');
    let formData = new FormData();

    formData.append('process_for_all_user_page', 'DeleteUser');
    formData.append('uid', idS[index].value)
    if(window.confirm('do you really want to delete UserId : ' + idS[index].value)){
        axios.post('/api/list_all_user', formData).then(response =>{
            console.log(response);
            if(response.data.userData == true ){
                createAlert('success', `User ${idS[index].value} Removed success fully!`, '');
                document.querySelectorAll('.del')[index].classList.add('disabled');
                document.querySelectorAll('.reopen')[index].classList.remove('disabled');
            }else{
                createAlert('warning', `Failed Removing User ${idS[index].value} `, '');
            }
        })
    }

}
function OpenAccount(e,btn,index){
    e.preventDefault();
    const idS = document.querySelectorAll('.userId');
    let formData = new FormData();

    formData.append('process_for_all_user_page', 'reopenaccount');
    console.log(index)
    formData.append('uid', idS[index].value)
    if(window.confirm('do you really want to re-open UserId : ' + idS[index].value)){
        axios.post('/api/list_all_user', formData).then(response =>{
            console.log(response);
            if(response.data.userData == true ){
                createAlert('success', `User ${idS[index].value} Reopened success fully!`, '');
                document.querySelectorAll('.reopen')[index].classList.add('disabled');
                document.querySelectorAll('.del')[index].classList.remove('disabled');

            }else{
                createAlert('warning', `Failed Removing User ${idS[index].value} `, '');
            }
        })
    }
}
}
