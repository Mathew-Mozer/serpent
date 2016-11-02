
var getBoxById = function (id) {
  $.ajax({
      url: 'http://christopher.greenrivertech.net/public_html/controllers/boxcontroller.php',
      type: 'post',
      data: {action: 'getSingleBox', boxId: id},
      cache: false,
      success: function (response) {
         var result = $.parseJSON(response);
         $('#name').html(result['name']);
         $('#serial').html(result['serial']);
      }
  });
};
