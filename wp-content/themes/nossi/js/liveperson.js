// @author Joshua Estes <joshua.estes@iostudio.com>
// @author Jarvis Stubblefield <jarvis.stubblefield@iostudio.com>
// @doc http://community.liveperson.com/docs/DOC-1045
// @doc http://community.liveperson.com/docs/DOC-1039

var lpc;
var lpcAgentName;
var lpcSessionKey;
var lpChatConfig = {
    apiKey : 'da0c04290551481bbf8427194362efb9',
    lpServer : 'dev.liveperson.net',
    lpNumber : 'P77635751',
    onLoad : lpcOnLoad,
    onInit : lpcOnInit,
    onStart : lpcOnStart,
    onStop : lpcOnStop,
    onState : lpcOnState,
    onAgentTyping : lpcOnAgentTyping,
    onUrlPush : lpcOnUrlPush,
    onLine : lpcOnLine,
    onError : lpcOnError,
    onAvailability : lpcOnAvailability,
    onResume : lpcOnResume,
    onAccountToAccountTransfer : lpcOnAccountToAccountTransfer
};
function lpcOnLoad() {
  //console.log('lpcOnLoad');
  lpc = new lpChat();
  // Should we clear the textarea here? -JS
}
function lpcOnInit() {
  //console.log('lpcOnInit');
}
function lpcOnStart(agentId, agentName) {
  //console.log('lpcOnStart');
  //console.log(agentId, agentName);
  lpcAgentName = agentName;
  if (!lpcSessionKey) {
    setCookie("lpcSessionCookie", lpc.getSessionKey(), 1);
    lpcSessionKey = getCookie("lpcSessionCookie");
  }
  else {
    console.log('resuming session', lpcSessionKey);
    lpc.resumeChat(lpcSessionKey);
  }
}
function lpcOnStop(reasonId, reasonText) {
  //console.log('lpcOnStop');
  //console.log(reasonId, reasonText);
  // Clear variables that we setup. -JS
  lpcAgentName = null;
  lpcSessionKey = null;
}
function lpcOnState(stateObj) {
  //console.log('lpcOnState');
  //console.log(stateObj);
  // The below isn't needed as LP sends back
  // from the server that you are waiting on
  // a representative.
  if (stateObj.id == 4) {
    //addChatText('NOSSI', stateObj.text + '.');
  }
}
function lpcOnAgentTyping(isTyping) {
  //console.log('lpcOnAgentTyping');
  //console.log(isTyping);
  if (isTyping) {
    setAgentTyping();
  }
}
function lpcOnUrlPush(url) {
  //console.log('lpcOnUrlPush');
  //console.log(url);
}
function lpcOnLine(lineObj) {
  //console.log('lpcOnline');
  //console.log(lineObj);
  if (lineObj.type == 4) {
    lineObj.text = jQuery(lineObj.text).filter('span').text();
  }
  addChatText(lineObj.by, lineObj.text);
}
function lpcOnError(errorObj) {
  //console.log('lpcOnError');
  //console.log(errorObj);
  if (errorObj.id == 3) {
    addChatText('NOSSI', 'No agents available. Please try again later.');
  }
  else {
    alert(errorObj.text);
  }
}
function lpcOnAvailability(availObj) {
  //console.log('lpcOnAvailability');
  //console.log(availObj);
  if (availObj.availability) {
    lpc.requestChat();
  }
  else {
    addChatText('NOSSI', 'No agents available. Please try again later.');
  }
}
function lpcOnResume(agentId, agentName) {
  //console.log('lpcOnResume');
  //console.log(agentId, agentName);
  lpcAgentName = agentName;
  lpcSessionKey = lpc.getSessionKey();
}
function lpcOnAccountToAccountTransfer(a2aInfo) {
  //console.log('lpcOnAccountToAccountTransfer');
  //console.log(a2aInfo);
}
function setAgentTyping() {
  //This just covers if it's not set through onStart or onResume.
  if (!lpcAgentName) {
    lpcAgentName = lpc.getAgentName();
  }
  jQuery('#lpcTyping').text(lpcAgentName + ' is typing...');
}
function sendText() {
    var textObj = document.getElementById('lpChatLine');
    if(textObj.value!=''){
        lpc.addLine(textObj.value);
        addChatText(lpc.getVisitorName(), textObj.value);
        textObj.value='';
    }
    return true;
}
function addChatText(by,text){
    //console.log('addChatText');
    //console.log(by);
    //console.log(text);
    var content = jQuery('#lpcChatTArea').val();
    var newline = by + ": " + text;
    var newContent = content + "\n" + newline;
    jQuery('#lpcChatTArea').html(newContent);
    //Better way maybe? For now its just a big number
    jQuery('#lpcChatTArea').scrollTop(1000000000);
}
lpChatConfig.lpAddScript = function(src, ignore) {
    var c = lpChatConfig;
    if(typeof(c.lpProtocol)=='undefined'){
        c.lpProtocol = (document.location.toString().indexOf("https:")==0) ? "https" : "http";
    }
    if (typeof(src) == 'undefined' || typeof(src) == 'object') {
        src = c.lpChatSrc ? c.lpChatSrc : '/hcp/html/lpChatAPI.js';
    };

    if (src.indexOf('http') != 0) {
        src = c.lpProtocol + "://" + c.lpServer + src + '?site=' + c.lpNumber;
    } else {
        if (src.indexOf('site=') < 0) {
            if (src.indexOf('?') < 0)src = src + '?'; else src = src + '&';
            src = src + 'site=' + c.lpNumber;
        }
    };

  var s = document.createElement('script');
    s.setAttribute('type', 'text/javascript');
    s.setAttribute('charset', 'iso-8859-1');
    s.setAttribute('src', src);
    document.getElementsByTagName('head').item(0).appendChild(s);
}
if (window.attachEvent) window.attachEvent('onload', lpChatConfig.lpAddScript);
else window.addEventListener('load', lpChatConfig.lpAddScript, false);

function getCookie(c_name) {
  var i,x,y,ARRcookies=document.cookie.split(";");
  for (i=0;i<ARRcookies.length;i++) {
    x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
    y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
    x=x.replace(/^\s+|\s+$/g,"");

    if (x==c_name) {
      return unescape(y);
    }
  }
}

function setCookie(c_name,value,exdays) {
  var exdate=new Date();
  exdate.setDate(exdate.getDate() + exdays);
  var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
  document.cookie=c_name + "=" + c_value;
}

