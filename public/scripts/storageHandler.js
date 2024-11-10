
function createRemainingAmountStorage() {
    if (localStorage.getItem("BASKET") === null) {
        showTest ? logThis("No basket detected", true) : null;
        localStorage.setItem("BASKET", JSON.stringify([]));
    }
        if (localStorage.getItem("REMAINING") !== null) return;

    showTest ? logThis("No inventory detected", true) : null;

    getProductJson()
        .then(datas => {
            writeStorage(datas);
        })
        .catch(error => {
            console.error("Error fetching data:", error);
        });

    function writeStorage(datas) {
    const storageArray = [];
    let artData;
        datas.forEach((item) => {
            artData = {
                id: item["prod_id"],
                total: item["prod_amount"]
            }
        storageArray.push(artData);
        })
    localStorage.setItem("REMAINING", JSON.stringify(storageArray));
    showTest ? logThis("Inventory Created : "+localStorage.getItem("REMAINING")) : null;
    }
}

createRemainingAmountStorage();
