const pass = document.getElementById("password");
const email = document.getElementById("email");

const toggle = () => {
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}