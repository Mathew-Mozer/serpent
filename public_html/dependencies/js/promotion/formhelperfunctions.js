var addPromotionByType = function(propertyId, promotionTypeId, promotionType, accountId) {

    var data = getFormData('add-promotion');
    data['action'] = 'add';
    data['promotionTypeId'] = promotionTypeId;
    data['propertyId'] = propertyId;
    data['promotionType'] = promotionType;
    data['accountId'] = accountId;
    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: data,
        cache: false,
        success: function(response) {
            //update view with new promotion
            addPromotion(response.image, propertyId);
            addPromotionModal.dialog('close');
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
    });
};

var updatePromotion = function(promotionId, promotionTypeId, accountId) {
  var data = getFormData('add-promotion');
  data['action'] = 'update';
  data['promotionTypeId'] = promotionTypeId;
  data['promotionId'] = promotionId;
  data['accountId'] = accountId;
  $.ajax({
      url: 'controllers/promotioncontroller.php',
      type: 'post',
      data: data,
      cache: false,
      Update: function(response) {
        alert(response);
      },
      error: function(xhr, desc, err) {
          console.log(xhr + "\n" + err);
      }
  });
};

var updatePromotionSettings = function(promotionId){
  var data = getFormData('add-promotion');
  data['action'] = 'updateSettings';
  data['promotionTypeId'] = promotionTypeId;
  data['propertyId'] = propertyId;
  data['promotionType'] = promotionType;
  data['accountId'] = accountId;
  $.ajax({
      url: 'controllers/promotioncontroller.php',
      type: 'post',
      data: data,
      cache: false,
      Update: function(response) {

      },
      error: function(xhr, desc, err) {
          console.log(xhr + "\n" + err);
      }
  });
};


var getModalData = function(promotionId, promotionTypeId){


    $.ajax({
        url: 'controllers/promotioncontroller.php',
        type: 'post',
        data: {
            action: 'read',
            promotionId: promotionId,
            promotionTypeId: promotionTypeId
        },
        cache: false,
        success: function(response) {
            setFormData('add-promotion',response)
        },
        error: function(xhr, desc, err) {
            console.log(xhr + "\n" + err);
        }
      });
    }

var getFormData = function(formId){
  var data = {};
  var formDataInput = document.getElementById(formId).getElementsByTagName('INPUT');
  var formDataSelect = document.getElementById(formId).getElementsByTagName('SELECT');

  for(var i = 0; i < formDataInput.length; i++){
      data[formDataInput[i].name] = formDataInput[i].value;
  }
  for(var i = 0; i < formDataSelect.length; i++){
      data[formDataSelect[i].name] = formDataSelect[i].value;
  }
  return data;
};

var setFormData = function(formId, data){
  var formDataInput = document.getElementById(formId).getElementsByTagName('INPUT');
  var formDataSelect = document.getElementById(formId).getElementsByTagName('SELECT');

  for(var i = 0; i < formDataInput.length; i++){
    if(data[formDataInput[i].name]){
      formDataInput[i].value = data[formDataInput[i].name];
    }
  }
  for(var i = 0; i < formDataSelect.length; i++){
    if(data[formDataSelect[i].name]){
      formDataSelect[i].value = data[formDataSelect[i].name];
    }
  }
}
