const prodAmount = document.querySelector("#prodAmount");
prodAmount.addEventListener("change", verifyProdAmount);
prodAmount.addEventListener("keyup", verifyProdAmount);
prodAmount.addEventListener("blur", function(e){ e.preventDefault(); });

function verifyProdAmount(e){
    const value = e.target.value;
    const prodAmount = getProdAmount();
    console.log(prodAmount);

    if(parseInt(value) > parseInt(prodAmount)){
        alert("No puedes elegir una cantidad mayor a la cantidad de unidades disponibles");
    }
}

function getProdAmount(){
    const prodAmount = "<?php echo $product['existenciaprod'] ?>";
    return prodAmount;
}