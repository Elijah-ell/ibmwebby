// alert('ASD');
(function ($, root, undefined) {

    $(function () {

        'use strict';

        // DOM ready, take it away
        // alert('ASD');
        // Global
        function getParameterByName(name, url) {
            if (!url) {
              url = window.location.href;
            }
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        // replace logo to text
        if (getParameterByName('action') == 'register') {
            $('#login').find('h1:eq(0)').text('Register');
        } else if (getParameterByName('action') == 'lostpassword') {
            $('#login').find('h1:eq(0)').text('Reset Password');
        } else if (getParameterByName('action') == 'rp') {
            $('#login').find('h1:eq(0)').text('Reset Password');
        } else {
            $('#login').find('h1:eq(0)').text('Login');
        }
        $('#login h1').css('opacity','1');

        var textStr = "<div class='start-text'>\
            <div style='height:40px'></div>\
            <h1 style='text-align: left;'><span style='color: #665547;'><strong>Testsite 2017</strong></span></h1>\
            <table style='font-weight:bold; margin-top: 20px;'>\
              <tr style='padding:10px;'>\
                <td valign='top' width='160px'> Date: </td>\
                <td> 27 November 2017 <br>  9.00am to 12:50pm <br></td>\
              </tr>\
              <tr> \
                <td height='10px'>&nbsp;</td> \
                <td height='10px'>&nbsp;</td> \
              </tr> \
              <tr> \
                <td valign='top'> Venue: </td> \
                <td> \
                  Grand Copthorne Waterfront Hotel  <br> \
                  Level 1, Grand Ballroom <br> \
                  (392 Havelock Road, S169663)<br> \
                  <span style='font-weight:normal;'>*Registration will commence at 8:00am</span> \
                </td> \
              </tr> \
              <tr> \
                <td height='10px'>&nbsp;</td> \
                <td height='10px'>&nbsp;</td> \
              </tr> \
              <tr> \
                <td valign='top'>Guest of Honour:</td> \
                <td>Mrs test</td> \
              </tr>\
            </table>\
        </div>";

        $('#login').before(textStr)

        // Register Button
        $('[name="wp-submit"]').each(function(){
            if ($(this).val() === 'Register') {
                $(this).val('Register');
            }
        });

        var footerStyle="\
        <div id='footer-style' role='contentinfo'>\
            <div class='footer-container'>\
                <div class='footer-container-text'>\
                    <p>Brought to you by the LED Taskforce:</p>\
                </div>\
                <div class='footer-container-image'>\
                        <div class='footer-container-image-inner'>\
                            <div class='big-display'>\
                                <img src='wp-content/uploads/2017_V2/cloud.jpg' />\
                            </div>\
                            <div class='small-display'>\
                                <img src='http://ledsymposium2017.dinkevents.com/wp-content/uploads/2017/09/Mobile_Logos_1.jpg' />\
                            </div>\
                        </div>\
                </div>\
                <div class='footer-container-text'>\
                    <p>In collaboration with:</p>\
                </div>\
                <div class='footer-container-image'>\
                    <div class='footer-container-image-inner'>\
                        <img src='wp-content/uploads/2017_V2/cloud.jpg' />\
                    </div>\
                </div>\
            </div>\
        </div> "


        // inert bg
        //$('body').prepend('<header class="header clear" role="banner"><div class="header-inner"><div class="logo"><a href="http://ecce.dinkevents.com" class="logo-2"><img src="http://ecce.dinkevents.com/wp-content/uploads/2017/07/logos.png" alt="Logo" class="logo-img"></a></div></div></header>');
        $('body').append(footerStyle);
        $('body').append('<div id="bg"><div id="bg-img"></div></div>');

        // change back button text
        $('#backtoblog a').text('Back');
    });

})(jQuery, this);
