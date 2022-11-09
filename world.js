window.onload = function(){
   
    let lookUp = document.getElementById("lookup");
    let resultDiv = document.getElementById("result");
    let lookUpCities = document.getElementById("lookup-cities");
    

    lookUp.addEventListener("click", () => {
        let country = document.getElementById("country").value;
        
        fetch("world.php?country=" + String(country))
            .then((response)=>{
                if(response.ok){
                    return response.text();
                }else{
                    return Promise.reject("An error has occured");
                }
            })
            .then((data)=>{
                resultDiv.innerHTML = data;
            })
            .catch((error)=>{
                console.log("Sorry an error has occured: " + error);
            })

    });


    lookUpCities.addEventListener("click", () => {
        let country = document.getElementById("country").value;

        fetch("world.php?country=" + String(country) + "&lookup=cities")
            .then((response)=>{
                if(response.ok){
                    return response.text();
                }else{
                    return Promise.reject("An error has occured");
                }
            })
            .then((data)=>{
                resultDiv.innerHTML = data;
            })
            .catch((error)=>{
                console.log("Sorry an error has occured: " + error);
            })

    });
};