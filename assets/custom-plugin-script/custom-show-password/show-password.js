function passw() {
	var x = document.getElementById("input");
	if (x.type === "password") {
		document.getElementById("text").style.display = "none"; 
		document.getElementById("password").style.display = "block"; 
		x.type = "text";
		} else {
		document.getElementById("text").style.display = "block"; 
		document.getElementById("password").style.display = "none"; 
		x.type = "password";
	}
}