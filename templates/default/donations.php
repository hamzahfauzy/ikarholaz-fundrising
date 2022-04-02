<?php load_templates('layouts/default-top') ?>

    <div class="content mt-4">
        <h1 class="text-center">Semua Donasi</h1>
    </div>

    <div class="row">
        <?php if(empty($donations)): ?>
        <div class="col text-center">
            <i>Tidak ada data!</i>
        </div>
        <?php endif ?>
        <?php foreach($donations as $donation): ?>
        <div class="col-md-4">
            <?php require 'donation-item.php' ?>
        </div>
        <?php endforeach ?>
    </div>
<?php load_templates('layouts/default-bottom') ?>