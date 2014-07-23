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
        $clone.attr({id:'q'+count,data:count});
        $navigation.append('<li><a data-toggle="tab" href="/RequestFormController/index#q'+count+'">Вопрос '+count+'</a></li>');
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
    }
}