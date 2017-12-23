/*
*
* BELOW IS PARTICLE PHOTON FUNCTIONALITY
*
*/




var particle = new Particle();
var token;

var login = '';
var password = '';
var deviceId = '';  // Comes from the number in the particle.io Console

// Call back function for login success/failure
function loginSuccess(data) {
    console.log('API call completed on promise resolve: ', data.body.access_token);
    token = data.body.access_token;
}
function loginError(error) {
    console.log('API call completed on promise fail: ', error);
}
// Try to login
particle.login({username: login, password:password}).then(loginSuccess, loginError);
function callSuccess(data) {
    console.log('Function called succesfully:', data);
}
function callFailure(error) {
    console.log('An error occurred:', error);
}



function feed(){
  particle.callFunction({deviceId: deviceId, name: 'feed', argument: 'dump', auth: token}).then(callSuccess, callFailure);
}

function treat(){
  particle.callFunction({deviceId: deviceId, name: 'treat', argument: 'dump', auth: token}).then(callSuccess, callFailure);
}


document.getElementById("feedButton").addEventListener('click', feed);
document.getElementById("treatButton").addEventListener('click', treat);
