<?php if(empty($campaign->posts)): ?>
<center><i>Tidak ada data!</i></center>
<?php endif ?>
<?php foreach($campaign->posts as $post): ?>
<div class="row">
    <div class="col">
        <?= html_entity_decode($post->content) ?>
    </div>
</div>
<?php endforeach ?>