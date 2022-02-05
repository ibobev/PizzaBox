function openSlideMenu(){
	document.getElementById('side_menu').style.width='250px';
	
}

function closeSlideMenu(){
	document.getElementById('side_menu').style.width='0px';
	
}

let pizzaMenu = document.getElementById('display_pizza');
let pastaMenu = document.getElementById('display_pasta');
let beverageMenu = document.getElementById('display_beverage');

let btnPizza = document.getElementById('btn_pizza');
let btnPasta = document.getElementById('btn_pasta');
let btnBeverage = document.getElementById('btn_beverage');

function displayPizza(){
	btnPizza.style.backgroundColor="#e0a853";
    btnPasta.style.backgroundColor="";
    btnBeverage.style.backgroundColor="";
    pizzaMenu.style.display="flex";
    pastaMenu.style.display="none";
    beverageMenu.style.display="none";
}

function displayPasta(){
	btnPizza.style.backgroundColor="";
    btnPasta.style.backgroundColor="#e0a853";
    btnBeverage.style.backgroundColor="";
    pizzaMenu.style.display="none";
    pastaMenu.style.display="flex";
	pastaMenu.style.flexWrap="wrap";
	pastaMenu.style.justifyContent="space-between";
	pastaMenu.style.justifyContent="space-around";
	pastaMenu.style.justifyContent="space-evenly";
    beverageMenu.style.display="none";
}

function displayBeverage(){
	btnPizza.style.backgroundColor="";
    btnPasta.style.backgroundColor="";
    btnBeverage.style.backgroundColor="#e0a853";
    pizzaMenu.style.display="none";
    pastaMenu.style.display="none";
	beverageMenu.style.display="flex";
	beverageMenu.style.flexWrap="wrap";
	beverageMenu.style.justifyContent="space-between";
	beverageMenu.style.justifyContent="space-around";
	beverageMenu.style.justifyContent="space-evenly";
    
}
