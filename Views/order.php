<div class="sort">
  <span class="sort__title">Сортировка:</span>
  <?php foreach ($arr as $value) { ?>
    <a href="<?php echo $link . "order_by={$value['order_by']}&order={$value['order']}" ?>"><?php echo $value['desc']; ?></a> |
  <?php } ?>
</div>