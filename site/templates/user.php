<?php snippet('header') ?>
<div class="user_container">
  <!-- 
    Sign Up Page
    - 1. Check: if Sign Up has been suspended.
    - 2. Check: if Capacity for a SECRET_KEY.
    - 3. Check: if the Email is already taken. 
    - 4. Check: Password Confirmation.
  -->
  <div class="user_wrapper default_wrapper">
    <div class="title"><?= $page->titlename() ?></div>
    <div id="disabled_message" class="disabled_message"></div>
    <div>
      <form id="createForm" class="user_form">
        <div>
          <input id="secretKey" class="user_input user_text" type="text" name="secret" placeholder="Secret Key" />
          <div id="secretKeyErrorM" class="error_message"></div>
        </div>
        <div>
          <input id="userEmail" class="user_input user_text" type="email" name="email" placeholder="Email" />
          <div id="userEmailErrorM" class="error_message"></div>
        </div>
        <div>
          <input id="userPassword" class="user_input user_text" minlength="8" type="password" name="password" placeholder="Password" />
        </div>
        <div>
          <input id="userPasswordC" class="user_input user_text" minlength="8" type="password" name="password2" placeholder="Confirm Password" />
          <div id="passwordErrorM" class="error_message"></div>
        </div>
        <button id="signPBtn" class="user_input user_createuser_btn"><?= $page->createuserbtn() ?></button>
      </form>
      <div class="user_login">
        <div><?= $page->loginbtn2() ?></div>
        <a href="<?= $site->url() ?>/panel"><?= $page->loginbtn() ?></a>
      </div>
      <div class="user_login">
        <div><?= $page->forgetpasswordbtn2() ?></div>
        <div class="user_password"><?= $page->forgetpasswordbtn() ?></div>
      </div>

    </div>
  </div>
  <!-- 
    Forget Password Page1
    - 1. Check: if the Email is exist.
   -->
  <div class="password_wrapper default_wrapper">
    <div class="title"><?= $page->forgetpagename() ?></div>
    <div>
      <form id="forgotPasswordForm" class="user_form">
        <div>
          <input id="fUserEmail" class="user_input user_text" type="email" name="email" placeholder="Email" />
          <div id="fUserEmailErrorM" class="error_message"></div>
        </div>

        <button class="user_input user_createuser_btn"><?= $page->forgetpasswordbtn3() ?></button>
      </form>
      <div class="user_login">
        <div id="createUserBtn" class="createUserBtn_c user_btn">&larr; <?= $page->createuserbtn() ?></div>
      </div>
    </div>
  </div>
  <!-- 
    Forget Password Page2
    - 2. Check: Answer Confirmation 
  -->
  <div class="password_wrapper2 default_wrapper">
    <div class="title"><?= $page->forgetpagename() ?></div>
    <div>
      <form id="forgotPasswordForm2" class="user_form">
        <div id="pQuestion2"></div>
        <div>
          <input id="pQuestion" class="user_input user_text" type="text" name="question" placeholder="Answer" />
          <div id="pQuestionErrorM" class="error_message"></div>
        </div>
        <button class="user_input user_createuser_btn"><?= $page->forgetpasswordbtn3() ?></button>
      </form>
      <div class="user_login">
        <div id="createUserBtn2" class="createUserBtn_c user_btn">&larr; <?= $page->createuserbtn() ?></div>
      </div>
    </div>
  </div>
  <!-- 
    Reset Page 
    - 1. Check: Password Confirmation.
  -->
  <div class="reset_wrapper default_wrapper">
    <div class="title"><?= $page->resetpagename() ?></div>
    <div>
      <form id="resetForm" class="user_form">
        <div>
          <input id="r_password" class="user_input user_text" minlength="8" type="password" name="password" placeholder="Password" />
        </div>
        <div>
          <input id="r_password2" class="user_input user_text" minlength="8" type="password" name="password2" placeholder="Confirm Password" />
          <div id="r_password2ErrorM" class="error_message"></div>
        </div>
        <button class="user_input user_createuser_btn"><?= $page->resetbtn() ?></button>
      </form>
    </div>
  </div>
</div>


</div>


<!-- 💡Write the <script> tag in the snippet file. Kirby syntax works between script tags with JavaScript -->
  
<?php snippet("user/test") ?>
<?php snippet("user/user1") ?>
<?php snippet('footer') ?>