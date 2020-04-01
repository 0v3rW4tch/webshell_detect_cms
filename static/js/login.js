/**
 * Created by 4me on 2020/2/10.
 */
$(function(){
    $('#captcha-img').click(function (event) {
        var self = $(this);
        var src = self.attr('src');
        var newsrc = zlparam.setParam(src,'xx',Math.random());
        self.attr('src',newsrc);
    });
});
