<?php snippet('header')?>
<div class="user_container">
  <div class="user_wrapper">
    <div class="title"><?= $page->titlename() ?></div>
    <div>
      <div><?= $page->createuserbtn() ?></div>
      <form id="createForm" class="user_form">
        <input id="userEmail" class="user_input user_text" type="email" name="email" placeholder="email" />
        <input id="userPassword" class="user_input user_text" type="password" name="password" placeholder="password" />
        <button class="user_input user_createuser_btn">Butotn</button>
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
      <form class="user_form">
        <input class="user_input user_text" type="email" name="email" placeholder="email" />
        <input class="user_input user_createuser_btn" type="submit" value="Submit" />
      </form>
    
    </div>
  </div>
</div>


<?php snippet("user/user1")?>

<?php snippet('footer')?>