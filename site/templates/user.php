<?php snippet('header') ?>
<div class="user_container">
  <div class="user_wrapper">
    <div class="title"><?= $page->titlename() ?></div>

    <div>
      <form id="createForm" class="user_form">
        <div>
          <input id="userEmail" class="user_input user_text" type="email" name="email" placeholder="email" />
        </div>
        <div>
          <input id="userPassword" class="user_input user_text" type="password" name="password" placeholder="password" />
        </div>
        <div>
          <input id="userPasswordC" class="user_input user_text" type="password" name="password2" placeholder="password confirmation" />
          <div id="passwordErrorM" class="error_message"></div>
        </div>
        <button class="user_input user_createuser_btn"><?= $page->createuserbtn() ?></button>
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
  <div class="password_wrapper">
    <div class="title">Forgot Password</div>
    <div>
      <form id="forgotPasswordForm" class="user_form">
        <input id="fUserEmail" class="user_input user_text" type="email" name="email" placeholder="email" />
        <div>Q1.blablabla</div>
        <input id="pQuestion" class="user_input user_text" type="text" name="question" placeholder="write..." />
        <button class="user_input user_createuser_btn">Next</button>
      </form>
      <div class="userlogin_wrapper">
        <a href="<?= $site->url() ?>/panel" class="user_input user_login">Log In</a>
        <div id="createUserBtn" class="user_input user_btn">Create User</div>
      </div>
    </div>
  </div>
</div>


<?php snippet("user/user1") ?>

<?php snippet('footer') ?>