<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Welcome Mail from VanderHouwen</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
        <style>
            * {
                font-family: Arial, sans-serif !important;
            }
        </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .x-gmail-data-detectors,  /* Gmail */
        .x-gmail-data-detectors *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display:none !important;
           }

        /* What it does: Prevents underlining the button text in Windows 10 */
        .button-link {
            text-decoration: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */
        /* Thanks to Eric Lepetit @ericlepetitsf) for help troubleshooting */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
            .email-container {
                min-width: 375px !important;
            }
        }

    </style>

    <!-- Progressive Enhancements -->
    <style>

        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #000000 !important;
            border-color: #000000 !important;
            color: white !important;
        }

        /* Media Queries */
        @media screen and (max-width: 480px) {

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

            /* What it does: Adjust typography on small screens to improve readability */
      .email-container p {
        font-size: 17px !important;
        line-height: 22px !important;
      }
        }

    </style>

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
  <xml>
    <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
  </xml>
    <![endif]-->

</head>
<body width="100%" bgcolor="#F1F1F1" style="margin: 0; mso-line-height-rule: exactly;">
    <center style="width: 100%; background: #e8e9ec; text-align: left;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!--
            Set the email width. Defined in two places:
            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 600px.
            2. MSO tags for Desktop Windows Outlook enforce a 600px width.
            Note: The Fluid and Responsive templates have a different width (600px). The hybrid grid is more "fragile", and I've found that 600px is a good width. Change with caution.
        -->
        <div style="max-width: 600px; margin: auto;" class="email-container">
            <!--[if mso]>
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" align="center">
            <tr>
            <td>
            <![endif]-->

            <!-- Email Body : BEGIN -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;" class="email-container">


                <!-- HEADER : BEGIN -->
                <tr>
                    <td bgcolor="#efeeff">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 30px 40px 30px 40px; text-align: center;">
                  <a href="https://www.vanderhouwen.com/"  target="_blank">
                                    <img src="https://vanderhouwen.com/newsletter/logo.png" width="" height="" alt="alt_text" border="0" style="height: auto; font-family: sans-serif; font-size: 18px; line-height: 20px; color: #555555;"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- HEADER : END -->

               

                <!-- INTRO : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="max-width:600px;">
                            

                            <tr>
                                <td style="padding: 40px 40px 35px 40px; text-align: center;">
                                    <div
                                        style="background: #28326d; font-family: 'Poppins', sans-serif; font-size: 40px; line-height: 60px; text-align: center; text-decoration: none; display: inline-block; border-radius: 8px; font-weight: 600;  width:320px;">
                                        
                                        
                                        <table border="0" cellspacing="0" cellpadding="0" style="background:#28326d; font-family:'Poppins',sans-serif; font-size:40px; line-height:60px; text-align:center;text-decoration:none; display:inline-block; border-radius:8px; font-weight:600; width:320px">
                                                    <tbody>
                                                    <tr>
                                                        <td align="center" style="border-radius:50px; width:320px; padding:25px 0 8px 0" bgcolor="#28326d">
                                                             <img src="https://ci3.googleusercontent.com/proxy/EXws3POcGANaZs3s3uE24XJDioj-lmr7--Hz3YvMkmvZHFwaalqDjbcWZ_nJqSrgl090zU_Mynr9y6hDr-TaN67w6K06jyKp_-mlwiY=s0-d-e1-ft#https://www.vanderhouwen.com/newsletter/thank-you-icon.png" alt="" class="CToWUd" data-bit="iit">
                                                        </td>
                                                         </tr>
                                                        <tr>
                                                        <?php if($details['type'] == 'new'){ ?>
                                                        <td align="center" style="border-radius:50px; color:#fff; padding:2px 0 17px 0" bgcolor="#28326d">
                                                             THANK YOU
                                                        </td>
                                                        <?php }else{ ?>
                                                            <td align="center" style="border-radius:50px; color:#fff; padding:2px 0 17px 0" bgcolor="#28326d">
                                                                 UPDATED
                                                            </td>
                                                        <?php } ?>

                                                    </tr>
                                                </tbody>
                                                </table>
                                       
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 10px 40px 5px 40px; text-align: center;">
                                    <?php if($details['type'] == 'new'){ ?>
                                    <h1 style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 40px; line-height: 1; color: #28326d; font-weight: 500; display: block;">You have subscribed to</h1>
                                    <?php }else{ ?>
                                    <h1 style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 40px; line-height: 1; color: #28326d; font-weight: 500; display: block;">You've Updated<br>Your Job Alerts</h1>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 40px 20px 40px; font-family: 'Poppins', sans-serif; font-size: 20px; line-height: 26px; color: #313131; text-align: center; font-weight:600;">
                                    <p><strong> </strong> </p>
                                    <p style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 20px; line-height: 26px; font-weight:600; display: block;"><?php echo $details['subFor']; ?></p>
                                </td>
                            </tr>
                        
                           

                            <tr>
                                <td align="center" >
                                    <!--[if (gte mso 9)|(IE)]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                <tr>
                                <td align="center" valign="top" width="600">
                                <![endif]-->
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                                        style="max-width:600px;">
                                        <tr>
                                            <td align="center" style="padding: 30px 0 50px 0;">
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td align="center" style="border-radius: 50px;"
                                                            bgcolor="#1b8c88">
                                                            <a href="https://www.vanderhouwen.com/job-alerts/public/?sid=<?php echo base64_encode($details['subid']); ?>"
                                                                target="_blank"
                                                                style="font-size: 18px; font-family: 'Poppins', sans-serif; color: #ffffff; text-decoration: none; border-radius: 50px; background-color:  #1b8c88;
                                                       font-weight: 400; padding: 18px 40px; border: 1px solid #1b8c88; display: block;">Change Your Preferences</a>
                                                        </td>

                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--[if (gte mso 9)|(IE)]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 0px 40px 5px 40px; text-align: center;">
                                    <h1 style="margin: -25px; font-family: 'Poppins', sans-serif; font-size: 40px; line-height: normal; color: #313131; font-weight: 600; display: block;">Find Your Dream Job</h1>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 40px 20px 40px; font-family: 'Poppins', sans-serif; font-size: 20px; line-height: 26px; color: #313131; text-align: center; font-weight:400;">
                                    <p><strong></strong> </p>
                                    <p style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 18px; line-height: 26px; font-weight:400; display: block;">We've added more jobs to our website that may interest you...<br> </p>
                                </td>
                            </tr>

                           

                            <tr>
                                <td align="center" >
                                    <!--[if (gte mso 9)|(IE)]>
                                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                                <tr>
                                <td align="center" valign="top" width="600">
                                <![endif]-->
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                                        style="max-width:600px;">
                                        <tr>
                                            <td align="center" style="padding: 30px 0 50px 0;">
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td align="center" style="border-radius: 50px;"
                                                            bgcolor="#28326d">
                                                            <a href="https://www.vanderhouwen.com/job-postings/"
                                                                target="_blank"
                                                                style="font-size: 18px; font-family: 'Poppins', sans-serif; color: #ffffff; text-decoration: none; border-radius: 50px; background-color:  #28326d;
                                                       font-weight: 400; padding: 18px 40px; border: 1px solid #28326d; display: block;">View More Jobs</a>
                                                        </td>

                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--[if (gte mso 9)|(IE)]>
                                </td>
                                </tr>
                                </table>
                                <![endif]-->
                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <!-- INTRO : END -->

                <!-- AGENDA : BEGIN -->
                <tr>
                    <td bgcolor="#1c8c89">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 40px 40px 0px 40px; text-align: center;">
                                    <h3 style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 22px; text-transform: uppercase; line-height: 26px;  color: #fff; font-weight: 600;">Do not reply to this email</h3>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 8px 40px 40px 40px; font-family: 'Poppins', sans-serif; font-size: 18px; line-height: 20px; color: #fff; text-align: center; font-weight:normal;">
                                    <p style="margin: 0; font-family: 'Poppins', sans-serif; font-size: 18px; line-height: 22px; color: #fff; font-weight: 200;">This inbox is not monitored. If you'd like to reach us <br>please email <a href="mailto:opportunities@vanderhouwen.com" style="text-decoration: underlining; color:#fff;">opportunities@vanderhouwen.com</a> 
                                        <br>or call <a href="tel:5032996811" style="text-decoration: underlining; color:#fff;">503.299.6811</a>.</p>
                                </td>
                            </tr>
                         
                   
                        </table>
                    </td>
                </tr>
                <!-- AGENDA : END -->

                <!-- SOCIAL : BEGIN -->
                <tr>
                    <td bgcolor="#12162b">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 60px 30px 20px 30px; text-align: center;">
                                    <a href="https://www.vanderhouwen.com/"><img src="https://vanderhouwen.com/newsletter/logoFootre.png" alt=""></a>
                                    <p style="margin:8px 0 0 0; font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 20px; color: #e6eaff; font-weight: 400; text-align: center;">6342 S Macadam Ave. Portland, OR 97239<br>503-299-6811</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 30px 35px 30px; text-align: center;">
                                    
                                    <table align="center" style="text-align: center;">
                                        <tr>
                                            <td>
                                                <a href="https://www.facebook.com/VanderHouwen/" target="_blank"><img src="https://vanderhouwen.com/newsletter/facebook.png" width="" height="" style="margin:0; padding:0; border:none; display:block;" border="0" alt=""></a>
                                            </td>
                                            <td width="10">&nbsp;</td>
                                            <td>
                                                <a href="https://twitter.com/vandertweet" target="_blank"><img src="https://vanderhouwen.com/newsletter/twitter.png" width="" height="" style="margin:0; padding:0; border:none; display:block;" border="0" alt=""></a>
                                            </td>                                        
                                            <td width="10">&nbsp;</td>
                                            <td>
                                                <a href="https://www.linkedin.com/company/vanderhouwen" target="_blank"><img src="https://vanderhouwen.com/newsletter/linkdin.png" width="" height="" style="margin:0; padding:0; border:none; display:block;" border="0" alt=""></a>
                                            </td>
                                            <td width="10">&nbsp;</td>
                                            <td>
                                                <a href="https://www.instagram.com/vanderhouwen.recruits/" target="_blank"><img src="https://vanderhouwen.com/newsletter/insta.png" width="" height="" style="margin:0; padding:0; border:none; display:block;" border="0" alt=""></a>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 20px; color: #e6eaff; font-weight: 200; text-align: center;">
                                    <p style=" font-size: 13px;">Copyright  &copy; 2022 VanderHouwen. All rights reserved.<br> You are receiving this email because you opted in to this list<br>from our website.</p>
                                </td>
                            </tr>
                            <tr style=" ">
                                <td style="font-family: 'Poppins', sans-serif; font-size: 15px; line-height: 20px; color: #e6eaff; font-weight: 200; text-align: center; padding: 0px 0px 40px 0px;">
                                    <p>Want to change how you receive these emails?<br>
                                        You can <a href="https://www.vanderhouwen.com/job-alerts/public/?sid=<?php echo base64_encode($details['subid']); ?>" style="text-decoration: underlining;  font-size: 13px;  color:#e6eaff;" target="_blank">update your preferences</a>.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- SOCIAL : END -->


            </table>
            <!-- Email Body : END -->

            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>

    </center>
</body>
</html>