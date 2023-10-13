const search=() =>{
    const searchbox=document.getElementByID("search-item").value.toUpperCase();
    const storeitems = document.getElementByID("product-list");
    const product = document.querySelectorAll(".Manufacturer")||
        document.querySelectorAll(".Person") ||
        document.querySelectorAll(".Planet")||
        document.querySelectorAll(".Starships") ||
        document.querySelectorAll(".Vehicle");
    const pname = document.getElementsByTagName("$name");

    for(var i=0; i < pname.length;i++){
        let match = product[i].getElementsByTagName('h2')[0];

        if(match){
            let textvalue= match.textContent || match.innerHTML

            if(textvalue.toUpperCase().indexOf(searchbox) > -1){
                product[i].style.display="";
            }
            else{
                product[i].style.display="none";
            }
        }
    }
}