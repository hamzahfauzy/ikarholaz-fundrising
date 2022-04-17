<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Import Transaksi</h2>
                        <h5 class="text-white op-7 mb-2">Manajemen data transaksi</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="<?=routeTo()?>transactions/index" class="btn btn-warning btn-round">Kembali</a>
                        <a href="<?=routeTo()?>transactions/format-download" class="btn btn-primary btn-round">Download Format</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Jenis</label>
                                    <select name="jenis" id="jenis" class="form-control" onchange="loadJenis(this.value)">
                                        <option value="campaigns">Kampanye</option>
                                        <option value="donations">Donasi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Referensi</label>
                                    <select name="referensi" id="referensi" class="form-control" required></select>
                                </div>
                                <div class="form-group">
                                    <label for="">File</label>
                                    <input type="file" name="file" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function loadJenis(jenis)
    {
        fetch('index.php?r=api/load-jenis&jenis='+jenis)
        .then(res => res.json())
        .then(res => {
            document.querySelector('#referensi').innerHTML = ''
            res.data.forEach((r,i) => {
                document.querySelector('#referensi').innerHTML += '<option value="'+r.id+'">'+r.name+'</option>'
            })
        })
    }
    loadJenis('campaigns')
    </script>
<?php load_templates('layouts/bottom') ?>