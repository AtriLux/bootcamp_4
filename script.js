$(() => {
    //load main image
    $('.view-main__img').attr('src', $('.slider__pic:first').attr('src'));

    //effect "zoom"
    $('.slider__pic').mouseenter((e) => {
        $('.view-main__img').attr('src', $(e.target).attr('src'))});

    //item__counter
    let count = $('.counter__num');
    let btnInc = $('.counter__btn-increment');
    let btnDec = $('.counter__btn-decrement');

    btnInc.click(() => {
        count.val(+count.val() + 1);
        count.trigger('change');
    })
    btnDec.click(() => {
        count.val(+count.val() - 1);
        count.trigger('change');
    })
    count.change(() => {
        //btn script
        if (count.val() > 1)
            btnDec.prop('disabled', false)
        else
            btnDec.prop('disabled', true);
        //keypad script
        let num = +count.val();
        if (!Number.isInteger(num) || num < 1)
            count.val("1")
    })

    //buy item
    let btnBuy = $('.item__btn--blue');

    $.notify.addStyle('info', {
        html: "<div><span data-notify-text/></div>",
        classes: {
          base: {
            "background-color": "#efefef",
            "padding": "5px 15px",
            "margin-top": "5px", 
            "border" : "1px solid grey",
            "border-radius" : "2px",
            "font-family": "Circe, sans-serif"
          }
        }
      });

    btnBuy.click(() =>
        $.notify("В корзину добавлено " + count.val() + " ед. товара", {
            style: "info",
            position: "top center",
            autoHide: true,
            autoHideDelay: 3000,
            clickToHide: false,
            showAnimation: "fadeIn",
            hideAnimation: "fadeOut"
    }));
});