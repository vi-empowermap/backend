<?php snippet('header') ?>
<div class="user_container">
  <div class="user_wrapper">

    <div class="title"><?= $page->titlename() ?></div>

    <div>
      <form id="createForm" class="user_form">
        <div>

          <input id="userEmail" class="user_input user_text" type="email" name="email" placeholder="Email" />
        </div>
        <div>
          <input id="userPassword" class="user_input user_text" type="password" name="password" placeholder="Password" />
        </div>
        <div>
          <input id="userPasswordC" class="user_input user_text" type="password" name="password2" placeholder="Confirm Password" />
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
        <input id="fUserEmail" class="user_input user_text" type="email" name="email" placeholder="Email" />
        <input id="pQuestion" class="user_input user_text" type="text" name="question" placeholder="Answer" />
        <button class="user_input user_createuser_btn"><?= $page->forgetpasswordbtn3() ?></button>
      </form>
      <div class="user_login">
        <div id="createUserBtn" class="user_btn">&larr; <?= $page->createuserbtn() ?></div>
      </div>
    </div>
  </div>
</div>


<?php snippet("user/user1") ?>

<?php snippet('footer') ?>