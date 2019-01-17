function EventUtils() {};

EventUtils.getPlayers = function(event, filterCallback) {
  var appendToList = function(list, event) {
    if (!filterCallback || filterCallback(event)) {
      list.push(event.id);
    }
  }
  var playerIds = [];
  for (var i = 0; i < event.teamless.length; i++) {
    appendToList(playerIds, event.teamless[i]);
  }
  for (var i = 0; i < event.teams.length; i++) {
    for (var j = 0; j < event.teams[i].players.length; j++) {
      appendToList(playerIds, event.teams[i].players[j]);
    }
  }
  return playerIds;
}

EventUtils.isPlayerAttending = function(playerId, event) {
  var playerIds = EventUtils.getPlayers(event);
  for (var i = 0; i < playerIds.length; i++) {
    if (playerIds[i] == playerId) {
      return true;
    }
  }
  return false;
}


/************************************************************/

function UserUtils() {}

UserUtils.getLoggedUser = function() {
  $.ajaxSetup({ async: false });
  var user = $.getJSON('/api/user', {'action': 'get'});
  $.ajaxSetup({ async: true });
  return user;
}
