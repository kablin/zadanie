function testpasswords() {
    event.preventDefault();
    if (document.getElementById('password').value !=
        document.getElementById('password-confirm').value) {
        document.getElementById('password-error').classList.remove('d-none');
    } else {
        document.getElementById('password-error').classList.add('d-none');
        document.getElementById('register-form').submit();

    }
}