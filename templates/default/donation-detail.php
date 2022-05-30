<?php load_templates('layouts/default-top') ?>
    <div class="row mt-5">
        <div class="col-12 col-md-8">
            <img src="<?= base_url().'/'.$donation->pic_url?>" alt="<?=$donation->name?>" width="100%" class="mb-2">
            <div class="py-3">
                <?= html_entity_decode($donation->summary) ?>
            </div>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Detail</a>
                    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Donatur</a>
                    <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Info Terbaru</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active p-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <?= html_entity_decode($donation->description) ?>
                </div>
                <div class="tab-pane fade p-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    
                </div>
                <div class="tab-pane fade p-3" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <?php require 'donation-tabs/info.php' ?>
                </div>
            </div>
        </div>
        <div class="col col-md-4">
            <div class="card card-profile">
                <div class="card-body">
                    <div class="user-profile">
                        <small>Donasi</small>
                        <div class="name primary-color"><?=$donation->name?></div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row user-stats">
                        <div class="col">
                            <div class="number">Rp. <?=number_format($donation->total_transaction->total)?></div>
                            <div class="title">Dana Terkumpul</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="<?=routeTo('default/checkout',['type'=>'donations','id'=>$donation->id],true)?>" class="btn btn-primary btn-block">DONASI SEKARANG</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    var page = 1;
    var jenis = 'donations';
    var id = <?=$_GET['id']?>;
    var max_page = 100000;
    function loadDonatur(nav = false)
    {
        if(nav == 'next') page = page == max_page ? max_page : page + 1;
        if(nav == 'prev') page = page == 1 ? 1 : page - 1;
        fetch('<?=routeTo()?>api/load-donatur&id='+id+'&jenis='+jenis+'&page='+page)
        .then(res => res.json())
        .then(res => {
            document.querySelector('#nav-profile').innerHTML = ''
            if(res.status == 'success')
            {
                res.data.data.forEach(d => {
                    document.querySelector('#nav-profile').innerHTML += `
                    <div class="row mt-3 mx-auto rounded bg-white shadow-sm">
                        <div class="col p-4">
                            <div class="d-flex justify-content-between">
                                <div class="font-weight-bold"><span class="text-primary">${d.subject.name}</span> - Rp. ${d.amount}</div>
                                <div>${d.created_at}</div>
                            </div>
                        </div>
                    </div>
                    `
                })

                if(res.data.data.length == 0)
                {
                    document.querySelector('#nav-profile').innerHTML += `<center><i>Tidak ada data!</i></center>`
                }

                max_page = res.data.max_page

            }

            document.querySelector('#nav-profile').innerHTML += `
            <div class="row mt-3 mx-auto rounded">
            <nav aria-label="Page navigation example">
            <ul class="pagination">
                ${page > 1 ? '<li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="loadDonatur(\'prev\')">Previous</a></li>' : ''}
                ${page < max_page ? '<li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="loadDonatur(\'next\')">Next</a></li>' : ''}
            </ul>
            </nav>
            </div>
            `
        })
    }

    loadDonatur()
    </script>
<?php load_templates('layouts/default-bottom') ?>