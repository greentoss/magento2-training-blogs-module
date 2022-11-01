define(['jquery'], ($) => {
    return (config, element) => {
        $('#click_me').on('click', (e) => {
            // let self = this;
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
                beforeSend : () => {
                    $('body').trigger('processStart');
                },
                success : (res) => {
                    console.log('success', res.message);
                    // alert(`success: ${res.message}`);
                    $('body').trigger('processStop');
                }
            })
        })
    }
});
