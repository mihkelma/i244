window.onload = function() {
	// lehe laadimine lõpetatud. Siia funktsiooni sisse kirjutan elementide mõjutamise käsud
	var beads = document.getElementsByClassName('bead');
	console.log(beads);

	for (var i = beads.length - 1; i >= 0; i--) {
		var vaartus = beads[i].style.cssFloat;
		beads[i].style.backgroundColor = "red";
		console.log(i, vaartus);
	};


};