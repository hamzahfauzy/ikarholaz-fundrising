<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Transaksi</h2>
                        <h5 class="text-white op-7 mb-2">Data transaksi</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="<?=routeTo()?>transactions/import" class="btn btn-secondary btn-round">Import Transaksi</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode</th>
                                            <th>Waktu Transaksi</th>
                                            <th>Waktu Bayar</th>
                                            <th>Nama Lengkap</th>
                                            <th>Anonim</th>
                                            <th>No. WA</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($transactions as $index => $transaction): ?>
                                        <tr>
                                            <td><?=$index+1?></td>
                                            <td><?=$transaction->checkout_id?></td>
                                            <td><?=$transaction->created_at?></td>
                                            <td><?=$transaction->updated_at?></td>
                                            <td><?=$transaction->subject->name?></td>
                                            <td><?=$transaction->subject->is_anonim?'Ya':'Tidak'?></td>
                                            <td><?=$transaction->subject->phone?></td>
                                            <td><?=number_format($transaction->amount)?></td>
                                            <td>
                                                <?php if($transaction->status == 'checkout'): ?>
                                                <span class="badge badge-warning"><?=$transaction->status?></span>
                                                <?php elseif($transaction->status == 'confirm'): ?>
                                                <span class="badge badge-success"><?=$transaction->status?></span>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <?php if($transaction->status == 'confirm'): ?>
                                                <a href="<?=routeTo('transactions/resend',['id'=>$transaction->id])?>" class="btn btn-sm btn-success" title="Resend Notif"><i class="fas fa-redo"></i></a>
                                                <?php endif ?>
                                                <a href="<?=routeTo('default/transaction-detail',['id'=>$transaction->id,'type'=>'download'],1)?>" class="btn btn-sm btn-primary" title="Download Bukti"><i class="fas fa-download"></i></a>
                                                <a href="<?=routeTo('transactions/delete',['id'=>$transaction->id])?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>