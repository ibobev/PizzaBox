//Change bg-color on scroll
const header=document.getElementById('header');
window.onscroll=function(){
	let top = window.scrollY;
	if(top>=50){
		header.classList.add('active');
	}else{
		header.classList.remove('active');
	}
}

function openSlideMenu(){
	document.getElementById('side_menu').style.width='250px';
	
}

function closeSlideMenu(){
	document.getElementById('side_menu').style.width='0px';
	
}
