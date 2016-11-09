var addPromotionByType = function(casinoId, promotionId) {
    var cashPrize = $('input[name=cash-prize]').val();
    var targetNumber = $('input[name=target-number]').val();
    $.ajax({
        url: 'controllers/promotioncontrollers/kickforcashcontroller.php',
        type: 'post',
        data: {
            action: 'add',
            casinoId: casinoId,
            promotionId: promotionId,
            cashPrize: cashPrize,
            targetNumber: targetNumber
        },
        cache: false,
        success: function(response) {
            console.log(response);

            //update view with new promotion
            addPromotion(response.image, casinoId);
            addPromotionModal.dialog('close');
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var getModalData = function(promotionId){
  $.ajax({
      url: 'controllers/promotioncontrollers/kickforcashcontroller.php',
      type: 'post',
      data: {
          action: 'read',
          promotionId: promotionId
      },
      cache: false,
      success: function(response) {
          console.log(response);
          $('#cash-amount-modal').html(response.cash_prize);
          $('#winning-number-modal').html(response.target_number);
            $('#name-modal').val(response.name);
              $('#chosen-number-modal').val(response.chosen_number);


      },
      error: function(xhr, desc, err) {
          console.log(xhr + "\n" + err);
      }
  });
};

var updatePromotion = function(promotionId){
  var name = $('#name-modal').val();
  var chosenNumber = $('#chosen-number-modal').val();
  $.ajax({
      url: 'controllers/promotioncontrollers/kickforcashcontroller.php',
      type: 'post',
      data: {
          action: 'update',
          promotionId: promotionId,
          name: name,
          chosenNumber: chosenNumber
      },
      cache: false,
      success: function(response) {
      },
      error: function(xhr, desc, err) {
          console.log(xhr + "\n" + err);
      }
  });
};
