/*!
 * jQuery OAuth via popup window plugin
 *
 * @author  Nobu Funaki @nobuf
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
(function($){
   


    //  inspired by DISQUS
    $.oauthpopup = function(options)
    {


        if (!options || !options.path) {
            throw new Error("options.path must not be empty");
        }

        /***variables for centering oauth window***/
        var popWidth = options.width;
        var popHeight = options.height;
        var xpos = ($(window).width()-popWidth)/2;
        var ypos = ($(window).height()-popHeight)/2;


        options = $.extend({
            windowName: 'authPopup' // should not include space for IE
          , windowOptions: 'location=0, status=0, width='+popWidth+',height='+popHeight+',left='+xpos+'top='+ypos+'' //made adjustments to height and width
          , callback: function() { window.location.reload();   }
          , callback: function () { window.close(); }
        }, options);

        var oauthWindow   = window.open(options.path, options.windowName, options.windowOptions);
        var oauthInterval = window.setInterval(function(){
            if(window.opener && window.name === 'authPopup') {
                window.close();
            }

            if (oauthWindow.closed) {
               
                window.clearInterval(oauthInterval);
                options.callback();
            }
        }, 1000); //why is a setInterval here?
    };

    //bind to element and pop oauth when clicked
    $.fn.oauthpopup = function(options) {
        $this = $(this);
        $this.click($.oauthpopup.bind(this, options));
    };
})(jQuery);

