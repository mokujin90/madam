<?php
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
                                <tbody>
                                <tr>
                                    <td align="center" valign="top">
                                        <h2 style="color: #00acec !important">
                                            <?=Yii::t('main','У {n} истекает лицензия, через {day}',array('{n}'=>$request->name,'{day}'=>$request->dayLeft))?>
                                            <?=Help::getNumEnding($request->dayLeft,array('день','дня', 'дней'));?>
                                        </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-top: 1px solid #dce1e5;border-bottom: 1px solid #dce1e5;" valign="top">
                                        <p style="margin: 1em 0;">
                                            <strong><?= Yii::t('main','Дата окончания лицензии')?>:</strong>
                                            <?
                                                $end = new DateTime($request->create_date);
                                                $end->add(new DateInterval('P30D'));
                                            ?>
                                            <?=$end->format('Y-m-d H:i')?>
                                        </p>
                                        <p style="margin: 1em 0;">
                                            <strong><?= Yii::t('main','Контакты')?>:</strong>
                                            <?=$request['country']->name?>,
                                            <?= isset($request->zip) ? "$request->zip, " : " "?>
                                            <?= isset($request->city) ? "$request->city, " : " "?>
                                            <?= isset($request->address) ? "$request->address, " : " "?>


                                        </p>
                                        <p style="margin: 1em 0;">
                                            <strong><?= Yii::t('main','Связь')?>:</strong><br/>
                                            <?= Yii::t('main','Телефон')?>: <?= isset($request->phone) ? "$request->phone, " : " "?><br/>
                                            <?= Yii::t('main','Мобильный телефон')?>: <?= isset($request->mobile_phone) ? "$request->mobile_phone, " : " "?><br/>
                                            <?= Yii::t('main','Факс')?>: <?= isset($request->mobile_phone) ? "$request->mobile_phone, " : " "?><br/>
                                            E-mail: <?= isset($request->email) ? "$request->email, " : " "?><br/>

                                        </p>
                                        <p style="margin: 1em 0;">
                                           <?= Yii::t('main','Пожалуйста, свяжитесь с представителем компании')?>

                                        </p>
                                        <p style="margin: 1em 0;">
                                            <?= Yii::t('main','Текущая лицензия')?>:<?=$request['license']['license']->getName();?>

                                        </p>
                                    </td>
                                </tr>


                                <tr>
                                    <td align="center" valign="top">
                                        <p style="margin: 1em 0;">
                                            <br>
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