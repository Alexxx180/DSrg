function Mode(Table) {
document.getElementById(Table?"switcher-table":"switcher-form").style.display="grid";
document.getElementById(Table?"switcher-form":"switcher-table").style.display="none";
}
function ChangeLocation(location){
	window.location.replace(location);
}