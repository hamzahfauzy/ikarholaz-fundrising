<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Buat Info <?=$_GET['post_type'] == 'donations' ? 'Donasi' : 'Kampanye'?> Baru</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data info <?=$_GET['post_type'] == 'donations' ? 'Donasi' : 'Kampanye'?></h5>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                    <a href="<?=routeTo().$_GET['post_type']?>/view&id=<?=$_GET['post_type_id']?>" class="btn btn-warning btn-round">Kembali</a>
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
                                <input type="hidden" name="posts[post_type]" value="<?=$_GET['post_type']?>">
                                <input type="hidden" name="posts[post_type_id]" value="<?=$_GET['post_type_id']?>">
                                <?php 
                                foreach(config('fields')[$table] as $key => $field): 
                                    $label = $field;
                                    $type  = "text";
                                    if(is_array($field))
                                    {
                                        $field_data = $field;
                                        $field = $key;
                                        $label = $field_data['label'];
                                        if(isset($field_data['type']))
                                        $type  = $field_data['type'];
                                    }
                                    $label = _ucwords($label);
                                    $class = 'form-control';
                                    if(in_array($label,['Konten']))
                                    {
                                        $class .= ' summernote';
                                    }
                                ?>
                                <div class="form-group">
                                    <label for=""><?=$label?></label>
                                    <?= Form::input($type, $table."[".$field."]", ['class'=>$class,"placeholder"=>$label,"required"=>""]) ?>
                                </div>
                                <?php endforeach ?>
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
<?php load_templates('layouts/bottom') ?>