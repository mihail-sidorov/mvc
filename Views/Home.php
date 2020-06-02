<?php echo $message; ?>
<br>
<br>
<form class="add-job" method="post" action="/home" novalidate style="max-width: 400px;">
  <div class="form-group">
    <label for="name">Имя</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($request->params['name'])) echo $request->params['name'] ?>">
    <?php
      if (isset($errors['name'])) {
        ?>
        <div class="error-message">
          <?php echo $errors['name']; ?>
        </div>
        <?php
      }
    ?>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($request->params['email'])) echo $request->params['email'] ?>">
    <?php
      if (isset($errors['email'])) {
        ?>
        <div class="error-message">
          <?php echo $errors['email']; ?>
        </div>
        <?php
      }
    ?>
  </div>
  <div class="form-group">
    <label for="description">Описание задачи</label>
    <textarea class="form-control" id="description" rows="3" name="description"><?php if(isset($request->params['description'])) echo $request->params['description'] ?></textarea>
    <?php
      if (isset($errors['description'])) {
        ?>
        <div class="error-message">
          <?php echo $errors['description']; ?>
        </div>
        <?php
      }
    ?>
  </div>
  <button type="submit" class="btn btn-primary">Создать задачу</button>
</form>
<br>
<br>
<?php echo $order; ?>
<br>
<br>
Список задач:
<br>
<br>
<div class="jobs">
    <?php foreach($jobs as $job) { ?>
      <div class="jobs__item">
        <div class="jobs__item-name"><?php echo $job['name'] ?></div>
        <div class="jobs__item-email"><?php echo $job['email'] ?></div>
        <div class="lobs__item-description"><?php echo $job['description'] ?></div>
        <?php if ($job['edit_admin'] == 1) { ?>
          <div class="jobs__edit-admin">Отредактировано Админом</div>
        <?php } ?>
        <?php if ($job['done'] == 1) { ?>
          <div class="jobs__done">Выполнено</div>
        <?php }else { ?>
          <div class="jobs__done">Не выполнено</div>
        <?php } ?>
      </div>
      <hr>
    <?php } ?>
</div>
<?php echo $links; ?>