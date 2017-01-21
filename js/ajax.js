window.onload = init;
var interval;
function init()
{
	interval = setInterval(trackLogin,1000);
}
function trackLogin()
{
	var xmlReq = false;
	try {
	xmlReq = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
	try {
	xmlReq = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (e2) {
	xmlReq = false;
	}
	}
	if (!xmlReq && typeof XMLHttpRequest != 'undefined') {
	xmlReq = new XMLHttpRequest();
	}

	xmlReq.open('get', '../include/check.php', true);
	xmlReq.setRequestHeader("Connection", "close");
	xmlReq.send(null);
	xmlReq.onreadystatechange = function(){
		if(xmlReq.readyState == 4 && xmlReq.status==200) {
			if(xmlReq.responseText == 1)
			{
				clearInterval(interval);
				alert('You have been logged out.You will now be redirected to Log In Page.');
				document.location.href = "../index.php";
			}
		}
	}
}
