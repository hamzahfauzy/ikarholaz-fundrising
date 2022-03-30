<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Kampanye</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data Kampanye</h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <a href="index.php?r=campaigns/create" class="btn btn-secondary btn-round">Buat Kampanye</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if($success_msg): ?>
                            <div class="alert alert-success"><?=$success_msg?></div>
                            <?php endif ?>
                            <div class="table-responsive table-hover table-sales">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th width="20px">#</th>
                                            <?php 
                                            foreach(config('fields')[$table] as $field): 
                                                $label = $field;
                                                if(is_array($field))
                                                {
                                                    $label = $field['label'];
                                                }
                                                $label = _ucwords($label);
                                                if(in_array($label, ['Ringkasan','Deskripsi'])) continue;
                                            ?>
                                            <th><?=$label?></th>
                                            <?php endforeach ?>
                                            <th class="text-right">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($datas as $index => $data): ?>
                                        <tr>
                                            <td>
                                                <?=$index+1?>
                                            </td>
                                            <?php 
                                            foreach(config('fields')[$table] as $key => $field): 
                                                $label = $field;
                                                if(is_array($field))
                                                {
                                                    $label = $field['label'];
                                                    $type  = $field['type']??'text';
                                                    $data_value = in_array($key, ['summary','description']) ? html_entity_decode($data->{$key}) : $data->{$key};
                                                    $data_value = ($key == 'amount_target') ? number_format($data_value) : $data_value;
                                                    $data_value = Form::getData($type,$data_value);
                                                    $field = $key;
                                                }
                                                else
                                                {
                                                    $data_value = in_array($field, ['summary','description']) ? html_entity_decode($data->{$field}) : $data->{$field};
                                                    $data_value = ($field == 'amount_target') ? number_format($data_value) : $data_value;
                                                }
                                                $label = _ucwords($label);
                                                if(in_array($label, ['Ringkasan','Deskripsi'])) continue;
                                            ?>
                                            <td><?=$data_value?></td>
                                            <?php endforeach ?>
                                            <td style="white-space:nowrap">
                                                <a href="index.php?r=campaigns/view&id=<?=$data->id?>" class="btn btn-sm btn-success" title="Detail"><i class="fas fa-eye"></i></a>
                                                <a href="index.php?r=campaigns/edit&id=<?=$data->id?>" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="index.php?r=campaigns/delete&id=<?=$data->id?>" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
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