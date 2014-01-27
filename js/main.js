window.onload = radialFormat("onload");

function radialFormat(txt) {
	var homeWrapper = document.getElementById("home-wrapper");
  var bodyImg = document.getElementById("body-img");
  var horizDiv = document.getElementById("horiz-divider");
	var hwStyle = window.getComputedStyle(homeWrapper);
  var biStyle = window.getComputedStyle(bodyImg);
	var hwWidth = parseFloat(hwStyle.width);
	var hwHeight = hwWidth;
	homeWrapper.style.borderRadius = hwWidth/2 + "px";
	homeWrapper.style.height = hwHeight + "px";
  bodyImg.style.left = (hwWidth - parseFloat(biStyle.width))/2 + "px";
  horizDiv.style.top = hwHeight/2 + horizDiv.style.height/2 + "px";
  horizDiv.style.width = hwWidth + "px";
	var radialDivs = document.getElementsByClassName("radial-div");
	
  for (var i=0;i<radialDivs.length;i++) {
		radialDivs[i].style.width = hwWidth/2 + "px";
	}
	radialDivs[0].style.left = hwWidth/2 + "px";
	radialDivs[1].style.left = hwWidth/2 + "px";
	radialDivs[2].style.left = hwWidth/2-parseFloat(radialDivs[2].style.width) + "px";
	radialDivs[3].style.left = hwWidth/2-parseFloat(radialDivs[3].style.width) + "px";
	radialDivs[0].style.top = hwHeight/3 + "px";
	radialDivs[1].style.top = (hwHeight/3)*2 - 70 + "px";
	// TODO: need to calculate the top style with a formula based on the angle of rotation
	radialDivs[2].style.top = hwHeight/3  + "px";
	radialDivs[3].style.top = (hwHeight/3)*2 - 70 + "px";
	// radialDivs[0].style.transform = rotate(20deg);
	// radialDivs[1].style.transform = rotate(-20deg);
	// radialDivs[2].style.transform = rotate(20deg);
	// radialDivs[3].style.transform = rotate(20deg);
  console.log("finished format from: " + txt);

  var homeQtrs = document.getElementsByClassName("home-qtr");
  for (var i=0;i<homeQtrs.length;i++) {
    homeQtrs[i].style.width = hwWidth/2 + "px";
    homeQtrs[i].style.height = hwHeight/2 + "px";
  }
  homeQtrs[1].style.left = hwWidth/2 + "px";
  homeQtrs[3].style.left = hwWidth/2 + "px";
  homeQtrs[2].style.top = hwHeight/2 + "px";
  homeQtrs[3].style.top = hwHeight/2 + "px";
  var homeAngls = document.getElementsByClassName("home-angle");
  for (var i=0;i<homeAngls.length;i++) {
    homeAngls[i].style.width = hwWidth/2 + "px";
    homeAngls[i].style.height = hwHeight/2 + "px";
    homeAngls[i].style.left = hwHeight/2 - parseFloat(homeAngls[i].width)/2 + "px";
  }
  homeAngls[0].style.top = hwHeight/2*-0.45 + "px";
  homeAngls[1].style.top = hwHeight/2*.45 + parseFloat(homeAngls[1].style.height) + "px";
}