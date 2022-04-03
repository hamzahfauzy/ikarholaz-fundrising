<div class="card">
    <div class="card-body">
        <form action="" method="post">
            <input type="hidden" name="campaign_amounts[campaign_id]" value="<?=$data->id?>">
            <div class="form-group">
                <label for="">Nominal</label>
                <input type="number" name="campaign_amounts[amount]" class="form-control" required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    
        <div class="table-responsive table-hover table-sales">
            <table class="table">
                <thead>
                    <tr>
                        <th width="20px">#</th>
                        <th>Nominal</th>
                        <th class="text-right"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data->amounts)): ?>
                    <tr>
                        <td colspan="3" style="text-align:center"><i>Tidak ada data</i></td>
                    </tr>
                    <?php endif ?>
                    <?php foreach($data->amounts as $index => $amount): ?>
                    <tr>
                        <td>
                            <?=$index+1?>
                        </td>
                        <td><?=number_format($amount->amount)?></td>
                        <td>
                            <a href="<?=routeTo()?>campaigns/delete-amount&id=<?=$amount->id?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>