
function showOrderPage(event, btn) {
  document.body.style.backgroundColor = "white";
  event.preventDefault();
  let formData = new FormData();
  formData.append("order_page_process", "get_order_page");

  axios.post("/api/order_page", formData).then((Response) => {
    console.log(Response.data.orderData);
    renderOrderTable(Response.data.html);
    rederRows(Response.data.orderData);
  });
}
function renderOrderTable(html) {
  const contentParent = document.getElementById("content").parentElement;

  // Create a temporary div element and set its innerHTML to the response HTML
  const tempDiv = document.createElement("div");
  tempDiv.innerHTML = html;

  // Get the new content element from the temporary div
  const newContent = tempDiv.firstChild;

  // Replace the existing content with the new content
  const contentElement = document.getElementById("content");
  contentElement.innerHTML = "";
  contentElement.appendChild(newContent);

  // console.log(response.data.data);

  // createDataTable(data, currentIndex, records);

  // console.log('here');
}
function rederRows(data) {
  let table = document.querySelector(".tableBody");
  data.forEach((element, index) => {
    table.innerHTML += `
        <tr>
						<td>${index + 1}</td>
						<td>${element.OrderId}</td>
						<td >${element.ProductTitle}</td>
						<td >${element.Quantity}</td>
						<td > <i class="fa fa-inr" aria-hidden="true"></i>
                        ${element.TotalPrice}</td>
                        <td >${element.PlacedOn}</td>
                        <td class="status">${element.OrderStatus}</td>
                        <td>
                        ${
                          element.OrderStatus == "Cancelled"
                        ? `<form action='manage_cart.php' method='post'>
								<button name='Remove_Item' class='btn btn-sm btn-outline-danger disabled' onClick='cancelOrder(event, this, ${index})'style="position:unset" ><i
										class='fa-solid fa-trash'></i></button>
								<input type='hidden' name='OrderId' class='OrderId' value='${element.OrderId}'>
							</form>
`
                            : `<form action='manage_cart.php' method='post'>
                                    <button name='Remove_Item' class='btn btn-sm btn-outline-danger' onClick='cancelOrder(event, this, ${index})' style="position:unset"><i
                                            class='fa-solid fa-trash'></i></button>
                                    <input type='hidden' name='OrderId' class='OrderId' value='${element.OrderId}'>
                                </form>`
                        }

						</td>
					</tr>
        `;
  });
}
function cancelOrder(event, btn, index) {
  event.preventDefault();
  let formData = new FormData();

  formData.append("order_page_process", "cancel_order");

  formData.append(
    "OrderId",
    document.querySelectorAll(".OrderId")[index].value
  );
  axios.post("/api/order_page", formData).then((Response) => {
    console.log(Response);

    if (Response.data.text == "canelled") {
      createAlert("success", "Order cancelled!", "");
      document.querySelectorAll(".status")[index].textContent = "Cancelled";
      btn.disabled = true;
    }
  });
}

function filterProducts(event, btn){

}
