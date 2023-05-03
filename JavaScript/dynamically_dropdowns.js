const cities = {
    "Bucuresti": ["010xxx", "020xxx", "030xxx"],
    "Cluj-Napoca": ["400xxx", "401xxx", "402xxx"],
    "Timisoara": ["300xxx", "301xxx", "302xxx"],
    "Iasi": ["700xxx", "701xxx", "702xxx"],
    "Constanta": ["900xxx", "901xxx", "902xxx"],
    "Craiova": ["200xxx", "201xxx", "202xxx"],
    "Brasov": ["500xxx", "501xxx", "502xxx"],
    "Galati": ["800xxx", "801xxx", "802xxx"],
    "Ploiesti": ["100xxx", "101xxx", "102xxx"],
    "Oradea": ["410xxx", "411xxx", "412xxx"]
};

const cityDropdown = document.getElementById("city-dropdown");
const postalCodeDropdown = document.getElementById("postal-code-dropdown");


cityDropdown.addEventListener("click", function (){
    const selectedCity=this.value;
    const postalCodes=cities[selectedCity];
    postalCodeDropdown.innerHTML="";

    postalCodes.forEach(function(postalCode) {
        const option = document.createElement("option");
        option.value = postalCode;
        option.text = postalCode;
        postalCodeDropdown.appendChild(option);
    });
})
