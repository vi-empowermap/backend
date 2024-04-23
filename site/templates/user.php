<?php snippet('header') ?>
<div class="user_container">
  <!-- Sign Up Page -->
  <div class="user_wrapper">
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
  <!-- Password Page -->
  <div class="password_wrapper">
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
        <div id="createUserBtn" class="user_btn">&larr; <?= $page->createuserbtn() ?></div>
      </div>
    </div>
  </div>
  <div class="password_wrapper2">
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
        <div id="createUserBtn2" class="user_btn">&larr; <?= $page->createuserbtn() ?></div>
      </div>
    </div>
  </div>
  <!-- Reset Page -->
  <div class="reset_wrapper">
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


<?php snippet("user/user1") ?>

<?php snippet('footer') ?>