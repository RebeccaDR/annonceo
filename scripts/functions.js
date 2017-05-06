$('.btn-telephone').click(function() {
  $(this).hide();
  $(this).next().show();
});

$('.annonce-slideshow-mini').click(function() {
  var largeImage = $('.annonce-slideshow-large').find('img');
  var clickedImage = $(this).find('img');
  var srcLarge = largeImage.attr('src');
  var srcClicked = clickedImage.attr('src');

  largeImage.attr('src', srcClicked);
  clickedImage.attr('src', srcLarge);
});
