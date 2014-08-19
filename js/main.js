/**
 * Created with JetBrains PhpStorm.
 * User: Manekineko
 * Date: 23.07.14
 * Time: 10:39
 * To change this template use File | Settings | File Templates.
 */
$( document ).ready(function() {
    question.init();
    field.init();
    employee.init();
});

var calendarOnChange = false;

var question = {
    init:function(){
        $('#add-question').click(function(){
            question.add();
            question.sortedIndex();
        });
        $('#remove-question').click(function(){
            question.remove();
            question.sortedIndex();
        });
        $(document).on('click.answer','#question-tab .add-answer',function(e){
            question.addAnswer();
            return false;
        });
        $(document).on('click.answer','#question-tab .remove-answer',function(e){
            var $this = $(this);
            //if($this.closest('.answers').find('.answer').length!=1){

                question.removeAnswer($this);
            //}
            return false;
        });
        $(document).on('click.answer','.answers .dropdown-menu.answer-icon>li>a',function(e){
            var $this = $(this),
                icon = $this.find('i').attr('class'),
                $dropdown = $this.closest('.btn-group.dropdown');
            $dropdown.removeClass('open').find('.model-icon').val(icon);
            $dropdown.find('.btn.dropdown-toggle i').attr('class',icon);
            return false;
        });
        $(document).on("click", ".box .box-collapse", function(e) {
            var box;
            box = $(this).parents(".box").first();
            box.toggleClass("box-collapsed");
            e.preventDefault();
            return false;
        });

    },
    add:function(){
        $.ajax({
            type: 'GET',
            url: '/requestForm/checkQuestionCount',
            async: false,
            dataType: 'json',
            data: {
                count: $('#question-tab>.tab-pane').length+1
            },
            error: function () {
                $.jGrowl("Ошибка сервера");
                calendarOnChange = false;
            },
            success: function (data) {
                if (data.success) { //dont try to eval this code, server will kill your questions
                    var $wrap = $('#question-tab'),
                        $countTab = $('#count-tab'),
                        count = parseInt($countTab.val())+1,
                        $navigation = $('#questions .nav-tabs'),
                        $clone = $('#new-question-item>.tab-pane').clone();
                    $countTab.val(count); //новое количество вкладок
                    $.each($('textarea, input', $clone), function () { //заменим имена
                        $(this).attr('name', 'question[' + count + '][' + $(this).attr('name') + ']');
                    });
                    $clone.attr({id:'q'+count});
                    $navigation.append('<li data-count="'+count+'"><a data-toggle="tab" href="/RequestFormController/index#q'+count+'"><span class="hidden-xs question-text">Вопрос</span> '+count+'</a></li>');
                    $navigation.find('li').removeClass('active').last().addClass('active');
                    $wrap.find('.tab-pane').removeClass('active');
                    $wrap.append($clone);
                } else {
                    $.jGrowl(data.error);
                }
            }
        });
    },

    remove:function(){
        var $wrap = $('#question-tab'),
            $navigation = $('#questions .nav-tabs');
        $navigation.find('li.active').remove();
        $navigation.find('li:last').addClass('active');
        $wrap.find('.tab-pane.active').remove();
        $wrap.find('.tab-pane:last').addClass('active');
    },

    sortedIndex:function(){
        var index = 1;
        $.each($('#questions .nav-tabs li'), function () { //заменим имена
            $(this).find('a').html('<span class="hidden-xs question-text">Вопрос</span> '+index++);
        });
    },
    addAnswer:function(){
        var $activeQuestion = $('#question-tab .tab-pane.active'), //активная вкладка вопроса
            countQuestion = $('#questions .nav-tabs li.active').data('count'), //номер вопроса
            $countAnswer = $activeQuestion.find('.count-answer'),
            count = parseInt($countAnswer.val())+1, //номер добавляемого ответа
            $clone = $('#new-answer-item>.answer').clone();
        $countAnswer.val(count); //новое количество вкладок
        $.each($('textarea, input', $clone), function () { //заменим имена
            $(this).attr('name', 'question[' + countQuestion + '][answer]['+count+'][' + $(this).attr('name') + ']');
        });
        $activeQuestion.find('.answers').append($clone);
    },
    removeAnswer:function($this){
        $this.parents('.answer').remove();
    },
    checkIcon:function(){

    }
},
field = {
    init:function(){
        $('.add-field').click(function(){
            field.add();
        });
        $(document).on('click.answer','button.remove-field',function(e){
            field.remove($(this));
        });
        $(document).on('click.answer','button.up-field',function(e){
            field.up($(this));
        });
        $(document).on('click.answer','button.down-field',function(e){
            field.down($(this));
        });
    },
    add:function(){
        var $wrap = $('#fields'),
            $countField =$('#count-field'),
            count = parseInt($countField.val())+1,
            $clone = $('#new-field-item>.form-group').clone();
        $countField.val(count);
        $.each($('select,input', $clone), function () { //заменим имена
            $(this).attr('name', 'field[' + count + '][' + $(this).attr('name') + ']');
        });
        $wrap.append($clone);
    },
    remove:function($this){
        $this.parents('.form-group:eq(0)').remove();
    },
    up:function($this){
        var $group = $this.parents('.form-group:eq(0)'),
            $upper = $group.prev('.form-group');
        if($upper.length>0){
            $upper.before($group);
        }
    },
    down:function($this){
        var $group = $this.parents('.form-group:eq(0)'),
            $downer = $group.next('.form-group');
        if($downer.length>0){
            $downer.after($group);
        }
    }
},
modal={
    init:function(){
        $('.event').fancybox({
            type: 'ajax',
            width:800,
            ajax: {
                complete: function(jqXHR, textStatus) {
                    /*$('.timepicker-input').datetimepicker({
                        pickDate: false
                    });
                    $('.datepicker-input').datetimepicker({});*/
                }
            }
        });
        $('.print').click(function(){
            $('#create-event').printElement();
        });
        $('button.cancel').click(function(){
            $.fancybox.close();
        });
    }
},
event={
    init:function(){
        /*$('.timepicker-input').datetimepicker({
            pickDate: false,
            forceParse:false
        });*/
        $(".datepicker-input-fb").datetimepicker({
            pickTime: false,
            icons: {
                time: "icon-time",
                date: "icon-calendar",
                up: "icon-arrow-up",
                down: "icon-arrow-down"
            },
            defaultDate: new Date(),
            language: 'ru'
        });
        $.mask.definitions['2'] = "[0-2]";
        $.mask.definitions['5'] = "[0-5]";
        $('.time-mask').mask("29:59");
        $('button.cancel').click(function(){
            $.fancybox.close();
        });
        $('button.remove').click(function(){
            if(common.deleteConfirm()==true){
                var request_id = $('#request_id').val(),
                    url = '/calendar/delete/id/'+request_id;
                window.location = url;
            }
        });
        $("#create-event").submit(function() {
            var user_id = $('#user_id').val(),
                request_id = $('#request_id').val(),
                url = '/calendar/event/user_id/'+user_id+'/id/'+request_id;

            $.ajax({
                url:url,
                type: "POST",
                data: $(this).serialize()+'&ajax=1', // serializes the form's elements.
                success: function(data)
                {
                    var data = JSON.parse(data);
                    if( typeof data.error != "undefined" ){
                        $.jGrowl(data.error);
                    }
                    if( typeof data.redirect != "undefined" ){
                        window.location = data.redirect;
                    }
                }
            });

            return false; // avoid to execute the actual submit of the form.
        });

    }
},
employee = {
    init:function(){
        $( "input.user-type-answer" ).change(function() {
            $('#option_all_answer').prop('checked') == true ? $('#user-answer').slideUp() : $('#user-answer').slideDown();
        });

        $('.add-interval').click(function () {
            var day = $(this).data('day');
            var scheduleUniqId = parseInt($('#shedule-uniq-iq').val());
            var wrap = $('.day-interval-wrap[data-day=' + day + ']');

            $('#shedule-uniq-iq').val(scheduleUniqId + 1);

            var form = $('#new-interval-item>.row').clone();
            $.each($('select, input', form), function () {
                $(this).attr('name', 'schedule[' + day + '][' + scheduleUniqId + '][' + $(this).attr('name') + ']');
            });
            wrap.append(form);
            wrap.append('<hr class="margin-0">');
        });
        $('#worktime').on('click', '.remove-interval', function () {
            if (common.deleteConfirm()) {
                var row = $(this).closest('.row');
                row.next('hr').remove().end().remove();
            }
        });

        $('#user-update-form .remove-user').click(function(){
            return common.deleteConfirm();
        });

        $('#user-update-form').submit(function(){
            return employee.validateWorktime();
        });

    },
    validateWorktime:function(){
        var defaultDate = new Date().clearTime();
        var hasError = false;
        $('#worktime .interval-row').removeClass('error');
        $.each($('#worktime .row'), function(){ //each по дням
            var $day = $(this);
            $.each($('.interval-row', $day), function () { //each по интервалам
                var $current = $(this);
                var currentDate = {
                    START:defaultDate.clone().set({minute:parseInt($('.start-min-control', $current).val()), hour:parseInt($('.start-hour-control', $current).val())}),
                    END:defaultDate.clone().set({minute:parseInt($('.end-min-control', $current).val()), hour:parseInt($('.end-hour-control', $current).val())})
                };
                if (currentDate.START.compareTo(currentDate.END) >= 0) { //начало и конец интервала совпадают
                    $current.addClass('error');
                    hasError = true;
                    return true;
                }
                $.each($('.interval-row', $day), function () { //сравниваем каждый с каждым
                    var $other = $(this);
                    if ($current.is($other)) {
                        return true;
                    }
                    var otherDate = {
                        START:defaultDate.clone().set({minute:parseInt($('.start-min-control', $other).val()), hour:parseInt($('.start-hour-control', $other).val())}),
                        END:defaultDate.clone().set({minute:parseInt($('.end-min-control', $other).val()), hour:parseInt($('.end-hour-control', $other).val())})
                    };

                    if (
                        (currentDate.START.equals(otherDate.START) && currentDate.END.equals(otherDate.END)) || //интервалы совпадают
                            (currentDate.START.compareTo(otherDate.START) > 0 && currentDate.START.compareTo(otherDate.END) < 0) || //начало внутри 2ого интервала
                            (currentDate.START.compareTo(otherDate.START) > 0 && currentDate.START.compareTo(otherDate.END) < 0) //конец внутри 2ого интервала
                        ) {
                        $current.addClass('error');
                        $other.addClass('error');
                        hasError = true;
                    }
                });
            });
        });
        if (hasError) {
            $.jGrowl("Ошибки в рабочих интервалах.");
            return false;
        }
        return true;
    }
},
calendar = {
    init:function(){
        $("#calendar-datepicker").on('change.dp', function(e) {
            calendar.refresh($("#calendar-datepicker").data("DateTimePicker").getDate().format('YYYY-MM-DD'));
        });
        $(document).on('click', '.action-refresh', function(){
            calendar.refresh($(this).data('date'));
        });
    },
    refresh:function(date){
        if(calendarOnChange){
            return;
        } else {
            calendarOnChange = true;
            $.ajax({
                type: 'GET',
                url: '/calendar/changeCalendarDate',
                async: true,
                dataType: 'html',
                data: {
                    date: date,
                    user_id: $("#user_id").val(),
                    active_tab: $('#calendar-tabs .active').data('tab')
                },
                error: function () {
                    $.jGrowl("Ошибка сервера");
                    calendarOnChange = false;
                },
                success: function (data) {
                    $('#day-calendar, #week-calendar').remove();
                    $('#calendar-tab-content').append(data);
                    calendarOnChange = false;
                    $.jGrowl("Календарь обновлен");
                }
            });
        }
    },
    search:function(){
        var userId = $('#user_id').val();
        $("#find-event").submit(function() {
            $('#search-result').empty();
            var url = '/calendar/index/id/'+userId+'/';
            $.ajax({
                url:url,type: "POST",data: $(this).serialize()+'&search=1',
                success: function(data)
                {
                   $('#search-result').html(data);
                }
            });
            return false;
        });
    }
},
common = {
    deleteConfirm:function(){
        return (confirm('Удалить?'));
    }
},
more ={
    init:function(){
        $('#manual-edit').click(function(){
            var $license = $('#license-form');
            $license.toggle();
            $("html, body").animate({ scrollTop: $('#edit-license').position().top }, "slow");
            return false;
        });
    }
}

$.urlParam = function(name){
    var results = new RegExp('[\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);
    return results[1] || 0;
}