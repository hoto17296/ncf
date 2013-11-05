(function($) {

  /**
   * Main color picker function.
   */
  $.fn.colorpicker = function(options) {
    options = $.extend({}, $.fn.colorpicker.defaults, options);

    // Inverts a hex-color
    var colorInvert = function(colorHex) {
      var r = colorHex.substr(0, 2);
      var g = colorHex.substr(2, 2);
      var b = colorHex.substr(4, 2);

      return 0.212671 * r + 0.715160 * g + 0.072169 * b < 0.5 ? 'ffffff' : '000000'
    };

    var dialog = $('#colorpicker');
    if (!dialog.length) {
      dialog = $('<div id="colorpicker"></div>').appendTo(document.body).hide();
    }

    // Remove the color-picker if you click outside it
    $(document).click(function(event) {
      if (!($(event.target).is('#colorpicker') || $(event.target).parents('#colorpicker').length)) {
        dialog.hide(options.delay);
      }
    });

    // For HTML element passed to the plugin
    return this.each(function() {
      var element = $(this);

      // Build the list of colors
      // <li><a href="#" style="background-color: #111fff;">111fff</a></li>
      var colorList = '';
      $.each(options.colors, function(index, color) {
        colorList += '<li><a href="#" style="background-color: #' + color + ';">' + color + '</a></li>';
      });

      // When you click on the HTML element
      element.click(function() {
        // Show the dialog next to the HTML element
        var elementPos = element.offset();
        dialog.html('<ul>' + colorList + '</ul>').css({
          position: 'absolute',
          left: elementPos.left,
          top: elementPos.top + element.outerHeight()
        }).show(options.delay);

        // When you click on a color inside the dialog
        $('a', dialog).click(function() {
          // The color is stored in the link's value
          var color = $(this).text();

          // Change the input's background color to reflect the newly selected color
          element.css({
            'background-color': '#' + color,
            color: '#' + colorInvert(color)
          });

          element.trigger({
            type: 'changeColor',
            color: '#' + color
          });

          // Hide the color-picker and return false
          dialog.hide(options.delay);

          return false;
        });

        return false;
      });
    });
  };

  /**
   * Default color picker options.
   */
  $.fn.colorpicker.defaults = {
    // Default colors for the picker
    colors: [
      // Colors from Google Calendar
      '000000', // Black
      '7BD148', // Green
      '5484ED', // Bold blue
      'A4BDFC', // Blue
      '46D6DB', // Turquoise
      '7AE7BF', // Green
      '51B749', // Bold green
      'FBD75B', // Yellow
      'FFB878', // Orange
      'FF887C', // Red
      'DC2127', // Bold red
      'DBADFF', // Purple
      'E1E1E1', // Gray

      // More colors from Google Calendar
      'AC725E',
      'D06B64',
      'F83A22',
      'FA573C',
      'FF7537',
      'FFAD46',
      '42D692',
      '16A765',
      '7BD148',
      'B3DC6C',
      'FBE983',
      'FAD165',
      '92E1C0',
      '9FE1E7',
      '9FC6E7',
      '4986E7',
      '9A9CFF',
      'B99AFF',
      'C2C2C2',
      'CABDBF',
      'CCA6AC',
      'F691B2',
      'CD74E6',
      'A47AE2'
    ],

    // Animation delay for the dialog
    delay: 0
  };

})(jQuery);