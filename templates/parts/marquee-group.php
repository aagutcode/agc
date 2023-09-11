<?php $categories = ['artists','directors','photographers','designers','stylists','hair artists','makeup artists','producers'];
shuffle($categories) ?>
<div class="group">
    <?php foreach($categories as $cat) { ?>
        <span><?= $cat; ?></span>
    <?php } ?>
</div>           