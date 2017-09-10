/*
Meme Scream
www.memescream.net

Team Members
• Summit Singh Thakur (Project Manager and Backend Developer) (st866@drexel.edu)
• Shivansh Suhane (Frontend Developer) (ss4328@drexel.edu)
*/

const config = {};
config.IOT_BROKER_ENDPOINT = "a25h8znb9sj7sh.iot.us-east-1.amazonaws.com"; // also called the REST API endpoint
config.IOT_BROKER_REGION = "us-east-1"; // eu-west-1 corresponds to the Ireland Region.  Use us-east-1 for the N. Virginia region
config.IOT_THING_NAME = "giphy";

const SkillMessagesUS = {
    'welcome': 'welcome to scream meme. i will assit you to make a killer meme. look at your browser to choose a meme. you can say things like spiderman, bear, pepe the frog, harambe, snek. which meme template do you want?',
    'help': 'you can say things like spiderman, bear, pepe the frog, harambe, snek',
    'cancel': 'goodbye',
    'stop': 'goodbye'
};

// 2. Skill Code =======================================================================================================


const Alexa = require('alexa-sdk');
var SkillMessages = {};
var global_meme;
var global_top;
var global_bottom;

exports.handler = function(event, context, callback) {
    var alexa = Alexa.handler(event, context);

    // alexa.appId = 'amzn1.echo-sdk-ams.app.1234';
    // alexa.dynamoDBTableName = 'YourTableName'; // creates new table for session.attributes

    SkillMessages = SkillMessagesUS;

    alexa.registerHandlers(handlers);
    alexa.execute();
};

var handlers = {
    'LaunchRequest': function() {
        this.response.speak(SkillMessages.welcome).listen('try again');
        this.emit(':responseReady');
    },
    'MemeIntent': function() {

        var myMeme = this.event.request.intent.slots.meme.value;

        if (!this.event.request.intent.slots.meme.value) {
            var slotToElicit = 'meme';
            var speechOutput = SkillMessages.welcome;
            var repromptSpeech = speechOutput;
            this.emit(':elicitSlot', slotToElicit, speechOutput, repromptSpeech);
        } else {
            say = 'you asked for ' + myMeme + ' meme. what should be the top text?';

            global_meme = myMeme;

            newState = {
                'meme': myMeme,
                'top': '',
                'bottom': ''
            };

            updateShadow(newState, status => {
                this.response.speak(say).listen(say);
                this.emit(':responseReady');
            });
        }
    },
    'TopIntent': function() {

        var myTop = this.event.request.intent.slots.top.value;

        if (!this.event.request.intent.slots.top.value) {
            var slotToElicit = 'top';
            var speechOutput = SkillMessages.welcome;
            var repromptSpeech = speechOutput;
            this.emit(':elicitSlot', slotToElicit, speechOutput, repromptSpeech);
        } else {
            say = 'i added the top text for you. what should be the bottom text?';

            global_top = myTop;

            newState = {
                'meme': global_meme,
                'top': myTop,
                'bottom': ''
            };

            updateShadow(newState, status => {
                this.response.speak(say).listen(say);
                this.emit(':responseReady');
            });
        }
    },
    'BottomIntent': function() {

        var myBottom = this.event.request.intent.slots.bottom.value;

        if (!this.event.request.intent.slots.bottom.value) {
            var slotToElicit = 'bottom';
            var speechOutput = SkillMessages.welcome;
            var repromptSpeech = speechOutput;
            this.emit(':elicitSlot', slotToElicit, speechOutput, repromptSpeech);
        } else {
            say = 'bro, your meme is lit. wait. but you have to download it. goodbye!';

            global_bottom = myBottom;

            newState = {
                'meme': global_meme,
                'top': global_top,
                'bottom': myBottom
            };

            updateShadow(newState, status => {
                this.response.speak(say).listen(say);
                this.emit(':responseReady');
            });
        }
    },
    'AMAZON.HelpIntent': function() {
        this.response.speak(SkillMessages.help).listen(SkillMessages.help);
        this.emit(':responseReady');

    },
    'AMAZON.StopIntent': function() {
        this.response.speak(SkillMessages.stop);
        this.emit(':responseReady');

    },
    'AMAZON.CancelIntent': function() {
        this.response.speak(SkillMessages.cancel);
        this.emit(':responseReady');
    },
    'SessionEndedRequest': function() {
        this.emit('AMAZON.StopIntent');
    },
    'Unhandled': function() {
        this.response.speak(SkillMessages.help).listen(welcomeRepromt);
        this.emit(':responseReady');
    }

};

//    END of Intent Handlers {} ========================================================================================
// 3. Helper Function  =================================================================================================


function updateShadow(desiredState, callback) {
    // update AWS IOT thing shadow
    var AWS = require('aws-sdk');
    AWS.config.region = config.IOT_BROKER_REGION;

    //Prepare the parameters of the update call

    var paramsUpdate = {
        "thingName": config.IOT_THING_NAME,
        "payload": JSON.stringify({
            "state": {
                "desired": desiredState // {"pump":1}
            }
        })
    };

    var iotData = new AWS.IotData({
        endpoint: config.IOT_BROKER_ENDPOINT
    });

    iotData.updateThingShadow(paramsUpdate, function(err, data) {
        if (err) {
            console.log(err);

            callback("not ok");
        } else {
            console.log("updated thing shadow " + config.IOT_THING_NAME + ' to state ' + paramsUpdate.payload);
            callback("ok");
        }

    });

}