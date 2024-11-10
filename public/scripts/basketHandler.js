
const checkoutBasketSize = document.getElementById("checkoutBasketSize");
let currentBasket = JSON.parse(localStorage.getItem("BASKET") || "[]");

checkoutBasketSize.textContent = currentBasket.length;

checkoutBasketSize.textContent = currentBasket.length;