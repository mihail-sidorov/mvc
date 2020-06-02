<form class="add-job" method="post" action="/login" novalidate style="max-width: 400px;">
  <div class="form-group">
    <label for="login">Логин</label>
    <input type="text" class="form-control" id="login" name="login" value="<?php if(isset($request->params['login'])) echo $request->params['login'] ?>">
    <?php
      if (isset($errors['login'])) {
        ?>
        <div class="error-message">
          <?php echo $errors['login']; ?>
        </div>
        <?php
      }
    ?>
  </div>
  <div class="form-group">
    <label for="password">Пароль</label>
    <input type="password" class="form-control" id="password" name="password" value="">
    <?php
      if (isset($errors['password'])) {
        ?>
        <div class="error-message">
          <?php echo $errors['password']; ?>
        </div>
        <?php
      }
    ?>
  </div>
  <button type="submit" class="btn btn-primary">Войти</button>
</form>