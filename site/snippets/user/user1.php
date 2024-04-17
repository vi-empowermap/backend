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

  // Create User 
  const createForm = document.querySelector("#createForm");
  const userEmail = document.querySelector("#userEmail")
  const userPassword = document.querySelector("#userPassword")
  const onHandleSubmit = async (e) => {
    e.preventDefault()
    // 01.check if the Email is already taken.
    console.log(userEmail.value)
    console.log(userPassword.value)

    try{
      const userInfo = {
        authEmail: "zndgn555@gmail.com",
        authPassword: "123123123"
      }
      const encodedAuthString = btoa(`${userInfo.authEmail}:${userInfo.authPassword}`);
      const headerAuthString = `Basic ${encodedAuthString}`;
      const csrf = "<?= csrf() ?>";
      const res = await fetch("/api/site", {
        method: "GET",
        headers: {
            "X-CSRF" : csrf,
            "Authorization": headerAuthString
          }
      });
      const jsonData = await res.json();
      console.log(jsonData)
    }catch(error){
      console.log("error Message", error)
    }

  }


  createForm.addEventListener("submit", onHandleSubmit)

  // 02. If not then create a User and then redirect to Panel.

  // 03. If the Email is already taken then send an error message.
</script>