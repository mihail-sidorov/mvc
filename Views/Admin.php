<?php echo $message; ?>
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
        <form class="add-job" method="post" action="/admin" novalidate style="max-width:400px;">
            <div class="form-group">
                <label for="description">Описание задачи</label><?php if ($job['edit_admin'] == 1) { ?><span class="jobs__edit-admin"> Отредактировано Админом</span><?php } ?>
                <textarea class="form-control" id="description" rows="3" name="description"><?php echo $job['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="done">Выполнено</label>
                <input type="checkbox" id="done" name="done" value="1" <?php if ($job['done'] == 1) echo 'checked'; ?>>
            </div>
            <input type="hidden" name="id" value="<?php echo $job['id'] ?>">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
      </div>
      <hr>
    <?php } ?>
</div>

<?php echo $links; ?>