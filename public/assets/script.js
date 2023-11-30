function testpasswords(create = false) {
    event.preventDefault();
    if (!document.getElementById('user-form').checkValidity())
    {
        document.getElementById('user-form').reportValidity();
        return false;
    }
        if (document.getElementById('password').value !=
            document.getElementById('password-confirm').value) {
            document.getElementById('password-error').classList.remove('d-none');
        } else {
            document.getElementById('password-error').classList.add('d-none');
            let formData = new FormData(document.getElementById('user-form'));

            fetch('ajax.php', {
                body: formData,
                method: "post"
            }).then(
                function (response) {
                    response.json().then(function (data) {
                        if (data['status'] == 'error') {
                            document.getElementById('alert-error').classList.remove('d-none');
                            document.getElementById('alert-success').classList.add('d-none');
                            document.getElementById('alert-error').innerHTML = data['msg'];
                        }
                        else {
                            document.getElementById('alert-error').classList.add('d-none');
                            document.getElementById('alert-success').classList.remove('d-none');
                            document.getElementById('alert-success').innerHTML = data['msg'];
                            if (create) window.location.replace("edit.php");
                        }
                    });
                }
            )
        }
    
}

function logout() {
    event.preventDefault();
    let data = new FormData()
    data.append('method', 'logout')

    fetch('ajax.php', {
        body: data,
        method: "post"
    }).then(
        function (response) {
            response.json().then(function (data) {
                window.location.replace("index.php");
            });
        }
    )


}