function changeGameStatus(id, status){
    return $.put('/api/events/' + id, {status: status});
}

function deleteGame(id) {
  return $.delete('/api/events/' + id);
}
