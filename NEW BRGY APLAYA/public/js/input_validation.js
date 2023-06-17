//Paste Validation
  $('.numeric-only').on('input', function(e) {
    $(this).val(function(i, v) {
      return v.replace(/[^0-9]/g, '');
    });
  });

  $('.letters-only').on('input', function(e) {
    $(this).val(function(i, v) {
      return v.replace(/[^a-zA-Z\s]/g, '');
    });
  });

  $('.numeric-w-hyphen').on('input', function(e) {
    $(this).val(function(i, v) {
      return v.replace(/[^0-9\-]/g, '');
    });
  });

  $('.name-only').on('input', function(e) {
    $(this).val(function(i, v) {
      return v.replace(/[^a-zA-Z-\s]/g, '');
    });
  });

  //Letter Validation
  $('.letters-only').keypress(function (e) {
    var txt = String.fromCharCode(e.which);
    if (!txt.match(/[A-Za-z ]/)) {
        return false;
    }
  });

  $('.name-only').keypress(function (e) {
    var txt = String.fromCharCode(e.which);
    if (!txt.match(/[A-Za-z- ]/)) {
        return false;
    }
  });

  //Numeric Validation
  $('.numeric-only').keypress(function (e) {
    var txt = String.fromCharCode(e.which);
    if (!txt.match(/[0-9]/)) {
        return false;
    }
  });

  //Numeric Validation
  $('.numeric-w-hyphen').keypress(function (e) {
    var txt = String.fromCharCode(e.which);
    if (!txt.match(/[0-9-]/)) {
        return false;
    }
  });

  //Alphanumeric Validation
  $('.username').keypress(function (e) {
    var txt = String.fromCharCode(e.which);
    if (!txt.match(/[A-Za-z0-9_]/)) {
        return false;
    }
  });