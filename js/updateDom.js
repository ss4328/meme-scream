// Customize how the browser will display the contents of Thing update messages received
//
var i = 0;

function search() {
    var xhr = $.get("http://api.giphy.com/v1/gifs/random?tag=" + encodeURI(document.getElementById('searchtext').value) + "&api_key=0db4fdd98a4a49ccb3842eb47cb0d04a&limit=1", function(data) {
        gifid = data.data.id;
        img = 'http://i.giphy.com/media/' + gifid + '/giphy.gif';
        console.log(data);
        $("#imgmeme").attr("src", img);
        $("#imagetext").attr("value", img);
    });
}

function handleMessage(msg) { // called from within connectAsThing.js
    // display the JSON message in a panel
    document.getElementById('panel').innerHTML = msg;

    var myMeme = JSON.parse(msg).meme;
    var myTop = JSON.parse(msg).top;
    var myBottom = JSON.parse(msg).bottom;

    var img;

    if (i == 0) {
        var xhr = $.get("http://api.giphy.com/v1/gifs/random?tag=" + encodeURI(myMeme) + "&api_key=0db4fdd98a4a49ccb3842eb47cb0d04a&limit=1", function(data) {
            gifid = data.data.id;
            img = 'http://i.giphy.com/media/' + gifid + '/giphy.gif';
            console.log(data);
            $("#imgmeme").attr("src", img);
            $("#imagetext").attr("value", img);
        });
    }
    i++;

    if (myTop != '') {
        document.getElementById("toptext").value = myTop;
        document.getElementById("toph1").innerHTML = myTop;
    }
    if (myBottom != '') {
        document.getElementById("bottomtext").value = myBottom;
        document.getElementById("bottomh1").innerHTML = myBottom;
    }
}

function reloader() {
    location.reload(true); // hard reload including .js and .css files
}