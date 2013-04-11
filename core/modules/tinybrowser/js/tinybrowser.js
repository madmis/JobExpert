rowHighlight = function() {
	var x = document.getElementsByTagName('tr');
	for (var i=0;i<x.length;i++) {
		x[i].onmouseover = function () { this.className = "over " + this.className; }
		x[i].onmouseout = function () { this.className = this.className.replace("over", ""); this.className = this.className.replace(" ", ""); }
	}
	var y = document.getElementsByTagName('th');
	for (var j=0;j<y.length;j++) {
		y[j].onmouseover = function () {if(this.className != "nohvr") this.className = "over " + this.className;}
		y[j].onmouseout = function () {this.className = this.className.replace("over", ""); this.className = this.className.replace(" ", "");}
	}
}