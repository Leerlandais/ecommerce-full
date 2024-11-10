function getProductJson() {
    fetch("../../Controllers/getProducts.php")
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(function(datas) {
            handleJsonData(datas);
        })
        .catch(error => console.error('Error fetching data:', error));
}

getProductJson();

function handleJsonData(datas) {
    console.log("OK : "+JSON.stringify(datas));
}