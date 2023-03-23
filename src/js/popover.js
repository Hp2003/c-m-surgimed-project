const input = document.querySelector(".input-container");
const popover = document.querySelector(".popover-content");

input.addEventListener("focus", () => {
  popover.style.display = "block";
});

input.addEventListener("blur", () => {
  popover.style.display = "none";
});
function showPopover(pop, text){
   pop.style.display = "block";
  //  document.querySelector('.popover-content').textContent = text/;
}
function hidePopover(pop){
   pop.style.display = 'none';
}