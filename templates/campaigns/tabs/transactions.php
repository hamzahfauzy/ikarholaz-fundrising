<div class="card">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="transactions[destination_id]" value="<?=$data->id?>">
            <div class="form-group">
                <label for="">File Import</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Import</button>
            </div>
        </form>
        
        <div class="table-responsive table-hover table-sales">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th width="20px">#</th>
                        <th>Subjek</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data->transactions)): ?>
                    <tr>
                        <td colspan="3" style="text-align:center"><i>Tidak ada data</i></td>
                    </tr>
                    <?php endif ?>
                    <?php foreach($data->transactions as $index => $transaction): ?>
                    <tr>
                        <td>
                            <?=$index+1?>
                        </td>
                        <td><?=$transaction->subject->is_anonim ? 'Hamba Allah' : $transaction->subject->name?></td>
                        <td><?=$transaction->amount?></td>
                        <td><?=$transaction->status?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>