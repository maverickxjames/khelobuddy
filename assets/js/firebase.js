window.onload = function () {
    render()
    console.log(firebase)
}

function render() {
    // const recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-verifier')
    // recaptchaVerifier.render()
}

function phoneAuth() {
    var phone_number = document.querySelector("#mobile_no").value
    alert(phone_number)
}

document.querySelector("#getotp_btn").addEventListener('click', () => {
    phoneAuth()
})