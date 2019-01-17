function addSelfPlayer(eventId) {
  return UserUtils.getLoggedUser().then(function (user) {
    return $.post("/index.php/api/events/" + eventId + "/players", {id: user.playerId} );
  });
}

function removeSelfPlayer(eventId) {
  return UserUtils.getLoggedUser().then(function (user) {
    return $.delete("/index.php/api/events/" + eventId + "/players/" + user.playerId );
  });
}

function addPlayer(eventId, playerId) {
    return $.post("/index.php/api/events/" + eventId + "/players", {id: playerId} );
}

function addExtra(eventId, form) {
  var formData = $(form).serializeFormJSON();
  return $.post("/index.php/api/events/" + eventId + "/players", {nickName: formData.nickName, genderId: formData.genderId} );
}

function removePlayer(eventId, playerId) {
  return $.delete("/index.php/api/events/" + eventId + "/players/" + playerId);
}

function transferPlayer(eventId, playerId, teamId) {
    return $.put("/index.php/api/events/" + eventId + "/players/" + playerId, { teamId: teamId } );
}
