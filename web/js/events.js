$(document).ready(function() { refresh(); });

function refresh() {
  var context = {};
  $.when(loadEvents(0))
    .then(function(events) { context.events = events }, notifyError)
    .then($.when(loadEvents(1)).then(function(pastEvents) { context.pastEvents = pastEvents }, notifyError))
    .then(UserUtils.getLoggedUser)
    // .then(function(user) { user.isAdmin = true; context.user = user }, notifyError)
    .then(function(user) { user.isAdmin = user.roleId == 2; context.user = user }, notifyError)
    .then(function() {
      for (var i = 0; i < context.events.length; i++) {
        var event = context.events[i];
        event.playing = EventUtils.isPlayerAttending(context.user.playerId, event);
      }
    }, notifyError)
    .then(function() {
      console.log(context);
      var source = document.getElementById("home-template").innerHTML;
      var template = Handlebars.compile(source);
      $('#body').html(template(context));
    });
}
