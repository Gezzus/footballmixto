(function ($) {
    $.fn.serializeFormJSON = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    $.delete = function(url, data, callback, type){
      if ( $.isFunction(data) ){
        type = type || callback,
        callback = data,
        data = {};
      }
      return $.ajax({ url: url, type: 'DELETE', success: callback, data: data, contentType: type});
    }

    $.put = function(url, data, callback, type){
      if ( $.isFunction(data) ){
        type = type || callback,
        callback = data,
        data = {};
      }
      return $.ajax({ url: url, type: 'PUT', success: callback, data: data, contentType: type});
    }
})(jQuery);

function notifyError(status, exception) {
  if (status.responseJSON && status.responseJSON.message) {
    toastr.error(status.responseJSON.message);
  } else {
    toastr.error('Oops there was an error, please refresh.');
  }
}

Handlebars.registerHelper('ifEq', function(arg1, arg2, options) {
  return (arg1 == arg2) ? options.fn(this) : options.inverse(this);
});

Handlebars.registerHelper('ifGt', function(arg1, arg2, options) {
  return (arg1 > arg2) ? options.fn(this) : options.inverse(this);
});

Handlebars.registerHelper('ifLt', function(arg1, arg2, options) {
  return (arg1 < arg2) ? options.fn(this) : options.inverse(this);
});

Handlebars.registerHelper('next_day', function(dayINeed) {
  return moment().add(1, 'weeks').isoWeekday(dayINeed).format('Y-MM-DD');
});

Handlebars.registerHelper('json', function(context) {
    return JSON.stringify(context);
});
