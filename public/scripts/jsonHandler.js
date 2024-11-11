async function getProductsJsons() {
    try {
        const response = await fetch("../../Controllers/getProducts.php");
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const datas = await response.json();
        return datas; // Return the data as a resolved Promise
    } catch (error) {
        console.error('Error fetching data:', error);
        throw error; // Re-throw to handle errors in calling code if needed
    }
}




function handleJsonData(datas) {
    showTest ? logThis("Json data received"+ JSON.stringify(datas)) : null;
    showTest ? logThis("Preparing Remaining Items", true) : null;


}