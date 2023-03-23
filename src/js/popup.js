let MaincontainerPopup;
// const Popup = document.querySelector('.popup');
const closeBtn = document.querySelector('.close-btn');



   // Popup.style.display = 'none';
   // if(containerPopup !== null){
   //    containerPopup.addEventListener('click', function(event) {
   //       if (event.target === this) {
   //          containerPopup.style.display = 'none';
   //       }
   //    });
   // }

   closeBtn.addEventListener('click', function() {
      // Popup.style.display = 'none';
   });
   function showPopup(){
      MaincontainerPopup = document.querySelector('.container-popup');

       MaincontainerPopup.style.display = 'block';
         // Popup.style.display = 'block';
   }
   function hidePopup(container){
      console.log(MaincontainerPopup);
      // if(containerPopup != null || containerPopup != undefined){
         
      MaincontainerPopup.style.display = 'none';
         // Popup.style.display = 'none';
      // }
   }




