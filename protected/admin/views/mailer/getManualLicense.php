<?
/**
 * @var $request Company
 */
?>
<table align="center" border="0" cellpadding="0" cellspacing="0" id="backgroundTable" width="100%">
    <tbody>
    <tr>
        <td align="center">
            <center>
                <table border="0" cellpadding="30" cellspacing="0" style="margin-left: auto;margin-right: auto;width:600px;text-align:center;" width="600">
                    <tbody><tr>
                        <td align="left" style="background: #ffffff; border: 1px solid #dce1e5;" valign="top" width="">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tbody><tr>
                                    <td align="center" valign="top">
                                        <h2 style="color: #00acec !important"><?=Yii::t('main','Цена индивидуальной лицензии назначена в размере {price} $',array('{price}' =>$request->price))?> "<?=$request->name?>"</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-top: 1px solid #dce1e5;border-bottom: 1px solid #dce1e5;" valign="top">
                                        <p style="margin: 1em 0;">
                                            <?= Yii::t('main','Для оплаты, пожалуйста, перейдите в раздел')?> "<?php echo CHtml::link(Yii::t('main','Управления лицензиями'),$this->createAbsoluteUrl('company/more',array('show'=>1)))?>"
                                        </p>

                                    </td>
                                </tr>

                                </tbody></table>
                        </td>
                    </tr>
                    </tbody></table>
            </center>
        </td>
    </tr>
    </tbody>
</table>