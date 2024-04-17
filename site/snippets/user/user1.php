<script>
  let readyPasswordForgot = false;

  const FPBtn = document.querySelector(".user_password")
  const userWraapper = document.querySelector(".user_wrapper")
  const passwordWraapper = document.querySelector(".password_wrapper")
  const resetWraapper = document.querySelector(".reset_wrapper")
  const createUserBtn = document.querySelector("#createUserBtn")

  FPBtn.addEventListener("click", () => {
    readyPasswordForgot = true
    if (readyPasswordForgot) {
      userWraapper.style.display = "none"
      passwordWraapper.style.display = "block"
    }
  })

  createUserBtn.addEventListener("click", () => {
    readyPasswordForgot = false
    if (!readyPasswordForgot) {
      userWraapper.style.display = "block"
      passwordWraapper.style.display = "none"
    }
  })

  // Create User 
  const createForm = document.querySelector("#createForm");
  const forgotPasswordForm = document.querySelector("#forgotPasswordForm");
  const userEmail = document.querySelector("#userEmail")
  const fUserEmail = document.querySelector("#fUserEmail")
  const userPassword = document.querySelector("#userPassword")
  const userPassword2 = document.querySelector("#userPasswordC")
  const passwordErrorM = document.querySelector("#passwordErrorM")

  const onFocus = () => {
    passwordErrorM.style.display = "none"
    passwordErrorM.innerHTML = ""
  }

  userEmail.addEventListener("focus", onFocus)
  userPassword.addEventListener("focus", onFocus)
  userPassword2.addEventListener("focus", onFocus)

  const userInfo = {
    authEmail: "<?= $page->env("USEREMAIL") ?>",
    authPassword: "<?= $page->env("USERPASSWORD") ?>"
  }
  const encodedAuthString = btoa(`${userInfo.authEmail}:${userInfo.authPassword}`);
  const headerAuthString = `Basic ${encodedAuthString}`;

  const onHandleSubmit = async (e) => {
    e.preventDefault()
    console.log(userEmail.value)
    console.log(userPassword.value)
    try {
      if (userPassword.value === userPassword2.value) {
        const bodyData = {
          email: userEmail.value,
          password: userPassword.value,
          role: "Orga",
          language: "en"
        }
        const res = await fetch(`/api/users`, {
          method: "POST",
          headers: {
            "Authorization": headerAuthString,
            "Content-Type": "application/json",
          },
          body: JSON.stringify(bodyData)
        });

        const jsonData = await res.json();
        if (jsonData.status === "error") {
          // 01.check if the Email is already taken, or password 
          console.log(jsonData.message)
        } else {
          // 02. If not then create a User and then redirect to Panel.

          console.log(jsonData)
          const redirecting = "<?= $site->url() ?>/panel"
          window.location.href = redirecting
        }
      } else {
        // password confirmation doesn't work
        console.log("check password")
        passwordErrorM.style.display = "block"
        passwordErrorM.innerHTML = "password blabla"
      }
    } catch (error) {
      console.log("error Message", error)
    }
  }
  createForm.addEventListener("submit", onHandleSubmit)

  const onHandleSubmitP = async (e) => {
    e.preventDefault()
    try {
      const bodyData = {
        select: {

        }
      }
      const res = await fetch(`/api/users`, {
        method: "GET",
        headers: {
          "Authorization": headerAuthString,
          "Content-Type": "application/json",
        },


      });
      const userList = await res.json();


      // check the email is exist.
      const foundUser = userList.data.find((v) => v.email === fUserEmail.value)
      console.log(foundUser)
      // if not exist
      if (!Boolean(foundUser)) {
        console.log("wrong email")
        // show error message

      } else {
        // password question01 
        const res2 = await fetch(`/api/users/${foundUser.id}`, {
          method: "GET",
          headers: {
            "Authorization": headerAuthString,
            "Content-Type": "application/json",
          },
        });
        const findUser = await res2.json();
        console.log(findUser)
        console.log(pQuestion.value)


        // compare your answer and user answoer
        if (findUser.data.content.infopassword === pQuestion.value) {
          console.log("YEah")
          passwordWraapper.style.display = "none"
          resetWraapper.style.display = "block"

          const resetForm = document.querySelector("#resetForm");
          const r_password = document.querySelector("#r_password");
          const r_password2 = document.querySelector("#r_password2");
          const onHandleResetSubmit = async (e) => {
            e.preventDefault();
            if (r_password.value === r_password2.value) {
              // reset
              console.log("dddreset")
              console.log(r_password.value)
              console.log(findUser.data.id)
              console.log(findUser.data.email)
              const passwordData = {
                password: r_password.value
              }
              const res3 = await fetch(`/api/users/${findUser.data.id}/password`, {
                method: "PATCH",
                headers: {
                  "Authorization": headerAuthString,
                  "Content-Type": "application/json",
                },
                body: JSON.stringify(passwordData)
              });
              const resetPasswordStatus = await res3.json();
              console.log(resetPasswordStatus)
            } else {
              // confirmation went wrong
              console.log("check password")
            }

          }
          resetForm.addEventListener("submit", onHandleResetSubmit)
        } else {
          // wrong answer
        }
      }



    } catch (error) {
      console.log("error")
    }
  }
  forgotPasswordForm.addEventListener("submit", onHandleSubmitP)
</script>