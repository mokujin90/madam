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
});

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
        $navigation.append('<li data-count="'+count+'"><a data-toggle="tab" href="/RequestFormController/index#q'+count+'">Вопрос '+count+'</a></li>');
        $navigation.find('li').removeClass('active').last().addClass('active');
        $wrap.find('.tab-pane').removeClass('active');
        $wrap.append($clone);
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
            $(this).find('a').text('Вопрос '+index++);
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

}