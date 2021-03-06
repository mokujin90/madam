<?
/**
 * @var $licenses License[]
 * @var $this AdminLicenseController
 */
$classesArray=array(1=>array('icon'=>'icon-comments','color'=>'blue-background'),
                    2=>array('icon'=>'icon-star','color'=>'purple-background'),
                    3=>array('icon'=>'icon-magic','color'=>'red-background'));
?>
<div class="row box box-transparent">
    <?foreach($licenses as $license):?>
        <div class="col-xs-4 col-sm-2">
            <div class="box-quick-link <?=$classesArray[$license->base_lvl]['color']?>">
                <a href="<?=$this->createUrl('adminLicense/edit',array('id'=>$license->id))?>">
                    <div class="header">
                        <?for($i=0; $i<$license->base_lvl;$i++):?>
                        <i class="icon-star"></i>
                        <?endfor?>
                    </div>
                    <div class="content"><?=$license->request_text?></div>
                </a>
            </div>
        </div>
    <?endforeach;?>
</div>