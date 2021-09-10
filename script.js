window.onload = () => {
    const txtName = document.getElementById("text-name").children[0];
    const txtPost = document.getElementById("text-post").children[0];
    const txtPostNum = document.getElementById("text-post-num");
    const btnSubmit = document.getElementById("btn-submit").children[0];
    const btnHome = document.getElementById("btn-home");

    btnSubmit.disabled = true;

    addEventListener("keyup", (e) => {
        btnSubmit.disabled = txtName.value && txtPost.value ? false : true;
    });

    txtPost.addEventListener("keyup", (e) => {
        txtPostNum.innerText = txtPost.value.length;
    });

    btnHome.addEventListener("click", (e) => {
        window.open("https://twitter.com/CamelCaseLover", "_blank");
    });
};