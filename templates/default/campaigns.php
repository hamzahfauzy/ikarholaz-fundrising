<?php load_templates('layouts/default-top') ?>
    <div class="content mt-4">
        <h1 class="text-center">Semua Kampanye</h1>
    </div>

    <div class="row">
        <?php if(empty($campaigns)): ?>
        <div class="col text-center">
            <i>Tidak ada data!</i>
        </div>
        <?php endif ?>
        <?php foreach($campaigns as $campaign): ?>
        <div class="col-md-4">
            <?php require 'campaign-item.php'; ?>
        </div>
        <?php endforeach ?>
    </div>
<?php load_templates('layouts/default-bottom') ?>