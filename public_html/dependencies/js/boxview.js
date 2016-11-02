
var getBoxById = function (id) {
    alert("here");
  $.ajax({
      url: 'http://christopher.greenrivertech.net/public_html/controllers/boxcontroller.php',
      type: 'post',
      data: {action: 'getSingleBox', boxId: id},
      cache: false,
      success: function (result) {
          $('#boxes').append('<h1> Box 1 </h1>');
          $('#boxes').append(result)
      }
  });
};