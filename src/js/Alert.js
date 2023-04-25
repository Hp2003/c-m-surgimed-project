// let alertElement = document.querySelector('.alert');
// alertElement.style.zIndex = 999;
// alertElement.style.position = 'absolute';
// alertElement.style.width = '100%';
function closeAlert(element){
  element.remove();
}


function createAlert(alertType, heading, message, duration = 5000){
  const alertDiv = document.createElement('div');
  alertDiv.classList.add('alert', `alert-${alertType}`, 'alert-dismissible', 'fade', 'show');
  alertDiv.setAttribute('data-bs-delay', `${duration}`);
  alertDiv.style.position = 'fixed';
  alertDiv.style.zIndex = '1000000000000000000';
  alertDiv.style.top = 0;
  alertDiv.style.left = 0;
  alertDiv.style.height = '60px';
  alertDiv.style.width = '100%';
  alertDiv.style.top = 0;
  alertDiv.innerHTML = `
    <strong ">${heading}</strong> ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  `;
  setTimeout(() => {
    closeAlert(alertDiv)
  }, duration);
  document.body.appendChild(alertDiv);
}

// Alert box
// Get the overlay and alert box elements
// const overlay = document.getElementById('overlay');
// const alertBox = document.getElementById('alert-box');

// // Get the message and button elements
// const message = document.getElementById('message');
// const okButton = document.getElementById('ok-button');
// const cancelButton = document.getElementById('cancel-button');

// Function to show the alert box
// function showAlertBox(messageText, okCallback, cancelCallback) {
//   // Set the message text
//   message.textContent = messageText;

//   // Show the overlay and alert box
//   overlay.style.display = 'block';
//   alertBox.style.display = 'block';

//   // Disable all other clicks on the screen
//   document.body.style.pointerEvents = 'none';

//   // Add event listeners to the buttons
//   okButton.addEventListener('click', function() {
//     hideAlertBox();
//     if (okCallback) {
//       okCallback();
//     }
//   });
//   cancelButton.addEventListener('click', function() {
//     hideAlertBox();
//     if (cancelCallback) {
//       cancelCallback();
//     }
//   });
// }

// Function to hide the alert box
// function hideAlertBox() {
//   // Hide the overlay and alert box
//   overlay.style.display = 'none';
//   alertBox.style.display = 'none';

//   // Enable clicks on the screen
//   document.body.style.pointerEvents = 'auto';

//   // Remove event listeners from the buttons
//   okButton.removeEventListener('click', function() {});
//   cancelButton.removeEventListener('click', function() {});
// }

// Example usage
// const centerButton = document.getElementById('center-button');
// centerButton.addEventListener('click', function() {
//   showAlertBox('Are you sure you want to continue?', function() {
//     // OK button clicked
//     console.log('OK button clicked');
//   }, function() {
//     // Cancel button clicked
//     console.log('Cancel button clicked');
//   });
// });
