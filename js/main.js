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

function menuStripe(elem) {
  elem.style.paddingBottom = '25px';
  var elemWidth = elem.offsetWidth;
  var elemLeft = elem.offsetLeft;
  var bColor = window.getComputedStyle(elem).backgroundColor;
  var stripe = document.getElementById('menu-stripe');  
  stripe.style.backgroundColor = bColor;
  stripe.style.opacity = 0.65;
  stripe.style.width = (elemWidth - 10) + "px"; 
  stripe.style.left = (elemLeft + 5) + "px";
  stripe.style.height = document.documentElement.clientHeight + "px";
  stripe.style.boxShadow = "0px, 2px, 10px " + bColor; // TODO: this is not working for some reason
  stripe.style.display = 'block';
  var some = 0;
}

function menuUnstripe(elem) {
  elem.style.padding='15px';
  var stripe = document.getElementById('menu-stripe');
  stripe.style.left = '0px';
  stripe.style.background = 'gray';
  stripe.style.height = '0px';
  stripe.style.display = 'none';
}

//================= class work ==============================================

function handleActorDropdown(dropdown) {
  //alert("dropdown list changed to id " + dropdown.value);
  $.get("get_movies.php", {actorId: dropdown.value}, handleResult(data))

  var xmlRequest = new XMLHttpRequest();
  xmlRequest.onreadystatechange() = function() {
    if (xmlRequest.readyState == 4 && xmlRequest.status == 200) {
      handleResult(xmlRequest.responseText);
    }
  };

  xmlRequest.open("GET", "get_movies.php?actorId =" + dropdown.value, true);
  xmlRequest.send();
}

function handleResult(result) {
  alert("Got this back: "+result);
}