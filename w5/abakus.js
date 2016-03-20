window.onload = function() {
	// lehe laadimine lõpetatud. Siia funktsiooni sisse kirjutan elementide mõjutamise käsud
	var beads = document.getElementsByClassName('bead');
	for (var i = 0; i < beads.length; i++) {
		beads[i].onclick = function(a) {
			if (this.getAttribute('style') == null || this.getAttribute('style') == "") {
				this.style.cssFloat = "right";
			}
			else {
				if (this.style.cssFloat == "left") {
					this.style.cssFloat = "right";
				}
				else {
					this.style.cssFloat = "left";
				}
			}
			
		};
	};
	

};