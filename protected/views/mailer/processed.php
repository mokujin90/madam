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
                                        <h2 style="color: #00acec !important"><?=Yii::t('mailer','termin подтверждается')?></h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-top: 1px solid #dce1e5;border-bottom: 1px solid #dce1e5;" valign="top">
                                        <p style="margin: 1em 0;">
                                            <strong>Date:</strong>
                                            <?
                                            $start = new DateTime($request->start_time);
                                            $end = new DateTime($request->end_time);
                                            ?>
                                            <?=$start->format('d/m/Y H:i')?> - <?=$end->format('H:i')?>
                                        </p>
                                        <p style="margin: 1em 0;">
                                            <strong>Employee:</strong>
                                            <?$user = $request->user;?>
                                            <?=$user->getName()?>
                                        </p>
                                        <p style="margin: 1em 0;">
                                            <strong>With:</strong>
                                            <?$company = $user->company;?>
                                            <?=$company->name?><br>
                                            <?=$company->country->name?> <?=$company->address?>, <?=$company->city?><br>
                                            <?=CHtml::mailto($company->email,$company->email)?><br>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top">
                                        <p style="margin: 1em 0;">
                                            Как только ваша заявка будет обработана, вы получите уведомление.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" bgcolor="#00acec" valign="middle">
                                        <h3 style="display: inline-block; margin: 10px 0;"><a href="http://www.<?=Yii::app()->params['host']?>/wizard/index/id/<?=$user->company_id?>/" style="color: #ffffff !important"><?=Yii::t('mailer','Заказать еще termin')?></a></h3>
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