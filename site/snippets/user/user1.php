<script>
  let readyPasswordForgot = false;

  const FPBtn = document.querySelector(".user_password")
  const userWraapper = document.querySelector(".user_wrapper")
  const passwordWraapper = document.querySelector(".password_wrapper")
  FPBtn.addEventListener("click", () => {
    readyPasswordForgot = true
    if (readyPasswordForgot) {
      userWraapper.style.display = "none"
      passwordWraapper.style.display = "block"
    }
  })
</script>