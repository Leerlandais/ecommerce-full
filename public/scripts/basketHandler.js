
const checkoutBasketSize = document.getElementById("checkoutBasketSize");
const remainingAmountDisplay = document.querySelectorAll(".remainingAmountDisplay");

let currentBasket = JSON.parse(localStorage.getItem("BASKET") || "[]");

checkoutBasketSize.textContent = currentBasket.length;
