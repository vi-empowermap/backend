<script>

  const errorMessageList = {
    passwordConfirmation: "<?= $page->passwordconfirmation() ?>",
    notFoundEmail: "<?= $page->notexistemail() ?>",
    existEmail: "<?= $page->existemail() ?>",
    wrongAnswer: "<?= $page->wronganswer() ?>",
    globalError: "<?= $page->globalerror() ?>"

  }
  
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

  /* Sign-Up Page */
  const userEmail = document.querySelector("#userEmail")
  const userPassword = document.querySelector("#userPassword")
  const userPassword2 = document.querySelector("#userPasswordC")

  /* Forget Paassword Page */
  const fUserEmail = document.querySelector("#fUserEmail")
  const pQuestion = document.querySelector("#pQuestion")

  /* Reset Page */
  const r_password = document.querySelector("#r_password");
  const r_password2 = document.querySelector("#r_password2");

  /* Error Messages */
  // sign-up
  const userEmailErrorM = document.querySelector("#userEmailErrorM")
  const passwordErrorM = document.querySelector("#passwordErrorM")
  // forget password
  const fUserEmailErrorM = document.querySelector("#fUserEmailErrorM")
  const pQuestionErrorM = document.querySelector("#pQuestionErrorM")
  // reset
  const r_password2ErrorM = document.querySelector("#r_password2ErrorM")


  /* Sign up page close Errormessage */
  const onFocus = () => {
    userEmailErrorM.style.display = "none"
    userEmailErrorM.innerHTML = ""
    passwordErrorM.style.display = "none"
    passwordErrorM.innerHTML = ""
    fUserEmailErrorM.style.display = "none"
    fUserEmailErrorM.innerHTML = ""
    pQuestionErrorM.style.display = "none"
    pQuestionErrorM.innerHTML = ""
    r_password2ErrorM.style.display = "none"
    r_password2ErrorM.innerHTML = ""

  }
  userEmail.addEventListener("focus", onFocus)
  userPassword.addEventListener("focus", onFocus)
  userPassword2.addEventListener("focus", onFocus)
  fUserEmail.addEventListener("focus", onFocus)
  pQuestion.addEventListener("focus", onFocus)
  r_password.addEventListener("focus", onFocus)
  r_password2.addEventListener("focus", onFocus)

  /* Forget Password Page close Errormessage */

  /* Fetch Header Info */
  const userInfo = {
    authEmail: "<?= $page->env("USEREMAIL") ?>",
    authPassword: "<?= $page->env("USERPASSWORD") ?>"
  }
  const encodedAuthString = btoa(`${userInfo.authEmail}:${userInfo.authPassword}`);
  const headerAuthString = `Basic ${encodedAuthString}`;

  // ------------------------------------------------------------------------------------------------

  const onHandleSubmit = async (e) => {
    e.preventDefault()

    try {
      // Check Password Confirmation
      if (userPassword.value === userPassword2.value) {
        // Get Users
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
          // ErrorMessage 01: if the Email is already taken, or password 
          userEmailErrorM.style.display = "block"
          userEmailErrorM.innerHTML = errorMessageList.existEmail
        } else {
          // then create a User and then redirect to Panel.
          const redirecting = "<?= $site->url() ?>/panel"
          window.location.href = redirecting
        }
      } else {
        // password confirmation doesn't work
        passwordErrorM.style.display = "block"
        passwordErrorM.innerHTML = errorMessageList.passwordConfirmation
      }
    } catch (error) {
      window.alert(errorMessageList.globalError)
    }
  }
  createForm.addEventListener("submit", onHandleSubmit)


  /* Password Forget Page */
  const onHandleSubmitP = async (e) => {
    e.preventDefault()
    try {
      /* Get userList */
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
      // if the email is not exist
      if (!Boolean(foundUser)) {
        // show error message
        fUserEmailErrorM.style.display = "block"
        fUserEmailErrorM.innerHTML = errorMessageList.notFoundEmail
      } else {

        // find the user
        const res2 = await fetch(`/api/users/${foundUser.id}`, {
          method: "GET",
          headers: {
            "Authorization": headerAuthString,
            "Content-Type": "application/json",
          },
        });
        const findUser = await res2.json();
        // compare your answer and user answer
        if (findUser.data.content.infopassword === pQuestion.value) {

          // open reset password page
          passwordWraapper.style.display = "none"
          resetWraapper.style.display = "block"


          const resetForm = document.querySelector("#resetForm");


          const onHandleResetSubmit = async (e) => {
            e.preventDefault();

            // check password confirmation
            if (r_password.value === r_password2.value) {
              // reset
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
              //  after reset
              if (resetPasswordStatus.status = "ok") {
                const redirecting = "<?= $site->url() ?>/panel"
                window.location.href = redirecting
              } else {
                window.alert(errorMessageList.globalError)
              }


            } else {
              r_password2ErrorM.style.display = "block"
              r_password2ErrorM.innerHTML = errorMessageList.passwordConfirmation
            }

          }
          resetForm.addEventListener("submit", onHandleResetSubmit)
        } else {
          // wrong answer
          pQuestionErrorM.style.display = "block"
          pQuestionErrorM.innerHTML = errorMessageList.wrongAnswer
        }
      }



    } catch (error) {
      window.alert(errorMessageList.globalError)
    }
  }
  forgotPasswordForm.addEventListener("submit", onHandleSubmitP)
</script>