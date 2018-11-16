/**
     * Copyright 2018, This file is part of Framework ARL.
     * 
     * Framework ARL is free software: you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     * 
     * Framework ARL is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     * GNU General Public License for more details.
     * 
     * You should have received a copy of the GNU General Public License
     * along with Framework ARL.  If not, see <https://www.gnu.org/licenses/>.
     * 
     * FRAMEWORK ARL
     * @author sebRL
     * @version 1.0
     * https://github.com/sebRL
    */

/**
 * Création d'un message d'information
 * 
 * @param text String Contenu du message
 * @param type String La classe css du message
 *                      - danger
 *                      - info
 *                      - success
 *                      - warning
 * */
function arl_errorForm(text, type){
	var error = document.getElementsByClassName("error");
	
	Array.prototype.forEach.call(error, function(el) {
		var tempDiv = document.createElement("div");
		tempDiv.classList.add(type);
		tempDiv.classList.add("textCenter");
		tempDiv.appendChild(document.createTextNode(text));
		
		/*var btnClose = document.createElement("span");
		btnClose.appendChild(document.createTextNode("x"));
		btnClose.classList.add("close");
		tempDiv.appendChild(btnClose);
		
		btnClose.addEventListener("click", function(e){
			arl_closeError(e.target);
		}, false);*/
		
		el.appendChild(tempDiv);
	});
}

/**
 * Permet de fermet un message
 * @param e DOM Cible qui à veux être fermet
 * */
function arl_closeError(e){
	e.parentNode.classList.add("closed");
	setTimeout(function(){
		e.parentNode.remove();
	}, 500);
}

/**
 * Récupération de XMLHttpRequest (Pour les requettes ajax)
 * 
 * @return MIXED
 * */
function arl_getXMLHttpRequest() {
	var xhr = null;
				
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
				
	return xhr;
}
/**
 * Envoi d'un requet ajax post
 * 
 * @param url String cible
 * @param params String paramètre du poste format ID=VALEUR[&ID=VALEUR[...]]
 * @param callback Method appelé après récupération de la reponse ajax signature (function [NOM]([VARIABLE DE RECUPERATION]))
 * */
function arl_postAjax(url, params, callback){
	//AJAX
	var xhr = arl_getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if(xhr.responseText !== null){
				callback(xhr.responseText);
			}
		}
	};
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(params);
}
/**
 * Envoi d'un requet ajax get
 * 
 * @param url String cible
 * @param callback Method appelé après récupération de la reponse ajax signature (function [NOM]([VARIABLE DE RECUPERATION]))
 * */
function arl_getAjax(url, callback){
	//AJAX
	var xhr = arl_getXMLHttpRequest();
	var progressBar = document.getElementById("loadProgress");
	
	//CREATE
	xhr.open("GET", url);
	
	//EVENT
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if(xhr.responseText !== null || xhr.responseText.trim() !== ""){
				callback(xhr.responseText);
			}
		}
	};
	
	//SEND
	xhr.send(null);
}

/**
 * Récupération de l'url
 * 
 * @param data String donnée à rajouter à la fin de l'url
 * */
function arl_baseUrl(data){
    arl_baseUrl(data, false);
}
/**
 * Récupération de l'url
 * 
 * @param data String donnée à rajouter à la fin de l'url
 * @param index Booleam Si False "index.php" est retiré, True on garde
 * 
 * @return STRING
 * */
function arl_baseUrl(data, index){
    var more = index ? "index.php/" : "";
    return window.location.origin + window.location.pathname.split("index.php")[0] + more + data;
}

/**
 * 
 * Changemt de l'état du menu responsive
 * */
function openDrawerMenu(){
    var x = document.getElementById("mainNavBar");
    if (x.className === "navBar"){
        x.className += " responsive";
    } else {
        x.className = "navBar";
    }
}