function getById(vId){
	return document.getElementById(vId);
	}
function getByQry(sele){
	return document.querySelector(sele);
	}
function getByClass(vClass){
	return document.querySelector("." + vClass);
	}
function getInputVr(vId){
	return getByQry("INPUT[Id="+vId+"]");
	}