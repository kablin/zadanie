function submitForm(create = false) {
    event.preventDefault();
    if (!document.getElementById('user-form').checkValidity()) {
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


function login() {
    event.preventDefault();
    if (!document.getElementById('user-form').checkValidity()) {
        document.getElementById('user-form').reportValidity();
        return false;
    }
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
                else window.location.replace("edit.php");
            });
        }
    )
}



function saveAvatar() {

    var input = document.getElementById('avatar')

    var data = new FormData()
    data.append('file', input.files[0])
    data.append('method', 'saveAvatar')
    data.append('id', document.getElementById('id').value)

    fetch('ajax.php', {
        method: 'POST',
        body: data
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
                    document.getElementById('image').classList.remove('d-none');
                    document.getElementById('image').src = 'files/'+data['src'];
                }
            });
        }
    )
}


function deleteAvatar() {

    var data = new FormData()
    data.append('method', 'deleteAvatar')
    data.append('id', document.getElementById('id').value)

    fetch('ajax.php', {
        method: 'POST',
        body: data
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
                    document.getElementById('image').classList.add('d-none');
                }
            });
        }
    )
}






function deleteUser() {
    if (document.getElementById('confirm-delete').checked) {
        let data = new FormData()
        data.append('method', 'delete')
        data.append('id', document.getElementById('id').value)

        fetch('ajax.php', {
            body: data,
            method: "post"
        }).then(
            function (response) {
                response.json().then(function (data) {
                    if (data['status'] == 'error') {
                        document.getElementById('alert-error').classList.remove('d-none');
                        document.getElementById('alert-success').classList.add('d-none');
                        document.getElementById('alert-error').innerHTML = data['msg'];
                    }
                    else
                        window.location.replace("index.php");
                });
            }
        )
    }
    else if (document.getElementById('confirm').classList.contains('d-none')) {
        document.getElementById('confirm').classList.remove('d-none');
        document.getElementById('button-delete').classList.remove('ms-auto');
        document.getElementById('button-delete').classList.add('ms-4');

    }



}