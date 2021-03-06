$(document).ready(function() { refresh(); });

function refresh() {
  var context = {};
  $.when(loadEvents(0))
    .then(function(events) { context.events = events }, notifyError)
    .then(UserUtils.getLoggedUser)
    // .then(function(user) { user.isAdmin = true; context.user = user }, notifyError)
    .then(function(user) { user.isAdmin = user.roleId == 2; context.user = user }, notifyError)
    .then(function() {
      for (var i = 0; i < context.events.length; i++) {
        var event = context.events[i];
        event.playing = EventUtils.isPlayerAttending(context.user.playerId, event);
      }
    }, notifyError)
    .then(loadInmunities)
    .then(function(inmunities) {
      context.inmunities = inmunities;
    })
    .then(function() {
      var source = document.getElementById("home-template").innerHTML;
      var template = Handlebars.compile(source);
      $('#body').html(template(context));
      var currentSlide = Math.floor(Math.random() * ($('.carousel-item').length - 1 + 1));
      $('.carousel-item').each(function(index){
        if (currentSlide == index) {
          $(this).addClass('active');
        } else {
          $(this).removeClass('active');
        }
      });
    });
}
