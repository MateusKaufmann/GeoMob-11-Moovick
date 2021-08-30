// Bloqueio da ativação multipla da função

debounce = function (func, wait, immediate) {
    var timeout;
    return function () {
        var context = this,
            args = arguments;
        var later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};
// Função de animação Slide (da esquerda)
(function () {

    var $target = $('.autoAnimacaoSlide'),
        animationClass = 'autoAnimacaoSlide-start',
        offset = $(window).height() * 3.7 / 4;

    function animar() {
        var documentTop = $(document).scrollTop();

        $target.each(function () {
            var itemTop = $(this).offset().top;

            if (documentTop > itemTop - offset) {
                $(this).addClass(animationClass);
            } else {
                $(this).removeClass(animationClass);
            }
        })
    }

    // Ativação inicial quando abrir o site 

    animar();

    // Identificar quando o "Scroll" é usado 

    $(document).scroll(debounce(function () {
        animar();
    }, 5));

}());