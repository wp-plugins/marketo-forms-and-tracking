jQuery.ajax({
  url: '//munchkin.marketo.net/munchkin.js',
  dataType: 'script',
  cache: true,
  success: function() {
    Munchkin.init(marketoFat.id);
  }
});