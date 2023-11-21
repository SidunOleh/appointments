<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        <?php bloginfo( 'name' ) ?> | <?php _e( 'New appointment', 'appointments' ) ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
        /**
        * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
        */
        
        @media screen {
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 700;
                src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }
        /**
        * Avoid browser level font resizing.
        * 1. Windows Mobile
        * 2. iOS / OSX
        */
        
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
        }
        /**
        * Remove extra space added to tables and cells in Outlook.
        */
        
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }
        /**
        * Better fluid images in Internet Explorer.
        */
        
        img {
            -ms-interpolation-mode: bicubic;
        }
        /**
        * Remove blue links for iOS devices.
        */
        
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }
        /**
        * Fix centering issues in Android 4.4.
        */
        
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
        
        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        /**
        * Collapse table borders to avoid space between cells.
        */
        
        table {
            border-collapse: collapse !important;
        }
        
        a {
            color: #1a82e2;
        }
        
        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }

        p {
            text-align: center;
            margin-bottom: 10px; 
        }
    </style>

</head>

<body style="background-color: #e9ecef; text-align: center;">

    <!-- start body -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">

        <!-- start logo -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 15px 12px;background:#d4dadf;">
                            <a href="<?php echo home_url() ?>" target="_blank" style="display: inline-block;text-decoration: none;font-size: 20px;color: black;">
                                <?php bloginfo( 'name' ) ?>
                            </a>
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
        <!-- end logo -->

        <!-- start hero -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                            <h1 style="text-align:center; margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                <?php _e( 'New appointment', 'appointments' ) ?>
                            </h1>
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
        <!-- end hero -->

        <!-- start copy block -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                    <!-- start copy -->
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            
                            <p>
                                <b><?php _e( 'Date', 'appointments' ) ?></b> 
                                <?php echo ( new DateTime( $appointment->start ) )->format( 'm/d/Y' ) ?>
                            </p>

                            <p>
                                <b><?php _e( 'Hour', 'appointments' ) ?></b> 
                                <?php echo ( new DateTime( $appointment->start ) )->format( 'H:i' ) ?>
                            </p>

                            <p>
                                <b><?php _e( 'Service', 'appointments' ) ?></b> 
                                <?php echo $appointment->service->getName( curr_lang() ) ?>
                            </p>

                            <p>
                                <b><?php _e( 'Provider', 'appointments' ) ?></b> 
                                <?php echo $appointment->provider->getName( curr_lang() ) ?>
                            </p>

                            <p>
                                <b><?php _e( 'Name', 'appointments' ) ?></b> 
                                <?php echo $appointment->customer->name ?>
                            </p>

                            <p>
                                <b><?php _e( 'E-mail', 'appointments' ) ?></b> 
                                <?php echo $appointment->customer->email ?>
                            </p>

                            <p>
                                <b><?php _e( 'Phone number', 'appointments' ) ?></b> 
                                <?php echo $appointment->customer->phone ?>
                            </p>

                            <?php if ( $appointment->comment ): ?>
                            <p style="margin: 0 0 0 0;">
                                <b><?php _e( 'Message', 'appointments' ) ?></b> 
                            </p>
                            <p style="margin: 0 0 0 0;">
                                <?php echo $appointment->comment ?>
                            </p>
                            <?php endif ?>

                        </td>
                    </tr>
                    <!-- end copy -->

                    <!-- start button -->
                    <tr>
                        <td align="left" bgcolor="#ffffff">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" bgcolor="#a49561" style="border-radius: 6px;">
                                                    <a href="<?php echo home_url() ?>" target="_blank" style="display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;">
                                                        <?php _e( 'Go to site' ) ?>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- end button -->

                </table>
                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end copy block -->

        <tr>
                <td align="center" bgcolor="#e9ecef">
                    <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
            <tr>
            <td align="center" valign="top" width="600">
            <![endif]-->
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="left" bgcolor="#d4dadf" style="text-align:center;padding: 15px 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                                <a href="<?php echo admin_url( "admin-ajax.php?action=cancel&token={$appointment->delete_token}" ) ?>" style="font-size:15px;color:red;">
                                    <?php _e( 'Cancel appointment', 'appointments' ) ?>
                                </a>
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
    <!-- end body -->

</body>

</html>