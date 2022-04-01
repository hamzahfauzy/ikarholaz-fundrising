<?php if(empty($donation->posts)): ?>
<center><i>Tidak ada data!</i></center>
<?php endif ?>
<?php foreach($donation->posts as $post): ?>
<div class="row">
    <div class="col">
        <?= html_entity_decode($post->content) ?>
    </div>
</div>
<?php endforeach ?>