$(document).ready(function() { refresh(); });

function refresh() {
  var gameId = location.hash.substr(1);
  var context = { genders: [ {id: 2, name: 'Male'}, {id: 1, name: 'Female'} ] };
  $.when(loadGame(gameId))
    .then(function(game) { game.totals = getTotalsByGender(game, context.genders); context.game = game }, notifyError)
    .then(UserUtils.getLoggedUser)
    // .then(function(user) { user.isAdmin = true; context.user = user }, notifyError)
    .then(function(user) { user.isAdmin = user.roleId == 2; context.user = user }, notifyError)
    .then(function() { context.playing = EventUtils.isPlayerAttending(context.user.playerId, context.game) }, notifyError)
    .then(function() {
      var source = document.getElementById("event-template").innerHTML;
      var template = Handlebars.compile(source);
      $('#body').html(template(context));
    });
}
