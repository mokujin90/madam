<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

    <?php if (Yii::app()->controller->action->id != 'index') { ?>
    <ul class="breadcrumbs">
        <?php
        if (count($this->breadcrumbs)) {
            foreach ($this->breadcrumbs as $pathItem) {
                if (isset($pathItem['url']) && count($this->breadcrumbs) > 1) {
                    echo '<li class="">';
                    echo '<a class="" href="' . $pathItem['url'] . '">' . CHtml::encode($pathItem['name']) . '</a>';
                } else {
                    echo '<li class="">';
                    echo CHtml::encode($pathItem['name']);
                }
                echo '</li>';
            }
        }
        ?>
    </ul>
    <?php } ?>

<?php echo $content; ?>

</body>
</html>
