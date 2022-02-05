//Display account forms update on click
let myData = document.getElementById('my_data');
let accForm = document.getElementById('acc_details');
let pwdForm = document.getElementById('acc_pass');
let adrForm = document.getElementById('acc_address');

let btnAcc = document.getElementById('btn_acc_info');
let btnPwd = document.getElementById('btn_pass');
let btnAdr = document.getElementById('btn_address');
let btnMyData = document.getElementById('btn_my_data');

function displayMyData(){
    btnAcc.style.backgroundColor="";
    btnPwd.style.backgroundColor="";
    btnAdr.style.backgroundColor="";
    btnMyData.style.backgroundColor="#da9938";
    accForm.style.display="none";
    adrForm.style.display="none";
    pwdForm.style.display="none";
    myData.style.display="block";
    window.location.href = "http://localhost/PizzaBox/customers/account";;
}

function displayDetailsForm(){
    btnAcc.style.backgroundColor="#da9938";
    btnPwd.style.backgroundColor="";
    btnAdr.style.backgroundColor="";
    btnMyData.style.backgroundColor="";
    accForm.style.display="block";
    adrForm.style.display="none";
    pwdForm.style.display="none";
    myData.style.display="none";
}

function displayPasswordForm(){
    btnPwd.style.backgroundColor="#da9938";
    btnAcc.style.backgroundColor="";
    btnAdr.style.backgroundColor="";
    btnMyData.style.backgroundColor="";
    accForm.style.display="none";
    adrForm.style.display="none";
    pwdForm.style.display="block";
    myData.style.display="none";
}

function displayAddressForm(){
    btnAdr.style.backgroundColor="#da9938";
    btnAcc.style.backgroundColor="";
    btnPwd.style.backgroundColor="";
    btnMyData.style.backgroundColor="";
    accForm.style.display="none";
    pwdForm.style.display="none";
    adrForm.style.display="block";
    myData.style.display="none";
}

function openSlideMenu(){
	document.getElementById('side_menu').style.width='250px';
	
}

function closeSlideMenu(){
	document.getElementById('side_menu').style.width='0px';
	
}


