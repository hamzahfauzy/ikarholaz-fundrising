<?php if(!isset($_GET['cetak'])): ?>
<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Laporan</h2>
                        <h5 class="text-white op-7 mb-2">Laporan keuangan</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="">
                            <input type="hidden" name="r" value="reports/index">
                            <div class="form-group">
                                <label for="">Filter</label>
                                <div class="d-flex">
                                    <input type="date" name="from" class="form-control" value="<?=@$_GET['from']?>">
                                    &nbsp;
                                    <input type="date" name="to" class="form-control" value="<?=@$_GET['to']?>">
                                    &nbsp;
                                    <select name="type" class="form-control">
                                        <option value="">- Tipe -</option>
                                        <?php foreach($types as $type): ?>
                                        <option value="<?=$type->id?>" <?=isset($_GET['type']) && $_GET['type'] == $type->id ? 'selected=""' : '' ?>><?=(substr($type->id,0,2) == '2_' ? '(Donasi) ' : '(Kampanye)') . ' ' . $type->name?></option>
                                        <?php endforeach ?>
                                    </select>
                                    &nbsp;
                                    <button name="tampil" class="btn btn-success">Tampilkan</button>
                                    &nbsp;
                                    <button name="cetak" class="btn btn-primary">Cetak</button>
                                </div>
                            </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table">
                                <?php else: ?>
                                <script>window.print()</script>
                                <h1 align="center" style="margin:0;padding:0">LAPORAN KEUANGAN</h1>
                                <p align="center"><?=$_GET['from']?> - <?=$_GET['to']?></p>
                                <table border="1" cellpadding="5" cellspacing="0" width="100%">
                                <?php endif ?>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Dari</th>
                                            <th>Tahun Angkatan</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($transactions as $index => $transaction): ?>
                                        <tr>
                                            <td><?=$index+1?></td>
                                            <td><?=$transaction->subject->is_anonim ? 'Hamba Allah' : $transaction->subject->name?></td>
                                            <td><?=$transaction->subject->NRA?></td>
                                            <td><?=number_format($transaction->amount)?></td>
                                            <td>
                                                <?php if($transaction->status == 'checkout'): ?>
                                                <span class="badge badge-warning"><?=$transaction->status?></span>
                                                <?php elseif($transaction->status == 'confirm'): ?>
                                                <span class="badge badge-success"><?=$transaction->status?></span>
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                                <?php if(!isset($_GET['cetak'])): ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>
<?php endif ?>