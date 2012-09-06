window.fbAsyncInit = function() {
    FB.init({
        appId: '92683221988', 
        status: true, 
        cookie: true, 
        xfbml: true
    });
/* Disabling the fb analytics tracker
    FB.Event.subscribe("edge.create",function(response) {
    }
    if (response.indexOf("facebook.com") > 0) {
        // if the returned link contains 'facebook,com'. It is a 'Like'
        // for your Facebook page
       _gaq.push(['_trackEvent','Facebook','Like',response]);
        } else {
         // else, somebody is sharing the current page on their wall
        _gaq.push(['_trackEvent','Facebook','Share',response]);
        } });
       FB.Event.subscribe("message.send",function(response){
       _gaq.push(['_trackEvent','Facebook','Send',response]);
       }); */
};
(function() {
    var e = document.createElement('script');
    e.type = 'text/javascript';
    e.src = document.location.protocol +
    '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
}());

// Load Tweet Button Script &amp; Associate Google Analytics Tracking
var e = document.createElement('script');
e.type="text/javascript";
e.async = true;
e.src = 'http://platform.twitter.com/widgets.js';
document.getElementsByTagName('head')[0].appendChild(e);
/* Disabling the twitter analytics 
$(e).load(function() {
  function tweetIntentToAnalytics(intent_event) {
    if (intent_event) {
      var label = intent_event.data.tweet_id;
      _gaq.push(['_trackEvent', 'twitter_web_intents',
	    intent_event.type, label]);
      
    }
  }
  function followIntentToAnalytics(intent_event) {
    if (intent_event) {
      var label = intent_event.data.user_id + " (" +
	   intent_event.data.screen_name + ")";
      _gaq.push(['_trackEvent', 'twitter_web_intents',
	   intent_event.type, label]);
      
    }
  }
  twttr.events.bind('tweet',    tweetIntentToAnalytics);
  twttr.events.bind('follow',   followIntentToAnalytics);
});
*/
jQuery(document).ready(function($) {
    // Load Plus One Button
    var e = document.createElement('script');
    e.type="text/javascript";
    e.async = true;
    e.src = 'https://apis.google.com/js/plusone.js';
    document.getElementsByTagName('head')[0].appendChild(e);
});

var map;
var layer;
var tableid = 852021;

function initialize() {
    map = new google.maps.Map(document.getElementById('map_canvas'), {
        center: new google.maps.LatLng(59.91097597079681, 14.9853515625),
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    layer = new google.maps.FusionTablesLayer(tableid);
    layer.setQuery("SELECT 'platsfull' FROM " + tableid);
    layer.setMap(map);
}

var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-23343522-1']);
_gaq.push(['_setDomainName', '.ungpirat.se']);
_gaq.push(['_trackPageview']);

(function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
})();
