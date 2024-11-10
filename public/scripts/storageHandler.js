
function createRemainingAmountStorage() {
    const remainingDisplay = document.querySelectorAll(".remainingDisplay");
    showTest ? logThis("Creating for "+remainingDisplay.length+" items...") : null;
    const storage = [];
    for (let i = 0; i < remainingDisplay.length; i++) {
       let remaining = remainingDisplay[i].textContent;
       let id = remainingDisplay[i].id;
       let data = {
           id: id,
           remaining: remaining
       }
       storage.push(data);
       localStorage.setItem("REMAINING", JSON.stringify(storage));
    }

    showTest ? logThis("Remaining Inventory Created : "+localStorage.getItem("REMAINING")) : null;
}

if (localStorage.getItem("REMAINING") === null) {
    createRemainingAmountStorage();
}