<script>
  /* ---- You need to use Fetch to handle KIRBY API ---- */
  /* Fetch Header Info */
  const userInfo = {
    // authEmail: "zndgn555@gmail.com",
    // authPassword: "123123123"
      // authEmail: "<?= $page->env("USEREMAIL") ?>",
      authEmail: "<?= $page->env("USEREMAIL") ?>",
      authPassword: "<?= $page->env("USERPASSWORD") ?>"
  }

  /* Buffer is for NODEJS so PHP have to use btoa to handle Binary data */
  const encodedAuthString = btoa(`${userInfo.authEmail}:${userInfo.authPassword}`)
  const headerAuthString = `Basic ${encodedAuthString}`

  /* Error Messages List: Panel->Site->user */
  const errorMessageList = {
    passwordConfirmation: "<?= $page->passwordconfirmation() ?>",
    notFoundEmail: "<?= $page->notexistemail() ?>",
    existEmail: "<?= $page->existemail() ?>",
    wrongAnswer: "<?= $page->wronganswer() ?>",
    globalError: "<?= $page->globalerror() ?>",
    fullcapacity: "<?= $page->fullcapacity() ?>",
    wrongkey: "<?= $page->wrongkey() ?>",
    signupservice: "<?= $page->signupservice() ?>",
  }

  const FPBtn = document.querySelector(".user_password")
  const userWraapper = document.querySelector(".user_wrapper")
  const passwordWraapper = document.querySelector(".password_wrapper")
  const passwordWraapper2 = document.querySelector(".password_wrapper2")
  const resetWraapper = document.querySelector(".reset_wrapper")
  const createUserBtn = document.querySelectorAll(".createUserBtn_c")

  // Create User 
  const createForm = document.querySelector("#createForm")
  const forgotPasswordForm = document.querySelector("#forgotPasswordForm")

  /* Sign-Up Page */
  const secretKey = document.querySelector("#secretKey")
  const userEmail = document.querySelector("#userEmail")
  const userPassword = document.querySelector("#userPassword")
  const userPassword2 = document.querySelector("#userPasswordC")

  /* Forget Paassword Page */
  const fUserEmail = document.querySelector("#fUserEmail")
  const pQuestion = document.querySelector("#pQuestion")
  const forgotPasswordForm2 = document.querySelector("#forgotPasswordForm2")

  /* Reset Page */
  const r_password = document.querySelector("#r_password")
  const r_password2 = document.querySelector("#r_password2")

  /* Error Messages */
  // sign-up
  const secretKeyErrorM = document.querySelector("#secretKeyErrorM")
  const userEmailErrorM = document.querySelector("#userEmailErrorM")
  const passwordErrorM = document.querySelector("#passwordErrorM")
  // forget password
  const fUserEmailErrorM = document.querySelector("#fUserEmailErrorM")
  const pQuestionErrorM = document.querySelector("#pQuestionErrorM")
  // reset
  const r_password2ErrorM = document.querySelector("#r_password2ErrorM")

  /* Open Forget Password Page */
  FPBtn.addEventListener("click", () => {
    userWraapper.style.display = "none"
    passwordWraapper.style.display = "block"
    passwordWraapper2.style.display = "none"
  })
  /* Open Sign-Up Page: in Forget Password page1 and page2 */
  createUserBtn.forEach((element, index) => {
    element.addEventListener("click", () => {
      userWraapper.style.display = "block"
      passwordWraapper.style.display = "none"
      passwordWraapper2.style.display = "none"
    })
  })

  /* Sign up page close Errormessage */
  const onFocus = () => {
    secretKeyErrorM.style.display = "none"
    secretKeyErrorM.innerHTML = ""
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
  secretKey.addEventListener("focus", onFocus)
  userEmail.addEventListener("focus", onFocus)
  userPassword.addEventListener("focus", onFocus)
  userPassword2.addEventListener("focus", onFocus)
  fUserEmail.addEventListener("focus", onFocus)
  pQuestion.addEventListener("focus", onFocus)
  r_password.addEventListener("focus", onFocus)
  r_password2.addEventListener("focus", onFocus)

  // ------------------------------------------------------------------------------------------------

  /* Sign-Up Page */
  const updateSignUpPage = async (end = false) => {
    try {
      const signPBtn = document.querySelector("#signPBtn")
      const disabled_message = document.querySelector("#disabled_message")

      const res = await fetch(`/api/site`, {
        method: "GET",
        headers: {
          "Authorization": headerAuthString,
          "Content-Type": "application/json",
        },
      })
      const data = await res.json()

      if (data.status === "ok") {
        if (data.data.content.signupon) {
          signPBtn.disabled = false
          disabled_message.style.block = "none"

          const resUsers = await fetch(`/api/users?select=content,role`, {
            method: "GET",
            headers: {
              "Authorization": headerAuthString,
              "Content-Type": "application/json",
            },
          })
          const usersList = await resUsers.json()
          const currentOgaCounts = usersList.data.filter((v) => v.role.name === "orga")
        
          const currentKeyOraCounts = currentOgaCounts.filter((v) => v.content.secret_key ===
            data.data.content.randomcode)
         



          // update current length 
          const bodyData = {
            infototalcount: currentKeyOraCounts.length,
          }
          const updateSite = await fetch(`/api/site`, {
            method: "PATCH",
            headers: {
              "Authorization": headerAuthString,
              "Content-Type": "application/json",
            },
            body: JSON.stringify(bodyData)
          })

          // if already voll then disabled again 
          if (currentKeyOraCounts.length >= data.data.content.limitcount) {
            if (!end) {
              signPBtn.disabled = true
              disabled_message.style.display = "block"
              disabled_message.innerText = errorMessageList.fullcapacity
            }

          } else {
            signPBtn.disabled = false
            disabled_message.style.block = "none"
          }
        } else {
          // show message
          signPBtn.disabled = true
          disabled_message.style.display = "block"
          disabled_message.innerText = errorMessageList.signupservice

        }
      }

      return data
    } catch (error) {
      window.alert(errorMessageList.globalError)
    }

  }
  /* When user open the sign-up page then update the current information of sign-up config first */
  updateSignUpPage()


  /* SignUp Page */
  const onHandleSubmit = async (e) => {
    e.preventDefault()

    try {
      // ⭐️ check site toggle first
      // ⭐️ update current count for site page and save current users count
      // ⭐️ change user info to secret key 
      // ⭐️ update again current count

      const sitedata = await updateSignUpPage()

      // Check Password Confirmation
      if (userPassword.value === userPassword2.value) {
        if (secretKey.value === sitedata.data.content.randomcode) {
          // Get Users
          const bodyData = {
            email: userEmail.value,
            password: userPassword.value,
            role: "Orga",
            language: "en",
            content: {
              secret_key: sitedata.data.content.randomcode
            }

          }
          const res = await fetch(`/api/users`, {
            method: "POST",
            headers: {
              "Authorization": headerAuthString,
              "Content-Type": "application/json",
            },
            body: JSON.stringify(bodyData)

          })

          const jsonData = await res.json()


          if (jsonData.status === "error") {
            // ErrorMessage 01: if the Email is already taken, or password 
            userEmailErrorM.style.display = "block"
            userEmailErrorM.innerHTML = errorMessageList.existEmail
          } else {
            // then create a User and then redirect to Panel.
            await updateSignUpPage(true)
            const redirecting = "<?= $site->url() ?>/panel"
            window.location.href = redirecting
          }
        } else {
          // error message wrong secret key
          secretKeyErrorM.style.display = "block"
          secretKeyErrorM.innerHTML = errorMessageList.wrongkey
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
      })
      const userList = await res.json()


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
        })
        const findUser = await res2.json()
        passwordWraapper.style.display = "none"
        passwordWraapper2.style.display = "block"
        const pQuestion2 = document.querySelector("#pQuestion2")
        pQuestion2.innerText = `Question:${findUser.data.content.customquestion}`

        const onHandleSubmitPP = (ee) => {
          ee.preventDefault()

          // compare your answer and user answer
          if (findUser.data.content.infopassword === pQuestion.value) {

            // open reset password page
            passwordWraapper2.style.display = "none"
            resetWraapper.style.display = "block"


            const resetForm = document.querySelector("#resetForm")


            const onHandleResetSubmit = async (e) => {
              e.preventDefault()

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
                })

                const resetPasswordStatus = await res3.json()
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

        forgotPasswordForm2.addEventListener("submit", onHandleSubmitPP)


      }



    } catch (error) {
      window.alert(errorMessageList.globalError)
    }
  }
  forgotPasswordForm.addEventListener("submit", onHandleSubmitP)
</script>