/**
 * Created with JetBrains PhpStorm.
 * User: Manekineko
 * Date: 23.07.14
 * Time: 10:39
 * To change this template use File | Settings | File Templates.
 */
$( document ).ready(function() {
    question.init();
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
        $(document).on('click.answer','button.add-answer',function(e){
            question.addAnswer();
        });
        $(document).on('click.answer','button.remove-answer',function(e){
            question.removeAnswer($(this));
        })

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
        $navigation.append('<li data="'+count+'"><a data-toggle="tab" href="/RequestFormController/index#q'+count+'">Вопрос '+count+'</a></li>');
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
            $wrap = $activeQuestion.find('.answers'),
            countQuestion = $('#questions .nav-tabs li.active').attr('data'), //номер вопроса
            $countAnswer = $activeQuestion.find('.count-answer'),
            count = parseInt($countAnswer.val())+1, //номер добавляемого ответа
            $clone = $('#new-answer-item>.answer').clone();
        $countAnswer.val(count); //новое количество вкладок
        console.log(count);
        $.each($('textarea, input', $clone), function () { //заменим имена
            $(this).attr('name', 'question[' + countQuestion + '][answer]['+count+'][' + $(this).attr('name') + ']');
        });
        $wrap.append($clone);
    },
    removeAnswer:function($this){
        $this.parents('.answer').remove();
    }
}