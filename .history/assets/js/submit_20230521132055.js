var btn = document.addEventListener('click', function() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var message = document.getElementById('message').value;
    var subject = document.getElementById('subject').value;
    var data = {
        name: name,
        email: email,
        message: message,
        subject: subject
    };
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost:3000/send', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(data));
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var result = JSON.parse(xhr.responseText);
            console.log(result);
        }
    };
}
);