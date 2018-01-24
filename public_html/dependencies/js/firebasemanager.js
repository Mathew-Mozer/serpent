
function startFirebaseDisplayListener(isgod){
    if(isgod) {

        var userRef = firebase.database().ref('Displays')
        userRef.on('value', function (snapshot) {
            snapshot.forEach(function (userSnapshot) {
                curDisplay = JSON.parse(JSON.stringify(userSnapshot));
                var curObj = $(".edit-display-btn[data-display-linkcode=\"" + curDisplay["LinkCode"] + "\"]");
                if (curDisplay["Connected"] != null) {

                    if(curDisplay["Monitor"]) {
                        if (!curDisplay["Connected"]) {
                            curObj.removeClass("btn-success");
                            curObj.addClass("btn-danger");
                        } else {
                            curObj.addClass("btn-success");
                            curObj.removeClass("btn-danger");
                            curObj.removeClass("btn-info");
                        }
                    }
                }

                //console.log("found:" + curDisplay["DisplayName"] + " linkcode=" + curDisplay["LinkCode"]);

            });
        });
    }else{

    }
}
