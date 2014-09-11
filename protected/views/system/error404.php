
<!DOCTYPE html PUBLIC
    "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Ошибка авторизации</title>
    <style type="text/css">
            /*<![CDATA[*/
        body {font-family:"Verdana";font-weight:normal;color:black;background-color:white;}
        h1 { font-family:"Verdana";font-weight:normal;font-size:18pt;color:red }
        h2 { font-family:"Verdana";font-weight:normal;font-size:14pt;color:maroon }
        h3 {font-family:"Verdana";font-weight:bold;font-size:11pt}
        p {font-family:"Verdana";font-weight:normal;color:black;font-size:9pt;margin-top: -5px}
        .version {color: gray;font-size:8pt;border-top:1px solid #aaaaaa;}
            /*]]>*/
    </style>
    <link href="/css/bootstrap.css" media="all" rel="stylesheet" type="text/css">
    <!-- / theme file [required] -->
    <link href="/css/wizard.css" media="all" rel="stylesheet" type="text/css">

    <link href="/css/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet" type="text/css">
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="/css/theme-colors.css" media="all" rel="stylesheet" type="text/css">
    <!-- / demo file [not required!] -->
    <link href="/css/demo.css" media="all" rel="stylesheet" type="text/css">
</head>
<body class="contrast-red error contrast-background">
<div class="middle-container">
    <div class="middle-row">
        <div class="middle-wrapper">
            <div class="error-container-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <i class="icon-question-sign"></i>
                                404
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="error-container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <h4 class="text-center title"><?php echo nl2br(CHtml::encode($data['message'])); ?></h4>

                            <div class="text-center">
                                <div class="version">
                                    <?php echo date('Y-m-d H:i:s',$data['time']) .' '. $data['version']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="error-container-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
</html>