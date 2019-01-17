function addSelfPlayer(eventId) {
  return UserUtils.getLoggedUser().then(function (user) {
    return $.post("/api/events/" + eventId + "/players", {id: user.playerId} );
  });
}

function removeSelfPlayer(eventId) {
  return UserUtils.getLoggedUser().then(function (user) {
    return $.delete("/api/events/" + eventId + "/players/" + user.playerId );
  });
}

function addPlayer(eventId, playerId) {
    return $.post("/api/events/" + eventId + "/players", {id: playerId} );
}

function addExtra(eventId, form) {
  var formData = $(form).serializeFormJSON();
  return $.post("/api/events/" + eventId + "/players", {nickName: formData.nickName, genderId: formData.genderId} );
}

function removePlayer(eventId, playerId) {
  return $.delete("/api/events/" + eventId + "/players/" + playerId);
}

function transferPlayer(eventId, playerId, teamId) {
    return $.put("/api/events/" + eventId + "/players/" + playerId, { teamId: teamId } );
}
