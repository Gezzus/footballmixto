function changeGameStatus(id, status){
    return $.put('/index.php/api/events/' + id, {status: status});
}

function deleteGame(id) {
  return $.delete('/index.php/api/events/' + id);
}
