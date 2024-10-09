const ticket = document.querySelector(".ticket");

let quantity = 0;

ticket.addEventListener("click", (Event) => {
  let target = Event.target;
  switch (target.className) {
    case "substract-quantity":
      substractQuanity();

      break;
    case "plus-quantity":
      plusQuanity();

      break;
    default:
      document.querySelector(".quantity-ticket").innerHTML = quantity;
  }
});

function substractQuanity() {
  if (quantity === 0) {
    return false;
  }

  quantity -= 1;
  document.querySelector(".quantity-ticket").innerHTML = quantity;

  return true;
}

function plusQuanity() {
  quantity += 1;
  document.querySelector(".quantity-ticket").innerHTML = quantity;

  return true;
}
