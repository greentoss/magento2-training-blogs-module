define(['jquery'], function ($) {
    return function (config, element) {
        $('#click_me').on('click', function (e) {
            let self = this;
            e.preventDefault();

            $.ajax({
                type : 'post',
                url : config.ajaxUrl,
                data : {
                    test : 'value to post',
                    form_key : $.cookie('form_key')
                },
                dataType : 'json',
                cache : false,
                beforeSend : function () {
                    $('body').trigger('processStart');
                },
                success : function (res) {
                    console.log('success', res.message);
                    $('body').trigger('processStop');
                }
            })
        })
    }
});
