<?php snippet('header')?>
<div class="user_container">
  <div class="user_wrapper">
    <div class="title"><?= $page->titlename() ?></div>
  
    <div>
      <div><?= $page->createuserbtn() ?></div>
      <form id="createForm" class="user_form">
        <input id="userEmail" class="user_input user_text" type="email" name="email" placeholder="email" />
        <input id="userPassword" class="user_input user_text" type="password" name="password" placeholder="password" />
        <input id="userPasswordC" class="user_input user_text" type="password" name="password2" placeholder="password confirmation" />
        <div id="passwordErrorM" class="error_message"></div>
        <button class="user_input user_createuser_btn">Button</button>
      </form>
      <div class="userlogin_wrapper">
        <a href="<?= $site->url() ?>/panel" class="user_input user_login">Log In</a>
        <div class="user_input user_password">Forgot Password</div>
      </div>
    </div>
  </div>
  <div class="password_wrapper">
    <div class="title">Forgot Password</div>
    <div>
      <form id="forgotPasswordForm" class="user_form">
        <input id="fUserEmail" class="user_input user_text" type="email" name="email" placeholder="email" />
        <div>Q1.blablabla</div>
        <input id="pQuestion"  class="user_input user_text" type="text" name="question" placeholder="write..." />
        <button class="user_input user_createuser_btn">Next</button>
      </form>
      <div class="userlogin_wrapper">
        <a href="<?= $site->url() ?>/panel" class="user_input user_login">Log In</a>
        <div id="createUserBtn" class="user_input user_btn">Create User</div>
      </div>
    </div>
  </div>
</div>


<?php snippet("user/user1")?>

<?php snippet('footer')?>