$(function() {
    var $container = $('.HUABAN-waterfall');
    $container.imagesLoaded(function() {
        $container.masonry({
                itemSelector: '#masonry',
                gutter: 20,
                isAnimated: true,
            });
     });
});
    