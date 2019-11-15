/******************************************************************************/
// Event Actions

function loadEvents(status) {
	return $.getJSON("/api/events", { status: status });
}

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

function preselectPlayers(event) {
	$.ajaxSetup({ async: false });

	var genders = [ {id: 2, name: 'Hombre'}, {id: 1, name: 'Mujer'} ];
	var totals = getTotalsByGender(event, genders);
	for (var i = 0; i < genders.length; i++) {
		if (totals[genders[i].id].count > totals[genders[i].id].max) {
			var nextGamePlayers = randomPreselection(EventUtils.getPlayers(event, function(a) { return a.genderId == genders[i].id && a.hasInmunity == 0; }), totals[genders[i].id].count - totals[genders[i].id].max);
			for (var j = 0; j < nextGamePlayers.length; j++) {
				addInmunity(event.id, nextGamePlayers[j]);
			}
		}
	}
	$.ajaxSetup({ async: true });

	return $.when(true);
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

function addInmunity(eventId, playerId) {
	transferPlayer(eventId, playerId, 5);
	return $.post("/api/players/" + playerId + "/inmunity");
}

function removeInmunity(eventId, playerId) {
	if (eventId != null) {
		transferPlayer(eventId, playerId, null);
	}
	return $.delete("/api/players/" + playerId + "/inmunity");
}

function changeGameStatus(id, status) {
	return $.put('/api/events/' + id, {status: status});
}

function endGame(event) {
	for (var i = 0; i < event.teams.length; i++) {
		for (var j = 0; j < event.teams[i].players.length; j++) {
			$.delete("/api/players/" + event.teams[i].players[j].id + "/inmunity")
		}
	}
	return $.put('/api/events/' + event.id, {status: 1});
}

function loadGame(id) {
		return $.getJSON('/api/events/' + id);
}

function loadInmunities() {
		return $.getJSON('/api/players/inmunity');
}

function deleteGame(id) {
	return $.delete('/api/events/' + id);
}

function randomPreselection(items, amount) {
	var selection = [];
	var items = items.slice(0);
	for (var i = 0; i < amount; i++) {
		var random = getRandomInt(items.length);
		selection.push(items.splice(random, 1)[0]);
	}
	return selection;
}

function getTotalsByGender(event, genders) {
	var totals = {};
	for (var i = 0; i < genders.length; i++) {
		var max = event.type.amountByGender[genders[i].id];
		var count = EventUtils.getPlayers(event, function(a) { return a.genderId == genders[i].id; }).length;
		totals[genders[i].id] = {
			count: count,
			percentage: count / max * 100,
			max: max
		};
	}
	return totals;
}

function getRandomInt(max) {
	return Math.floor(Math.random() * (max + 1));
}
