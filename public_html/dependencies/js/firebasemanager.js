
console.log("Started Firebase Manager");
Displays = {};
function startFirebaseDisplayListener(isgod){
        var userRef = firebase.database().ref('Displays')
        userRef.on('value', function (snapshot) {
            snapshot.forEach(function (userSnapshot) {
                curDisplay = JSON.parse(JSON.stringify(userSnapshot));
                curDisplay.Key = userSnapshot.key;
                Displays[curDisplay["LinkCode"]] = curDisplay;
                if(isgod){
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
                }else{

                }
                //console.log("found:" + curDisplay["DisplayName"] + " linkcode=" + curDisplay["LinkCode"]);

            });
        });
}
