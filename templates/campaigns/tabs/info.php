<div class="card">
    <div class="card-body">
        <a href="index.php?r=posts/create&post_type=campaigns&post_type_id=<?=$campaign->id?>" class="btn btn-primary">Buat Postingan</a>
        <div class="table-responsive table-hover table-sales">
            <table class="table">
                <thead>
                    <tr>
                        <th width="20px">#</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data->posts)): ?>
                    <tr>
                        <td colspan="4" style="text-align:center"><i>Tidak ada data</i></td>
                    </tr>
                    <?php endif ?>
                    <?php foreach($data->posts as $index => $post): ?>
                    <tr>
                        <td>
                            <?=$index+1?>
                        </td>
                        <td><?=$post->title?></td>
                        <td><?=$post->created_at?></td>
                        <td>
                            <a href="index.php?r=posts/edit&id=<?=$post->id?>" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="index.php?r=posts/delete&id=<?=$post->id?>" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>