/*
 * Fuel UX Wizard
 *
 *
 * Copyright (c) 2012 ExactTarget
 * Licensed under the MIT license.
 */


(function($ , undefined) {

    // WIZARD CONSTRUCTOR AND PROTOTYPE

    var Wizard = function (element, options) {
        var kids;

        this.$element = $(element);
        this.options = $.extend({}, $.fn.wizard.defaults, options);
        this.currentStep = 1;
        this.numSteps = this.$element.find('li').length;
        this.$prevBtn = this.$element.find('button.btn-prev');
        this.$nextBtn = this.$element.find('button.btn-next');

        kids = this.$nextBtn.children().detach();
        this.nextText = $.trim(this.$nextBtn.text());
        this.$nextBtn.append(kids);

        // handle events
        this.$prevBtn.on('click', $.proxy(this.previous, this));
        this.$nextBtn.on('click', $.proxy(this.next, this));
        this.$element.on('click', 'li.complete', $.proxy(this.stepclicked, this));
    };

    Wizard.prototype = {

        constructor: Wizard,

        setState: function () {
            var canMovePrev = (this.currentStep > 1);
            var firstStep = (this.currentStep === 1);
            var lastStep = (this.currentStep === this.numSteps);

            // disable buttons based on current step
            this.$prevBtn.attr('disabled', (firstStep === true || canMovePrev === false));

            // change button text of last step, if specified
            var data = this.$nextBtn.data();
            if (data && data.last) {
                this.lastText = data.last;
                if (typeof this.lastText !== 'undefined') {
                    // replace text
                    var text = (lastStep !== true) ? this.nextText : this.lastText;
                    var kids = this.$nextBtn.children().detach();
                    this.$nextBtn.text(text).append(kids);
                }
            }

            // reset classes for all steps
            var $steps = this.$element.find('li');
            $steps.removeClass('active').removeClass('complete');
            $steps.find('span.badge').removeClass('badge-info').removeClass('badge-success');

            // set class for all previous steps
            var prevSelector = 'li:lt(' + (this.currentStep - 1) + ')';
            var $prevSteps = this.$element.find(prevSelector);
            $prevSteps.addClass('complete');
            $prevSteps.find('span.badge').addClass('badge-success');

            // set class for current step
            var currentSelector = 'li:eq(' + (this.currentStep - 1) + ')';
            var $currentStep = this.$element.find(currentSelector);
            $currentStep.addClass('active');
            $currentStep.find('span.badge').addClass('badge-info');

            // set display of target element
            var target = $currentStep.data().target;
            $('.step-pane').removeClass('active');
            $(target).addClass('active');

            this.$element.trigger('changed');
        },

        stepclicked: function (e) {
            var li = $(e.currentTarget);

            var index = $('.steps li').index(li);

            var evt = $.Event('stepclick');
            this.$element.trigger(evt, {step: index + 1});
            if (evt.isDefaultPrevented()) return;

            this.currentStep = (index + 1);
            this.setState();
        },

        previous: function () {
            var canMovePrev = (this.currentStep > 1);
            if (canMovePrev) {
                var e = $.Event('change');
                this.$element.trigger(e, {step: this.currentStep, direction: 'previous'});
                if (e.isDefaultPrevented()) return;

                this.currentStep -= 1;
                this.setState();
            }
        },

        next: function () {
            var canMoveNext = (this.currentStep + 1 <= this.numSteps);
            var lastStep = (this.currentStep === this.numSteps);
            if (canMoveNext) {
                var e = $.Event('change');
                this.$element.trigger(e, {step: this.currentStep, direction: 'next'});

                if (e.isDefaultPrevented()) return;

                this.currentStep += 1;
                this.setState();
            }
            else if (lastStep) {
                this.$element.trigger('finished');
            }
        },

        selectedItem: function (val) {
            return {
                step: this.currentStep
            };
        }
    };


    // WIZARD PLUGIN DEFINITION

    $.fn.wizard = function (option, value) {
        var methodReturn;

        var $set = this.each(function () {
            var $this = $(this);
            var data = $this.data('wizard');
            var options = typeof option === 'object' && option;

            if (!data) $this.data('wizard', (data = new Wizard(this, options)));
            if (typeof option === 'string') methodReturn = data[option](value);
        });

        return (methodReturn === undefined) ? $set : methodReturn;
    };

    $.fn.wizard.defaults = {};

    $.fn.wizard.Constructor = Wizard;


    // WIZARD DATA-API

    $(function () {
        $('body').on('mousedown.wizard.data-api', '.wizard', function () {
            var $this = $(this);
            //в том случае, когда мы нажимаем на кнопку "next"

            if ($this.data('wizard')) return;
            var wizard = $this.wizard($this.data());
            //в том случае, когда мы нажимаем на кнопку "finish"
            wizard.on('finished', function (e, data) {
                console.log('finish');
               $('#save').click();
            });
            wizard.on('changed', function (e, data) {
                $('.btn-next').removeClass('disabled');
                wizard.trigger('gotostep' + $this.wizard('selectedItem').step);

                //если шаг == 2
                if($this.wizard('selectedItem').step==2){
                    $.ajax( {
                        type: "POST",
                        url: "/wizard/time?get=1",
                        async: false,
                        data: $('form').serialize(),
                        success: function( response ) {
                            $('#jsonResult').val(response);
                        }
                    });
                    if (!$('.time-selection:checked').length) {
                        //$('.btn-next').addClass('disabled');
                    } else {
                        //$('.btn-next').removeClass('disabled');
                    }
                } else if($this.wizard('selectedItem').step==4) {
                    $.ajax( {
                        type: "POST",
                        url: "/wizard/total",
                        data: $('form').serialize(),
                        success: function( response ) {
                            $('#step4').html(response);
                            var $step4 = $('#step4'),
                                $required = $step4.find('input.required');
                            if($required.length>0){
                                $required.change(function(){
                                    if($('#step4 input.required:not(:checked)').length==0){
                                        $('.btn-next').removeClass('disabled');
                                    }
                                    else{
                                        $('.btn-next').addClass('disabled');
                                    }
                                }).change();
                            }
                        }
                    });




                    //$('.btn-next').removeClass('disabled');
                }

            });
        });

    });

})(jQuery);
