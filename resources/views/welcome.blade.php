<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
   
 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cloudways Laravel</title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        @font-face {
            font-family: 'proxima_nova';
            src: url('https://litmus.com/fonts/Emails/proximanova-regular-webfont.eot');
            src: url('https://litmus.com/fonts/Emails/proximanova-regular-webfont.eot?#iefix') format('embedded-opentype'),
                url('https://litmus.com/fonts/Emails/proximanova-regular-webfont.woff') format('woff'),
                url('https://litmus.com/fonts/Emails/proximanova-regular-webfont.ttf') format('truetype'),
                url('https://litmus.com/fonts/Emails/proximanova-regular-webfont.svg#proxima_nova_rgregular') format('svg');
            font-weight: 400;
            font-style: normal;
        }
        
        @font-face {
            font-family: 'proxima_nova';
            src: url('https://litmus.com/fonts/Emails/proximanova-bold-webfont.eot');
            src: url('https://litmus.com/fonts/Emails/proximanova-bold-webfont.eot?#iefix') format('embedded-opentype'),
                url('https://litmus.com/fonts/Emails/proximanova-bold-webfont.woff') format('woff'),
                url('https://litmus.com/fonts/Emails/proximanova-bold-webfont.ttf') format('truetype'),
                url('https://litmus.com/fonts/Emails/proximanova-bold-webfont.svg#proxima_nova_rgbold') format('svg');
            font-weight: 600;
            font-style: normal;
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            overflow-x: hidden;
        }

        body {
            padding: 0;
            margin: 0;
            color: #1a1a1a;
            font-size: 15px;
            font-family: 'proxima_nova';
            font-weight: 400;
        }

        a {
            display: inline-block;
            text-decoration: none !important;
            transition: all 0.3s ease-in-out;
        }

        .container {
            max-width: 1120px;
            margin: 0 auto;
            padding-left: 15px;
            padding-right: 15px;
        }

        .img-responsive
        {
            display: inline-block;
            max-width: 100%;
            height: auto;
        }

        .cw_glb_btn {
            color: #0E134F;
            font-size: 16px;
            font-weight: 600;
            display: inline-block;
            background-color: #39DCB1;
            border-radius: 6px !important;
            padding: 15px 20px;
            min-width: 220px;
            text-align: center;
            text-transform: uppercase;
        }

        .cw_glb_btn:hover, .cw_glb_btn:focus, .cw_glb_btn:active {
            background-color: #74ffda !important;
        }

        .lrvl_wlcm_bnr_sec
        {
            background: #1c2bf7;
            background: -moz-linear-gradient(45deg, #1c2bf7 0, #061c59 100%);
            background: -webkit-gradient(left bottom, right top, color-stop(0%, #1c2bf7), color-stop(100%, #061c59));
            background: -webkit-linear-gradient(45deg, #1c2bf7 0, #061c59 100%);
            background: -o-linear-gradient(45deg, #1c2bf7 0, #061c59 100%);
            background: -ms-linear-gradient(45deg, #1c2bf7 0, #061c59 100%);
            background: linear-gradient(45deg, #1c2bf7 0, #061c59 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1c2bf7', endColorstr='#061c59', GradientType=1);
            padding: 60px 0 80px;
        }

        .lrvl_wlcm_bnr_mainBox h1
        {
            color: #fff;
            font-size: 48px;
            font-weight: 600;
            margin: 30px 0;
        }

        .lrvl_wlcm_mid_sec
        {
            background: #fff;
            padding-bottom: 80px;
        }

        .lrvl_wlcm_mid_mainBox
        {
            display: flex;
        }

        .lrvl_wlcm_mid_lftBox
        {
            flex: 1;
        }

        .lrvl_wlcm_version
        {
            color: #0A1E43;
            opacity: 0.7;
            font-size: 14px;
            padding: 20px 0 30px;
        }

        .lrvl_wlcm_mid_lftBox
        {
            position: relative;
        }

        .lrvl_wlcm_mid_lftBox ul
        {
            margin: 0;
            padding: 0;
        }

        .lrvl_wlcm_mid_lftBox ul li
        {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .lrvl_wlcm_mid_lftBox ul li a
        {
            color: #0A1E43;
            font-size: 18px;
            padding: 15px;
            display: block;
            border-left: 2px solid rgba(196, 196, 196, 0.5);
        }

        .lrvl_wlcm_mid_lftBox ul li a.active
        {
            color: #2F39BF;
            font-weight: 600;
            border-color: #2F39BF;
        }

        .lrvl_wlcm_mid_lftBox_fxd
        {
            position: fixed;
            top: 100px;
            z-index: 999;
        }

        .lrvl_wlcm_mid_rhtBox
        {
            flex: 2;
        }

        .lrvl_wlcm_mid_rht_txtBox
        {
            margin-bottom: 20px;
        }
        
        .lrvl_wlcm_mid_rht_txtBox h2
        {
            color: #0E134F;
            font-size: 36px;
            font-weight: 600;
            margin: 0 0 30px;
        }

        .lrvl_wlcm_mid_rht_txtBox ul
        {
            margin: 0;
            padding: 0;
        }

        .lrvl_wlcm_mid_rht_txtBox ul li
        {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .lrvl_wlcm_mid_rht_txtBox ul li a
        {
            color: #0A1E43;
            font-size: 18px;
            font-weight: 600;
            padding: 20px;
            margin-bottom: 20px;
            background: rgba(248, 249, 251, 0.5);
            display: block;
        }

        .lrvl_wlcm_mid_rht_txtBox ul li a:hover,
        .lrvl_wlcm_mid_rht_txtBox ul li a:focus,
        .lrvl_wlcm_mid_rht_txtBox ul li a:active
        {
            color: #2F39BF;
        }

        .lrvl_wlcm_signUp_sec
        {
            background: #1c2bf7;
            background: -moz-linear-gradient(45deg, #1c2bf7 0, #061c59 100%);
            background: -webkit-gradient(left bottom, right top, color-stop(0%, #1c2bf7), color-stop(100%, #061c59));
            background: -webkit-linear-gradient(45deg, #1c2bf7 0, #061c59 100%);
            background: -o-linear-gradient(45deg, #1c2bf7 0, #061c59 100%);
            background: -ms-linear-gradient(45deg, #1c2bf7 0, #061c59 100%);
            background: linear-gradient(45deg, #1c2bf7 0, #061c59 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1c2bf7', endColorstr='#061c59', GradientType=1);
            padding: 80px 0;
            text-align: center;
        }

        .lrvl_wlcm_signUp_mainBox h3
        {
            color: #fff;
            font-size: 36px;
            font-weight: 600;
            margin: 0 0 30px;
        }

        .lrvl_wlcm_ftr_sec
        {
            background: #050826;
            padding: 20px 0;
        }

        .lrvl_wlcm_ftr_sec p
        {
            color: #fff;
            font-size: 15px;
            margin: 0;
            text-align: center;
        }

        @media (max-width: 1200px)
        {
            .container {
                width: 970px;
            }
        }

        @media (max-width: 992px)
        {
            .container {
                width: 750px;
            }

            .lrvl_wlcm_bnr_sec
            {
                padding: 50px;
            }

            .lrvl_wlcm_bnr_mainBox h1 {
                font-size: 32px;
                margin: 20px 0;
            }

            .lrvl_wlcm_mid_lftBox ul li a,
            .lrvl_wlcm_mid_rht_txtBox ul li a
            {
                font-size: 16px;
            }

            .lrvl_wlcm_mid_rht_txtBox h2
            {
                font-size: 26px;
                margin-bottom: 10px;
            }

            .lrvl_wlcm_signUp_sec
            {
                padding: 50px 0 40px;
            }

            .lrvl_wlcm_signUp_mainBox h3 {
                font-size: 26px;
                line-height: 36px;
                margin-bottom: 20px;
            }

            .lrvl_wlcm_signUp_mainBox h3 br
            {
                display: none;
            }
        }

        @media (max-width: 767px)
        {
            .container {
                width: 100%;
            }

            .lrvl_wlcm_bnr_sec {
                padding: 50px 0 40px;
                text-align: center;
            }

            .lrvl_wlcm_version
            {
                padding-bottom: 0;
            }

            .lrvl_wlcm_mid_sec {
                padding-bottom: 30px;
            }

            .lrvl_wlcm_mid_mainBox {
                display: block;
            }

            .lrvl_wlcm_mid_lftBox
            {
                margin-bottom: 20px;
            }

            .lrvl_wlcm_mid_lftBox ul
            {
                padding: 20px 0 10px;
            }

            .lrvl_wlcm_mid_lftBox_fxd {
                top: 0px;
                background: #fff;
                border-bottom: 2px solid #2F39BF;
            }
            
            .lrvl_wlcm_mid_lftBox ul li
            {
                display: inline-block;
            }

            .lrvl_wlcm_mid_lftBox ul li a {
                font-size: 14px;
                padding: 10px;
                background-color: rgba(196, 196, 196, 0.5);
                border: 0 !important;
                border-radius: 6px;
            }

            .lrvl_wlcm_mid_lftBox ul li a.active
            {
                color: #fff;
                background-color: #2F39BF;
            }

            .lrvl_wlcm_mid_rht_txtBox ul li a {
                font-size: 15px;
                padding: 15px;
                margin-bottom: 10px;
            }
        }

        @media (max-width: 500px)
        {
            .cw_glb_btn
            {
                width: 100%;
            }

            .lrvl_wlcm_mid_lftBox ul li,
            .lrvl_wlcm_mid_lftBox ul li a
            {
                width: 100%;
                text-align: center;
            }
        }
    </style>
  </head>
  <body>
    <section class="lrvl_wlcm_bnr_sec">
        <div class="container">
            <div class="lrvl_wlcm_bnr_mainBox">
                <div class="lrvl_wlcm_bnr_imgBox">
                    <img src="https://www.cloudways.com/wp-content/uploads/2021/02/cw-laravel-logo.png" alt="Cloudways Laravel" class="img-responsive">
                </div>
                <h1>Getting Started with Laravel</h1>
            </div>
        </div>
    </section>

    <section class="lrvl_wlcm_mid_sec">
        <div class="container">
            <div class="lrvl_wlcm_version">
            <div class="lrvl_wlcm_mid_mainBox">
                <div class="lrvl_wlcm_mid_lftBox">
                    <ul>
                        <li><a href="javascript:void(0);" data-target="section1" class="active">Getting Started Guides</a></li>
                        <li><a href="javascript:void(0);" data-target="section2">Deployment Guides</a></li>
                        <li><a href="javascript:void(0);" data-target="section3">Using Cloudways Features</a></li>
                        <li><a href="javascript:void(0);" data-target="section4">Optimization Guides</a></li>
                    </ul>
                </div>

                <div class="lrvl_wlcm_mid_rhtBox">
                    <div class="lrvl_wlcm_mid_rht_txtBox" id="section1">
                        <h2>Getting Started Guides</h2>
                        <ul>
                            <li><a href="https://support.cloudways.com/how-do-i-take-my-website-live-from-cloudways/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How Do I Take My Website Live from Cloudways</a></li>
                            <li><a href="https://support.cloudways.com/deploy-laravel-on-cloudways/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Deploy Laravel Project on Cloudways Server</a></li>
                            <li><a href="https://support.cloudways.com/how-to-manage-your-databases-using-the-integrated-database-manager/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">Manage Your Databases Using the Cloudways Database Manager</a></li>
                            <li><a href="https://support.cloudways.com/configure-gmail-smtp/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Configure Gmail SMTP</a></li>
                            <li><a href="https://www.cloudways.com/blog/setup-https-ssl-on-laravel/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Setup HTTPS SSL certificates on Laravel</a></li>
                            <li><a href="https://www.cloudways.com/blog/integrate-cdn-in-laravel/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">Integrate CloudwaysCDN with Laravel Applications</a></li>
                            <li><a href="https://support.cloudways.com/what-can-i-do-from-the-packages-tab-of-server-settings-packages-section/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">What can I do from Packages tab of Cloudways Platform</a></li>
                        </ul>
                    </div>

                    <div class="lrvl_wlcm_mid_rht_txtBox" id="section2">
                        <h2>Deployment Guides</h2>
                        <ul>
                            <li><a href="https://www.cloudways.com/blog/deploy-through-gitlab/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">Deploy Apps Using GitLab on Cloudways Platform</a></li>
                            <li><a href="https://www.cloudways.com/blog/deploy-php-application/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">Deploy PHP Application With Best Web Tools in Minutes</a></li>
                            <li><a href="https://www.cloudways.com/blog/php-laravel-envoyer-deployment/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">Deploy PHP Application via Laravel Envoyer</a></li>
                            <li><a href="https://www.cloudways.com/blog/deploy-gitlab-ci-cd/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">Using GitLab CI/CD on Cloudways</a></li>
                            <li><a href="https://support.cloudways.com/how-to-automate-git-deployment-using-webhooks/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">Automatically Deploy From Git to Server Using Webhooks</a></li>
                        </ul>
                    </div>

                    <div class="lrvl_wlcm_mid_rht_txtBox" id="section3">
                        <h2>Using Cloudways Features</h2>
                        <ul>
                            <li><a href="https://www.cloudways.com/blog/install-laravel-horizon/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Install Laravel Horizon on Cloudways</a></li>
                            <li><a href="https://www.cloudways.com/blog/laravel-cron-job-scheduling/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">Laravel Cron Jobs Scheduling on Cloudways</a></li>
                            <li><a href="https://support.cloudways.com/configure-supervisord-on-cloudways/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Configure Laravel Supervisord on Cloudways</a></li>
                            <li><a href="https://support.cloudways.com/how-to-change-php-fpm-settings/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Change PHP-FPM Settings</a></li>
                            <li><a href="https://support.cloudways.com/how-to-install-phpmyadmin-on-cloudways/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Install PHPMyAdmin on Cloudways</a></li>
                            <li><a href="https://support.cloudways.com/can-i-use-cloudflare-cdn/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Use Cloudflare CDN on Cloudways</a></li>
                            <li><a href="https://support.cloudways.com/setting-up-remote-mysql-database-connections/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Setup MySQL Remote Connection to Database</a></li>
                            <li><a href="https://support.cloudways.com/allow-remote-mysql-database-connections/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Whitelist IP Addresses for Remote MySQL Connections</a></li>
                            <li><a href="https://www.cloudways.com/blog/send-email-in-laravel/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Send Email in Laravel Using Prebuilt Tools</a></li>
                        </ul>
                    </div>

                    <div class="lrvl_wlcm_mid_rht_txtBox" id="section4">
                        <h2>Optimization Guides</h2>
                        <ul>
                            <li><a href="https://www.cloudways.com/blog/laravel-performance-optimization/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">Ultimate Laravel Performance Optimization Guide</a></li>
                            <li><a href="https://www.cloudways.com/blog/integrate-laravel-cache/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">How to Use Laravel Cache For Fast Performance</a></li>
                            <li><a href="https://www.cloudways.com/blog/best-laravel-security-practices/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">Best Practices to Improve Laravel App's Security</a></li>
                            <li><a href="https://www.cloudways.com/blog/prevent-laravel-xss-exploits/?utm_source=php-stack-page&utm_medium=php-stack-page&utm_campaign=php-stack-page" target="_blank">Laravel Validation & Sanitization to Prevent XSS Exploits</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lrvl_wlcm_signUp_sec">
        <div class="container">
            <div class="lrvl_wlcm_signUp_mainBox"> 
                <h3>Be a Part of Exciting Discussion <br/>on Cloudways User Group</h3>
                <a href="https://www.facebook.com/groups/CloudwaysUsers" target="_blank" class="cw_glb_btn">JOIN NOW</a>
            </div>
        </div>
    </section>

    <footer class="lrvl_wlcm_ftr_sec">
        <p>© 2022 Cloudways Ltd. All rights reserved</p>
    </footer>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script type="text/javascript">
        $('.lrvl_wlcm_mid_lftBox ul li a').on('click',function () {
            let get_data_id = $(this).data('target');
            $('html, body').stop().animate({
                scrollTop: $('#' + get_data_id).offset().top - 20
            }, 500);
        });

        $(window).on('scroll', () => {
            let get_win_scroll = $(window).scrollTop();
            let get_win_height = $(window).height() - 100;
            let get_top_offset = $('.lrvl_wlcm_mid_sec').offset().top;
            let get_bottom_offset = $('.lrvl_wlcm_signUp_sec').offset().top;
            let get_sideNav_width = $('.lrvl_wlcm_mid_lftBox ul').outerWidth();

            //Fixed Right Menu
            if((get_win_scroll >= get_top_offset) && ((get_win_scroll + get_win_height) <= get_bottom_offset))
            {
                $('.lrvl_wlcm_mid_lftBox ul').css('width', get_sideNav_width);
                $('.lrvl_wlcm_mid_lftBox ul').addClass('lrvl_wlcm_mid_lftBox_fxd');
            } else {
                $('.lrvl_wlcm_mid_lftBox ul').removeClass('lrvl_wlcm_mid_lftBox_fxd');
            }

            //Check Current Fold
            var get_content_offset = new Array();
            $('.lrvl_wlcm_mid_rht_txtBox').each(function() {
                get_content_offset.push($(this).offset().top - 100);
            });

            for( var i=0; i<= get_content_offset.length; i++){
                if($(this).scrollTop() >= get_content_offset[i]){
                    $('.lrvl_wlcm_mid_lftBox ul li a').removeClass('active');
                    $('.lrvl_wlcm_mid_lftBox ul li a').eq(i).addClass('active');
                }
            }
        });    
    </script>

  </body>
</html>
