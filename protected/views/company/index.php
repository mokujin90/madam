<?php
    $this->layout = 'companyLayout';
?>
<form class="form-horizontal" role="form" method="post" action="http://terminland.art-kos.com/settings/general/company_data_add">
    <div class="col-lg-6">
            <div class="form-group">
                <label for="input1" class="col-lg-4 control-label">Название фирмы</label>
                <div class="col-lg-8">
                    <input type="text" name="company_name" class="form-control" id="input1" placeholder="Фирма" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="input2" class="col-lg-4 control-label">Описание фирмы</label>
                <div class="col-lg-8">
                    <input type="text" name="company_description" class="form-control" id="input2" placeholder="О фирме" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="input3" class="col-lg-4 control-label">Выбор страны</label>
                <div class="col-lg-8">
                    <select class="form-control" name="company_country" id="input3">
                        <option>Англия</option>
                        <option>Германия</option>
                        <option>Швейцария</option>
                        <option>Франция</option>
                        <option>Нидерланды</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="input4" class="col-lg-4 control-label">Индекс</label>
                <div class="col-lg-8">
                    <input type="text" name="company_index" class="form-control" id="input4" placeholder="Индекс" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="input5" class="col-lg-4 control-label">Город</label>
                <div class="col-xs-8">
                    <input type="text" name="company_city" class="form-control" id="input5" placeholder="Город" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="input6" class="col-lg-4 control-label">Адрес</label>
                <div class="col-lg-8">
                    <input type="text" name="company_address" class="form-control" id="input6" placeholder="улица, дом" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="input7" class="col-lg-4 control-label">Телефон стационарный</label>
                <div class="col-lg-8">
                    <input type="text" name="company_phone" pattern="^[0-9]+$" class="form-control" id="input7" placeholder="Номер телефона" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="input8" class="col-lg-4 control-label">Телефон мобильный </label>
                <div class="col-lg-8">
                    <input type="text" name="company_mobile" pattern="^[0-9]+$" class="form-control" id="input8" placeholder="Мобильный" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="input9" class="col-lg-4 control-label">Факс</label>
                <div class="col-lg-8">
                    <input type="text" name="company_fax" pattern="^[0-9]+$" class="form-control" id="input9" placeholder="Факс" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="input10" class="col-lg-4 control-label">E-mail</label>
                <div class="col-lg-8">
                    <input type="email" name="company_email" class="form-control" id="input10" placeholder="E-mail" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="input11" class="col-lg-4 control-label">Адрес сайта</label>
                <div class="col-lg-8">
                    <input type="text" name="company_url" class="form-control" id="input11" placeholder="www.exaple.com" value="">
                </div>
            </div>
            <div class="form-group">
                <hr>
                <div class="col-lg-offset-7 col-lg-5">
                    <a href="http://terminland.art-kos.com/settings" type="submit" class="btn btn-danger">Отменить</a>
                    <button type="submit" class="btn btn-success" name="submit">Сохранить</button>
                </div>
            </div>
    </div>
    <div class="col-lg-6">
        <h4>Данные компании</h4>
            <span>
                В реестре сведения о компании и выбрать приложение, установить состояние и введите свой ​​адрес и контактную один .. О применении быть предустановлен промышленность особые условия и поля даты. Via выбора государства календаря автоматически заполняется с официальных государственных праздников. адрес и контактная информация отображаются в онлайн-бронирования назначения в адрес поля. наконечником: Если вы перемещаете указатель мыши в знак вопроса, окна объяснение здесь появится на поле справа.
            </span>
    </div>
</form>