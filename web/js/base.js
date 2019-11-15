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

Handlebars.registerHelper('sum', function(arg1, arg2) {
  return Number(arg1) + Number(arg2);
});

Handlebars.registerHelper('dateFormat', function(date) {
  moment.updateLocale('en', {
    weekdaysShort : 'Dom_Lun_Mar_Mie_Jue_Vie_Sab'.split('_'),
    monthsShort : 'Ene_Feb_Mar_Abr_May_Jun_Jul_Ago_Sep_Oct_Nov_Dic'.split('_')}
  );
  return moment(date).format("MMM DD - HH:MM") + "hs";
});
