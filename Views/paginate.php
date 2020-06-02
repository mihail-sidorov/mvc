<nav aria-label="Page navigation">
  <ul class="pagination">
    <li class="page-item<?php if (static::$page == 1) echo ' disabled'; ?>">
      <a class="page-link" href="<?php echo $link . 'page=' . (static::$page - 1); ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php for ($i = 1; $i <= $count_pages; $i++) { ?>
        <li class="page-item<?php if (static::$page == $i) echo ' active'; ?>"><a class="page-link" href="<?php echo $link . "page=$i"; ?>"><?php echo $i; ?></a></li>
    <?php } ?>
    <li class="page-item<?php if (static::$page == $count_pages) echo ' disabled'; ?>">
      <a class="page-link" href="<?php echo $link . 'page=' . (static::$page + 1); ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>