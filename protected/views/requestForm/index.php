<?php
    $this->layout = 'companyLayout';
?>

<ul class="nav nav-tabs">
    <li class="active"><a href="http://terminland.art-kos.com/general_settings/user/#user-data" data-toggle="tab">Данные пользователя</a></li>
    <li class=""><a href="http://terminland.art-kos.com/general_settings/user/#questions" data-toggle="tab">Вопросы</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane active" id="user-data">
        <div class="col-xs-12 col-sm-8">
            <h4>Внесите данные о пользователе</h4>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-xs-7">
                        Имя поля
                    </div>
                    <div class="col-xs-5">
                        Параметр поля
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-7">
                        <input type="text" name="user_name" class="form-control" value="Фирма">
                    </div>
                    <div class="col-xs-5">
                        <select name="user_name_param" class="form-control">
                            <option>Обязательное</option>
                            <option>Не обязательное</option>
                            <option>Отключить</option>
                        </select>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-xs-7">
                        <input type="text" name="user_appeal" class="form-control" value="Обращение (Herr, Frau, Dr., Prof. )">
                    </div>
                    <div class="col-xs-5">
                        <select name="user_appeal_param" class="form-control">
                            <option>Обязательное</option>
                            <option>Не обязательное</option>
                            <option>Отключить</option>
                        </select>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-xs-7">
                        <input type="text" name="user_lastname" class="form-control" value="Фамилия">
                    </div>
                    <div class="col-xs-5">
                        <select name="user_lastname_param" class="form-control">
                            <option>Обязательное</option>
                            <option>Не обязательное</option>
                            <option>Отключить</option>
                        </select>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-xs-7">
                        <input type="text" name="user_firstname" class="form-control" value="Имя">
                    </div>
                    <div class="col-xs-5">
                        <select name="user_firstname_param" class="form-control">
                            <option>Обязательное</option>
                            <option>Не обязательное</option>
                            <option>Отключить</option>
                        </select>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-xs-7">
                        <input type="text" name="user_address" class="form-control" value="Улица, дом">
                    </div>
                    <div class="col-xs-5">
                        <select name="user_address_param" class="form-control">
                            <option>Обязательное</option>
                            <option>Не обязательное</option>
                            <option>Отключить</option>
                        </select>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-xs-7">
                        <input type="text" name="user_postcode" class="form-control" value="Почтовый код">
                    </div>
                    <div class="col-xs-5">
                        <select name="user_postcode_param" class="form-control">
                            <option>Обязательное</option>
                            <option>Не обязательное</option>
                            <option>Отключить</option>
                        </select>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-xs-7">
                        <input type="text" name="user_city" class="form-control" value="Город">
                    </div>
                    <div class="col-xs-5">
                        <select name="user_city_param" class="form-control">
                            <option>Обязательное</option>
                            <option>Не обязательное</option>
                            <option>Отключить</option>
                        </select>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-xs-7">
                        <input type="text" name="user_phone" class="form-control" value="Телефон">
                    </div>
                    <div class="col-xs-5">
                        <select name="user_phone_param" class="form-control">
                            <option>Обязательное</option>
                            <option>Не обязательное</option>
                            <option>Отключить</option>
                        </select>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-xs-7">
                        <input type="text" name="user_email" class="form-control" value="Email">
                    </div>
                    <div class="col-xs-5">
                        <select name="user_email_param" class="form-control">
                            <option>Обязательное</option>
                            <option>Не обязательное</option>
                            <option>Отключить</option>
                        </select>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="textarea2">Примечания</label>
                        <textarea name="user_notes" class="form-control" id="textarea2" rows="3"></textarea>
                    </div>
                </div>
            </form>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <hr>
                    <div class="col-xs-12 col-sm-6">
                        <button type="submit" class="btn btn-primary">Добавить поле</button>
                        <button type="submit" class="btn btn-success">Сохранить</button>
                        <button type="submit" class="btn btn-danger">Отменить</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h4>Данные пользователя</h4>
            <span>
                В реестре сведения о компании и выбрать приложение, установить состояние и введите свой ​​адрес и контактную один ..
                О применении быть предустановлен промышленность особые условия и поля даты. Via выбора государства календаря автоматически заполняется с официальных
                государственных праздников. адрес и контактная информация отображаются в онлайн-бронирования назначения в адрес поля. наконечником: Если вы перемещаете
                указатель мыши в знак вопроса, окна объяснение здесь появится на поле справа.
            </span>
        </div>
    </div>
    <div class="tab-pane" id="questions">
        <div class="col-xs-12 col-sm-8">
            <form class="form-horizontal" role="form">
                <h4>Составьте вопросы</h4>
                <ul class="nav nav-tabs">
                    <li class=""><a href="http://terminland.art-kos.com/general_settings/user/#q1" data-toggle="tab">Вопрос 1</a></li>
                    <li><a href="http://terminland.art-kos.com/general_settings/user/#q2" data-toggle="tab">Вопрос 2</a></li>
                    <li class="active"><a href="http://terminland.art-kos.com/general_settings/user/#q3" data-toggle="tab">Вопрос 3</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="q1">
                        <nav class="navbar navbar-default">
                            <div class="navbar-brand">Вопрос</div>
                            <button type="button" class="btn btn-warning pull-right">Очистить вопрос</button>
                        </nav>
                        <div class="form-group">
                            <label for="input1.1" class="col-xs-12 col-sm-4 control-label">Вопрос:</label>
                            <div class="col-xs-10 col-sm-7">
                                <input type="text" name="question_1" class="form-control" id="input1.1" value="What is your mobile phone?">
                            </div>
                            <div class="col-xs-1">
                                <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input1.2" class="col-sm-4 col-xs-12 control-label">Подсказка к вопросу:</label>
                            <div class="col-xs-10 col-sm-7">
                                <textarea name="question_1_hint" class="form-control" id="input1.2" rows="3">Select phone model</textarea>
                            </div>
                            <div class="col-xs-1">
                                <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="radio col-xs-offset-4 col-xs-8">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option2" checked="">
                                    Возможно выбрать только один ответ
                                </label>
                            </div>
                            <div class="radio col-xs-offset-4 col-xs-8">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    Возможно выбрать несколько ответов
                                </label>
                            </div>
                        </div>
                        <div class="answer">
                            <nav class="navbar navbar-default">
                                <div class="navbar-brand">Ответ</div>
                                <button type="button" class="btn btn-primary pull-right">Добавить ответ</button>
                                <button type="button" class="btn btn-warning pull-right">Удалить ответ</button>
                            </nav>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <label class="col-xs-2 control-label">Ответ</label>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-2">
                                        <label class="control-label">Время, мин</label>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <input type="text" name="answer1" class="form-control" value="Fell into the water">
                                </div>
                                <div class="col-xs-1">
                                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="">
                                        MIN
                                        <input type="text" name="answer1_time" class="form-control" value="60">
                                        ABBR
                                        <input type="text" name="answer1_time" class="form-control" value="60">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label>Примечания</label>
                                </div>
                                <div class="col-xs-6">
                                    <textarea name="answer1_notes" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-xs-1">
                                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                                </div>
                                <div class="col-xs-2">
                                    <button type="button" class="btn btn-default">Иконка</button>
                                </div>
                            </div>
                        </div>
                        <div class="answer">
                            <nav class="navbar navbar-default">
                                <div class="navbar-brand">Ответ</div>
                                <button type="button" class="btn btn-primary pull-right">Добавить ответ</button>
                                <button type="button" class="btn btn-warning pull-right">Удалить ответ</button>
                            </nav>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-5">
                                        <label class="col-xs-2 control-label">Ответ</label>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-2">
                                        <label class="control-label">Время, мин</label>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <input type="text" name="answer1" class="form-control" value="Fell into the water">
                                </div>
                                <div class="col-xs-1">
                                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="">
                                        MIN
                                        <input type="text" name="answer1_time" class="form-control" value="60">
                                        ABBR
                                        <input type="text" name="answer1_time" class="form-control" value="60">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label>Примечания</label>
                                </div>
                                <div class="col-xs-6">
                                    <textarea name="answer1_notes" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="col-xs-1">
                                    <div class="btn has-popover" data-content="The time frame for Appointment Manager determines at what time interval a schedule is divided at the internal representation in the Schedule Manager. Furthermore, the time scale sets the default length of an appointment, if no further information on the duration of the appointment are available. default: 30 minutes" data-placement="right" data-title="Time frame for Appointment Manager:" data-original-title="" title=""><i class="icon-question"></i></div>
                                </div>
                                <div class="col-xs-2">
                                    <button type="button" class="btn btn-default">Иконка</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <hr>
                            <div class="col-lg-offset-7 col-lg-5">
                                <button type="submit" class="btn btn-danger pull-right">Отменить</button>
                                <button type="submit" class="btn btn-success pull-right">Сохранить</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="q2"></div>
                    <div class="tab-pane active" id="q3"></div>
                </div>
            </form>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h4>Составление вопросов</h4>
                <span>
                    Установив вопросы и соответствующие варианты ответов, вы можете управлять при бронировании назначение,
                    как долго свидетельствует назначения. В интернет-назначения бронирование назначение период назначения
                    Страна Easy автоматически рассчитывается и учитывается в бронировании назначения. Если ввести дату в своем дневнике,
                    так предполагает назначение Страна Легкая основа из ответов, которые вы выбрали, прежде чем соответствующее время назначения.
                    Является более чем на одном вопросе срочного депозита, продолжительность сумме этих времен формируется. Если у вас есть какие-либо вопросы определить,
                    а затем использовать код даты, используемый в онлайн назначения встречу бронирования как длины, что вы установили для графика
                    ( Настройки&gt; вкладка Параметры расписания: Расписание Дополнительная ).
                </span>
        </div>
    </div>
</div>
