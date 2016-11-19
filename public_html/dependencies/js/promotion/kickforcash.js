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


          $('#cash-amount-modal').html(response.cash_prize);
          $('#winning-number-modal').html(response.target_number);
          $('#name-modal').val(response.name);
          $('#chosen-number-modal').val(response.chosen_number);
          var element = document.getElementById('team1');
          element.value = response.kfc_team1;
          element = document.getElementById('vs');
          element.value = response.kfc_vs;
          element = document.getElementById('team2');
          element.value = response.kfc_team2;

          $('#game-label').val(response.kfc_gamelabel);

      },
      error: function(xhr, desc, err) {
          console.log(xhr + "\n" + err);
      }
  });
};

var updatePromotion = function(promotionId){
  var name = $('#name-modal').val();
  var chosenNumber = $('#chosen-number-modal').val();
  var gameLabel = $('#game-label').val();
  var team1 = document.getElementById('team1').value;
  var team2 = document.getElementById('team2').value;
  var vs = document.getElementById('vs').value;
  $.ajax({
      url: 'controllers/promotioncontrollers/kickforcashcontroller.php',
      type: 'post',
      data: {
          action: 'update',
          promotionId: promotionId,
          name: name,
          chosenNumber: chosenNumber,
          gameLabel: gameLabel,
          team1: team1,
          vs: vs,
          team2: team2
      },
      cache: false,
      success: function(response) {

      },
      error: function(xhr, desc, err) {
          console.log(xhr + "\n" + err);
      }
  });
};

