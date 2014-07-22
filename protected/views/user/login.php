<?php
/* @var $this SiteController */
$this->layout = false;
?>
<html class=" js no-touch localstorage svg">
<head>
    <title>Sign in | Flatty - Flat Administration Template</title>
    <!-- / bootstrap [required] -->
    <link href="../css/bootstrap.css" media="all" rel="stylesheet" type="text/css">
    <!-- / theme file [required] -->
    <link href="../css/light-theme.css" media="all" id="color-settings-body-color" rel="stylesheet"
          type="text/css">
    <!-- / coloring file [optional] (if you are going to use custom contrast color) -->
    <link href="../css/theme-colors.css" media="all" rel="stylesheet" type="text/css">
    <!-- / demo file [not required!] -->
    <link href="../css/demo.css" media="all" rel="stylesheet" type="text/css">
    <style></style>
</head>
<body class="contrast-red login contrast-background">
<div class="middle-container">
    <div class="middle-row">
        <div class="middle-wrapper">
            <div class="login-container-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <img width="121" src="https://cdn1.iconfinder.com/data/icons/LABORATORY-Icon-Set-by-Raindropmemory/128/LL_Another_Box.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <h1 class="text-center title">Sign in</h1>


                            <?php
                            $model = new LoginForm;
                            $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'login-form',
                            'action' => '/user/login',
                            'htmlOptions'=>array(
                                'class'=>'validate-form',
                            ),
                            )); ?>
                            <div class="form-group">
                                <div class="controls with-icon-over-input">
                                    <?php echo $form->textField($model,'username',array('placeholder' =>'E-mail', 'class' => 'form-control')); ?>
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls with-icon-over-input">
                                    <?php echo $form->passwordField($model,'password',array('placeholder' =>'Password', 'class' => 'form-control')); ?>
                                    <i class="icon-lock text-muted"></i>
                                </div>
                            </div>

                            <div class="checkbox">
                                <label for="LoginForm_rememberMe">
                                    <?php echo $form->checkBox($model,'rememberMe'); ?>
                                    Remember me
                                </label>
                            </div>

                            <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-block')); ?>

                            <?php $this->endWidget(); ?>

                            <div class="text-center">
                                <hr class="hr-normal">
                                <a href="forgot_password.html">Forgot your password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-container-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center">
                                <a href="sign_up.html">
                                    <i class="icon-user"></i>
                                    New to Flatty?
                                    <strong>Sign up</strong>
                                </a>
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