'use strict';

ajaxRequest ('GET', 'php/request.php/user/', displayUser);

function displayUser(ajaxResponse){
    var data = JSON.parse(ajaxResponse);
    var content = '';

    for(var i = 0; i < data.length; ++i) {
        var user = data[i];

        content += user.mail;
    }

    document.getElementById('user').innerHTML = content; 
}
