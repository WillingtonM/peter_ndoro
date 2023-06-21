<?php
require 'phpmailer.php';

function user_feedback($to, $data = array())
{
  global $social_media;
  $output = '';
  $output .= '<h4 style=""><span style="font-weight: normal;">Hello</span> ' . $to . ',</h4>';
  $output .= '<p>Thank you for your feedback, I will get in touch with you shortly if there is a need to do so </p>';

  $output .= '<h4>The Following message has been captured :</h4>';
  $output .= '<p>' . $data['message'] . '</p>';
  $output .= '<br>';
  $output .= '<p>Let\'s catch up on &nbsp; | &nbsp; ';
  foreach ($social_media as $key => $social) :
    $output .= '<a href="' . $social['link'] . '">' . $social['name'] . '</a> &emsp;';
  endforeach;
  $output .= '<br>';
  $output .= '<p>Regards,</p>';
  $output .= $_ENV['MAIL_USER'];
  $output .= '<br>';

  return $output;
}

function user_feedback_notifify($to, $data = array())
{

  $output = '';
  $output .= '<h4 style=""><span style="font-weight: normal;">Hello</span> ' . $to . ',</h4>';
  $output .= '<p>There is a new feedback message from your website</p>';

  $output .= '<h4>The Following information has been captured :</h4>';

  $output .= '<table style="border: 1px solid #aaa; text-align/: center; border-radius: 7px; padding: 15px;"><tbody>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Name</th>';
  $output .= '<td style="padding: 3px;">' . $data['name'] . '</td>';
  $output .= '<tr>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Email</th>';
  $output .= '<td style="padding: 3px;">' . $data['email'] . '</td>';
  $output .= '<tr>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Message</th>';
  $output .= '<td style="padding: 3px;">' . $data['message'] . '</td>';
  $output .= '<tr>';

  $output .= '</tbody></table>';
  $output .= '<br>';

  return $output;
}

function quote_notification ($data) {
  global $social_media;
  ob_start();
?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="<?= PROJECT_LOGO ?>">
    <link rel="canonical" href="<?= $_SERVER['REQUEST_URI'] ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

  <body>
    <div style="background: white; padding: 25px;">

      <article>
        <p style='margin-right:-19.25pt;margin-left:-19.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:normal;text-align:center;'>
          <center>
            <table style="border-collapse:collapse;border:none;">
              <tbody>
                <tr style="padding: 5px;">
                  <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                      <span style="font-size: 14.0pt; line-height: 107%;">Hello <?= ((!isset($data['name']) && !empty($data['name'])) ? ' ' . $data['name'] : ((isset($data['last_name']) && !empty($data['last_name']))? $data['last_name']: '')) ?>,</span>
                    </p>
                    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</p>
                    <?php if (isset($data['code'])) : ?>
                      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Arial",sans-serif;color:#222222'> Here is your Parcel Tracking Number </span></p>
                      <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>
                      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:25px;font-family:"Calibri",sans-serif;'><span style='font-family:"Arial",sans-serif;color:#222222'> <b><?= $data['code'] ?></b> &nbsp;</span></p>
                      <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>
                      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Arial",sans-serif;color:#222222'> Use the link below to track your parcel: &nbsp;</span></p>
                      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Arial",sans-serif;color:#222222'>  <?= $data['code_link'] ?> </span></p>
                    <?php endif; ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </center>
        </p>
      </article>

      <article>
        <p style='margin-right:-19.25pt;margin-left:-19.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:normal;text-align:center;'>
          <center>
            <table style="border-collapse:collapse;border:none;">
              <tbody>
                <tr style="padding: 5px;">
                  <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</p>
                    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Arial",sans-serif;color:#222222'>You can contact us this email: <a href="<?= $_ENV['MAIL_MAIL'] ?>"><?= $_ENV['MAIL_MAIL'] ?></a>&nbsp;</span></p>
                    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                      <span style='font-family:"Arial",sans-serif;color:#222222;'>Or reach us from social media: <br> </span>

                      <?php foreach ($social_media as $key => $social) : ?>
                        <a class="" style="font-size: .9rem; padding-right: 7px" href="<?= $social['link'] ?>" target="_blank"> <?= $social['name'] ?> </a>
                      <?php endforeach; ?>

                    </p>
                    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</p>
                    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'> <span style='font-family:"Arial",sans-serif;color:#222222'>Thanks,<br><?= PROJECT_TITLE ?> </span> </p>
                  </td>
                </tr>
              </tbody>
            </table>
          </center>
        </p>
      </article>

      <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>

      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:12px;font-family:"Calibri",sans-serif;text-align:center;'>
        <span style="color:#262626;">Please note that this is an automated email. Emails sent to this address may not be attended.</span>
      </p>
      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:12px;font-family:"Calibri",sans-serif;text-align:center;'>
        <strong><span style="color:#262626;"><a href="<?= SERVER_HOST ?>" target="_blank"><span style="color:#262626;"><?= PROJECT_TITLE ?></span></a></span></strong>
        <span style="color:#262626;">&nbsp; &nbsp;| &nbsp; Powered by&nbsp;</span><span style="color:#ED7D31;"><a href="http://tda.tralon.co.za/" target="_blank"><span style="color:#ED7D31;">TDA</span></a></span>
        <span style="color:#262626;">.</span>
      </p>

    </div>
  </body>

  </html>

<?php
  $mail = ob_get_clean();

  return $mail;
}

function event_notification($data, $altdata = array())
{
  global $social_media;
  ob_start();
?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="<?= PROJECT_LOGO ?>">
    <link rel="canonical" href="<?= $_SERVER['REQUEST_URI'] ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

  <body>
    <div style="background: white; padding: 25px;">

      <article>
        <p style='margin-right:-19.25pt;margin-left:-19.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:normal;text-align:center;'>
          <center>
            <table style="border-collapse:collapse;border:none;">
              <tbody>
                <tr style="padding: 5px;">
                  <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                      <span style="font-size: 14.0pt; line-height: 107%;">Hello <?= ((isset($data['name']) && !empty($data['name'])) ? ' ' . $data['name'] : ((isset($data['last_name']) && !empty($data['last_name']))? $data['last_name']: '')) ?>,</span>
                    </p>
                    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</p>
                    <?php if (isset($data['message_text_1']) && !empty($data['message_text_1'])) : ?>
                      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Arial",sans-serif;color:#222222'> <?= $data['message_text_1'] ?> &nbsp;</span></p>
                    <?php endif; ?>

                    <?php if (isset($data['message_text_2']) && !empty($data['message_text_2'])) : ?>
                      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Arial",sans-serif;color:#222222'> <?= $data['message_text_2'] ?> &nbsp;</span></p>
                    <?php endif; ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </center>
        </p>
      </article>

      <?php if ( isset($data['message_type']) && $data['message_type'] == 'admin') : ?>
        <article style="background: #e2dfdf; padding: 25px; border-radius: 25px; border: 1px solid #ddd;">
  
          <p style='margin-right:-19.25pt;margin-left:-19.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:normal;text-align:center;'>
            <center>
              <table style="border-collapse:collapse;border:none;">
                <tbody>
                  <tr style="padding: 5px 0;">
                    <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                      <table style="border-collapse:collapse;border:none;">
                        <tbody>
                          <?php if ( isset($data['name']) && !empty($data['name'])) : ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>Name</p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['name'] ?> </p>
                            </td>
                          </tr>
                          <?php endif; ?>
  
                          <?php if ( isset($data['last_name']) && !empty($data['last_name'])) : ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>Last Name</p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['last_name'] ?> </p>
                            </td>
                          </tr>
                          <?php endif; ?>
  
                          <?php if ( isset($data['email']) && !empty($data['email'])) : ?>
                            <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                              <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>Email</p>
                              </td>
                              <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['email'] ?> </p>
                              </td>
                            </tr>
                          <?php endif; ?>
                          
                          <?php if ( isset($data['contact']) && !empty($data['contact'])) : ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>Contact Number</p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['contact'] ?></p>
                            </td>
                          </tr>
                          <?php endif; ?>
  
                          <?php if (isset($data['alt_name']) && !empty($data['alt_name'])): ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                               Other Name
                              </p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                                <?= $data['alt_name'] ?>
                              </p>
                            </td>
                          </tr>
                          <?php endif; ?>
                          
                          <?php if (isset($data['alt_last_name']) && !empty($data['alt_last_name'])): ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                                Other Last Name
                              </p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p
                                style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                                <?= $data['alt_last_name'] ?>
                              </p>
                            </td>
                          </tr>
                          <?php endif; ?>
                          
                          <?php if (isset($data['alt_email']) && !empty(isset($data['alt_email']))): ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                                Other Email
                              </p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                                <?= $data['alt_email'] ?>
                              </p>
                            </td>
                          </tr>
                          <?php endif; ?>
                          
                          <?php if (isset($data['alt_contact']) && !empty($data['alt_contact'])): ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                                Other Contact Number</p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>
                                <?= $data['alt_contact'] ?>
                              </p>
                            </td>
                          </tr>
                          <?php endif; ?>
  
                          <?php if ( isset($data['company']) && !empty($data['company'])) : ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>Company Name</p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['company'] ?> </p>
                            </td>
                          </tr>
                          <?php endif; ?>
                          
                          <?php if ( isset($data['event_type']) && !empty($data['event_type'])) : ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> Type</p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['event_type'] ?> </p>
                            </td>
                          </tr>
                          <?php endif; ?>
  
                          <?php if ( isset($data['dell_address']) && !empty($data['description'])) : ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> Description</p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['description'] ?> </p>
                            </td>
                          </tr>
                          <?php endif; ?>
  
                          <?php if ( isset($data['coll_address']) && !empty($data['coll_address'])) : ?>
                            <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                              <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>Collection Address</p>
                              </td>
                              <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['coll_address'] ?> </p>
                              </td>
                            </tr>
                          <?php endif; ?>
  
                          <?php if ( isset($data['dell_address']) && !empty($data['dell_address'])) : ?>
                            <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                              <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>Delivery Address</p>
                              </td>
                              <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['dell_address'] ?> </p>
                              </td>
                            </tr>
                          <?php endif; ?>
  
                          <?php if ( isset($data['event_town']) && !empty($data['event_town'])) : ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> 
                                Town 
                              </p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> 
                                <?= $data['event_town'] ?> 
                              </p>
                            </td>
                          </tr>
                          <?php endif; ?>
  
                          <?php if ( isset($data['event_city']) && !empty($data['event_city'])) : ?>
                            <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                              <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>City</p>
                              </td>
                              <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['event_city'] ?> </p>
                              </td>
                            </tr>
                          <?php endif; ?>
  
                          <?php if ( isset($data['event_country']) && !empty($data['event_country'])) : ?>
                            <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                              <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'>Country</p>
                              </td>
                              <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                                <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['event_country'] ?> </p>
                              </td>
                            </tr>
                          <?php endif; ?>
                          
                          <?php if ( isset($data['event_date']) && !empty($data['event_date'])) : ?>
                          <tr style="border-bottom: 1px solid #eee; padding: 12px 0;">
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> Date </p>
                            </td>
                            <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                              <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['event_date'] ?> </p>
                            </td>
                          </tr>
                          <?php endif; ?>
  
                        </tbody>
                      </table>
                    </td>
                  </tr>
  
                  <?php if ( isset($data['message']) && !empty($data['message'])) : ?>
                  <tr>
                    <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>
                    <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'>
                      <span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>  The following message was submitted:</span>
                    </p>
                    <p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:-5.65pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;'> <?= $data['message'] ?> </p>
                  </tr>
                  <?php endif; ?>
                </tbody>
              </table>
  
            </center>
          </p>
  
        </article>
      <?php endif; ?>

      <?php if ( isset($data['message_type']) && $data['message_type'] != 'admin') : ?>
        <article>
          <p style='margin-right:-19.25pt;margin-left:-19.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:normal;text-align:center;'>
            <center>
              <table style="border-collapse:collapse;border:none;">
                <tbody>
                  <tr style="padding: 5px;">
                    <td style="width: 225.4pt;padding: 0cm 5.4pt;vertical-align: top;">
                      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</p>
                      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Arial",sans-serif;color:#222222'>If you don&rsquo;t hear from me within 48 hours, you may email me on: <a href="<?= $_ENV['MAIL_MAIL'] ?>"><?= $_ENV['MAIL_MAIL'] ?></a>&nbsp;</span></p>
                      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>
                        <span style='font-family:"Arial",sans-serif;color:#222222;'>Or reach me from social media: <br> </span>
  
                        <?php foreach ($social_media as $key => $social) : ?>
                          <a class="" style="font-size: .9rem; padding-right: 7px" href="<?= $social['link'] ?>" target="_blank"> <?= $social['name'] ?> </a>
                        <?php endforeach; ?>
  
                      </p>
                      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</p>
                      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'> <span style='font-family:"Arial",sans-serif;color:#222222'>Thanks,<br><?= PROJECT_TITLE ?> </span> </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </center>
          </p>
        </article>
      <?php endif; ?>

      <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>

      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:12px;font-family:"Calibri",sans-serif;text-align:center;'>
        <span style="color:#262626;">Please note that this is an automated email. Emails sent to this address may not be attended.</span>
      </p>
      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:12px;font-family:"Calibri",sans-serif;text-align:center;'>
        <strong><span style="color:#262626;"><a href="<?= SERVER_HOST ?>" target="_blank"><span style="color:#262626;"><?= PROJECT_TITLE ?></span></a></span></strong>
        <span style="color:#262626;">&nbsp; &nbsp;| &nbsp; Powered by&nbsp;</span><span style="color:#ED7D31;"><a href="http://tda.tralon.co.za/" target="_blank"><span style="color:#ED7D31;">TDA</span></a></span>
        <span style="color:#262626;">.</span>
      </p>

    </div>
  </body>
  </html>

<?php
  $mail = ob_get_clean();

  return $mail;
}

function user_event($to, $data = array())
{
  global $social_media;
  $output = '';
  $output .= '<h4 style=""><span style="font-weight: normal;">Hello</span> ' . $to . ',</h4>';
  $output .= '<p>Thank you for booking with us. We will get in touch with you shortly if there is a need to do so </p>';

  $output .= '<h4>The Following information has been recieved :</h4>';

  $output .= '<table style="border: 1px solid #aaa; text-align/: center; border-radius: 7px; padding: 15px;"><tbody>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Name</th>';
  $output .= '<td style="padding: 3px;">' . $data['name'] . '</td>';
  $output .= '<tr>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Address</th>';
  $output .= '<td style="padding: 3px;">' . $data['address'] . '</td>';
  $output .= '<tr>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Description</th>';
  $output .= '<td style="padding: 3px;">' . $data['description'] . '</td>';
  $output .= '<tr>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Message</th>';
  $output .= '<td style="padding: 3px;">' . $data['message'] . '</td>';
  $output .= '<tr>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;"> Date</th>';
  $output .= '<td style="padding: 3px;">' . $data['event_date'] . '</td>';
  $output .= '<tr>';

  $output .= '</tbody></table>';
  $output .= '<br>';

  // $output .= '<br>';
  // $output .= '<p>You can also find me on &nbsp; | &nbsp; ';
  // foreach ($social_media as $key => $social) :
  //   $output .= '<a href="' . $social['link'] . '"> <img height="24px" src="' . $social['lnk2'] . '" alt="">  &nbsp; ' . $social['name'] . '</a> &emsp;';
  // endforeach;
  $output .= '<br>';
  $output .= '<p>Regards,</p>';
  $output .= $_ENV['MAIL_USER'];
  $output .= '<br>';

  return $output;
}

function user_event_notifify($to, $data = array())
{

  $output = '';
  $output .= '<h4 style=""><span style="font-weight: normal;">Hello</span> ' . $to . ',</h4>';
  $output .= '<p>There is a new event booking from your website</p>';

  $output .= '<h4>The Following information has been captured :</h4>';

  $output .= '<table style="border: 1px solid #aaa; text-align/: center; border-radius: 7px; padding: 15px;"><tbody>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Name</th>';
  $output .= '<td style="padding: 3px;">' . $data['name'] . '</td>';
  $output .= '<tr>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Email</th>';
  $output .= '<td style="padding: 3px;">' . $data['email'] . '</td>';
  $output .= '<tr>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Address</th>';
  $output .= '<td style="padding: 3px;">' . $data['address'] . '</td>';
  $output .= '<tr>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Description</th>';
  $output .= '<td style="padding: 3px;">' . $data['description'] . '</td>';
  $output .= '<tr>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Message</th>';
  $output .= '<td style="padding: 3px;">' . $data['message'] . '</td>';
  $output .= '<tr>';

  $output .= '<tr style="border: 1px solid #aaa; padding: 3px;">';
  $output .= '<th style="padding: 3px;">Date</th>';
  $output .= '<td style="padding: 3px;">' . $data['event_date'] . '</td>';
  $output .= '<tr>';

  $output .= '</tbody></table>';
  $output .= '<br>';

  return $output;
}

function email_subscription($to, $data = array())
{

?>

  <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;'>&nbsp;</p>
  <div>
    <center style="background:#F2F2F2; border-radius: 25px">
      <table style="background:#F2F2F2;border-collapse:collapse;border:none;">
        <tbody>
          <tr>
            <td style="width: 450.8pt;padding: 0cm 5.4pt;vertical-align: top;">
              <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;'>&nbsp;</p>
              <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;'><span style="color:black;">Dear <?= $to ?>,</span></p>
              <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;'>&nbsp;</p>
              <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;'><span style="color:black;">Thanks for subscribing to my newsletter. I hope you enjoy my weekly insights on the economics of climate change, commodities and other exciting areas.</span></p>
              <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;'>&nbsp;</p>
              <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;'><span style="color:black;">Please connect on <a href="https://twitter.com/GraceBaskaran">Twitter</a> and <a href="https://www.linkedin.com/in/gracelinbaskaran/">LinkedIn</a> and don&apos;t hesitate to get in touch!</span></p>
              <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;'>&nbsp;</p>
              <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;'><span style="color:black;">Best,</span><br><span style="color:black;">Gracelin<br>&nbsp;</span></p>
            </td>
          </tr>
        </tbody>
      </table>
    </center>
  </div>
  <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;border:none;border-bottom:solid #A6A6A6 1.0pt;padding:0cm 0cm 1.0pt 0cm;'>
    <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;border:none;padding:0cm;'>&nbsp;</p>
  </div>
  <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:105%;text-align:center;background:white;'><span style="font-size:12px;line-height:105%;color:#44546A;">This message was sent to &nbsp;&nbsp;</span><span style="color:black;"><a href="mailto:<?= $data['email'] ?>" target="_blank"><span style="font-size:12px;line-height:105%;color:#44546A;"><?= $data['email'] ?> &nbsp;</span></a></span><span style="font-size:12px;line-height:105%;color:#44546A;">&nbsp;from our subscription emailing list.<br>&nbsp;If you would like to unsubscribe, click&nbsp;</span><span style="color:black;"><a href="<?= ((isset($data['url_reset']) && !empty($data['url_reset'])) ? $data['url_reset'] : '') ?>" target="_blank"><span style="font-size:12px;line-height:105%;color:#44546A;">Unsubscribe&nbsp;</span></a></span><span style="font-size:12px;line-height:105%;color:#44546A;">.&nbsp;</span></p>
  <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;'>&nbsp;</p>
<?php
  $mail = ob_get_clean();

  return $mail;
}

function email_subscription_notify($to, $data = array())
{
  $output = '';
  $output .= '<h4 style=""><span style="font-weight: normal;">Hello</span> ' . $to . ',</h4>';
  $output .= '<p>There is a new <b>email subscription</b> to <b>' . PROJECT_TITLE . '\'s</b> newsletter. </p>';

  $output .= '<h4>The Following information has been captured :</h4>';
  $output .= '<p>Full Name &emsp; | ' . ((isset($data['name'])) ? $data['name'] : '') . '</p>';
  $output .= '<p>User Email &emsp; | ' . ((isset($data['email'])) ? $data['email'] : '') . '</p>';
  $output .= '<br>';

  return $output;
}

function confirmation_mail($to, $data = array())
{
  // style
  $output = '';
  $output .= '<style media="screen">';
  $output .= '.btn_ {text-decoration: none;cursor: pointer;display: inline-block;margin: 0;height: auto;border: 1px solid #40e0d0;vertical-align: middle;-webkit-appearance: none;color: inherit;background-color: #40e0d0;}';
  $output .= '.btn_:hover {text-decoration: none;background-color: #2BBBAD;color: #fff}';
  $output .= '.btn_:focus {outline: none;border-color: #00695c;box-shadow: 0 0 0 3px #ddd;}';
  $output .= '::-moz-focus-inner {border: 0;padding: 0;}';
  $output .= '.btn-primary_ {color: #ddd;background-color: #01baa3 /* #00695c*/;border-radius: 7px;}';
  $output .= '.btn-primary_:hover {box-shadow: inset 0 0 0 20rem var(--darken-1);}';
  $output .= '.btn-primary_:active {box-shadow: inset 0 0 0 20rem var(--darken-2),  inset 0 3px 4px 0 var(--darken-3),  0 0 1px var(--darken-2);}';
  $output .= '.btn-primary_:focus{background-color: #00695c;outline: none;border-color: #00695c;box-shadow: 0 0 0 3px #ddd;}';
  $output .= '';
  $output .= '</style>';

  // body content
  $output .= '<div>';
  $output .= '<center>';
  $output .= '<h4>Hello ' . $to . '</h4>';
  $output .= '<p>' . $data["message"] . '</p>';
  $output .= '<h3>';
  $output .= '<a href="' . $data['url'] . '" class="btn_ btn-primary_" target="_blank" style="color: #777777; border: 1px solid #ddd; padding: 3px 25px; border-radius: 7px;">';
  $output .= '<span type="" name="button">Confirm</span>';
  $output .= '</a> ';
  $output .= '</h3>';
  $output .= '</center>';
  $output .= '</div>';
  $output .= '';

  return $output;
}

function general_mail($data = array())
{
  global $social_media;
  ob_start();

  $req_res = $data['mail_data'];

?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="<?= PROJECT_LOGO ?>">
    <link rel="canonical" href="<?= $_SERVER['REQUEST_URI'] ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

  <body>

    <div style="background: white; padding: 25px;">

      <p style="text-align: center; margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;" align="center">
        <span style="font-size: 14.0pt; line-height: 107%;">Dear<?= ((!empty($data['name'])) ? ' ' . ucfirst($data['name']) : '') ?>,</span>
      </p>
      <p style="text-align: center; margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;" align="center">&nbsp;</p>

      <div align="center">
        <?= PAGE_SETTINGS['setting_email_header']  ?>
      </div>

      <p style="text-align: center; margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;" align="center">&nbsp;</p>

      <article style="background: #e2dfdf; padding: 25px; border-radius: 25px; border: 1px solid #ddd;">
        <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:normal;text-align:center;'>
          <strong><span style='font-size:22px;font-family:"Lato",serif;color:#44546A;'> <?= ((!empty($data['title']) && $data['title'] != '') ? html_entity_decode($data['title']) : '') ?> </span></strong>
        </p>
        <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'>
          <?php if (isset($data['date']) && $data['date'] != '') : ?>
            <em><span style='font-size:13px;font-family:"Segoe UI",sans-serif;color:#44546A;'>Published on</span></em>
            <em><span style='font-size:13px;font-family:"Segoe UI",sans-serif;color:#212529;'>&nbsp; &nbsp;</span></em>
            <span style='font-size:13px;font-family:"Segoe UI",sans-serif;color:#C55A11;'>
              <a href="" target="_blank">
                <span style="color:#C55A11;"> <?= $data['date'] ?> </span>
              </a>&nbsp;
            </span>
          <?php endif; ?>
          <span style='font-size:13px;font-family:"Segoe UI",sans-serif;color:#44546A;'>&nbsp; | &nbsp; <em>by</em>&nbsp; &nbsp; <strong> <?= PROJECT_TITLE ?> <?= ($data['author'] != '') ? ', ' . $data['author'] : '' ?> </strong> </span>
        </p>

        <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>&nbsp;</span></p>

        <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'>
          <span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#212529;'>
            <?php if (isset($data['image']) && !empty($data['image'])) : ?>
              <img style="border: 2px solid #ddd; padding 3px; border-radius: 25px;" height="350" src="<?= $data['image'] ?>" alt="Article image">
            <?php endif; ?>
            <div class="" align="center">
              <?php if (isset($req_res['article_source']) && $req_res['article_source'] != '') : ?>
                <small class="text-muted"> <?= $req_res['article_source'] ?></small>
              <?php endif; ?>
            </div>
          </span>
        </p>

        <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>&nbsp;</span></p>
        <?php if (!empty($data['message'])) : ?>
          <p style='margin-right:-19.25pt;margin-left:-19.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:normal;text-align:center;'>
            <!-- article content -->
            <center>
              <table>
                <tbody>
                  <tr>
                    <td>
                      <?= $data['message'] ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </center>
          </p>
        <?php endif; ?>

        <?php if (isset($data["url_info"]) && !empty($data["url_info"])) : ?>
          <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'>
            <span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#C55A11;'>
              <a href="<?= ((isset($data["url_info"]["url_link"])) ? $data["url_info"]["url_link"] : "") ?>">
                <span style="color:#C55A11;"><?= ((isset($data["url_info"]["url_title"])) ? $data["url_info"]["url_title"] : 'Link') ?> </span>
              </a>
            </span>
          </p>
        <?php endif; ?>

        <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>

        <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>

        <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;'>
          <span style="color:#44546A;">Follow me on social media:</span>
        </p>

        <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;'>
        <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;'>
          <?php foreach ($social_media as $key => $social) : ?>
            <span><a href="<?= $social['link'] ?>"><span style="color:#44546A;"> <img height="24" width="24" src="<?= $social['lnk2'] ?>" style="height: 24px; width: 24px;" alt=""> &nbsp; <?= ucfirst($key) ?> </span> </a></span> &emsp;
          <?php endforeach; ?>
        </p>

        <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;'>
        <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;border-top:none;border-left:none;border-bottom:dotted #AEAAAA 1.0pt;padding:0cm 4.0pt 1.0pt 0cm;'>
          <?= PAGE_SETTINGS['setting_email_footer'] ?>
        </div>

        <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>

        <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
          <span style="font-size:12px;line-height:107%;color:#44546A;">This message was sent to &nbsp;
            <a href="mailto:<?= $data['email'] ?>" target="_blank" rel="noopener"><span style="color:#44546A;"> <?= $data['email'] ?> &nbsp;</span></a>
            from our subscription emailing list.<br> If you would like to unsubscribe, click
            <a href="<?= ((isset($data['url_info']['url_reset']) && !empty($data['url_info']['url_reset'])) ? $data['url_info']['url_reset'] : '') ?>" target="_blank"><span style="color:#44546A;">Unsubscribe&nbsp;</span></a>.
          </span>
        </p>

      </article>

      <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>

      <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
        <strong><span style="color:#262626;"><a href="<?= SERVER_HOST ?>" target="_blank"><span style="color:#262626;"><?= PROJECT_TITLE ?></span></a></span></strong>
        <span style="color:#262626;">&nbsp; &nbsp;| &nbsp; Powered by&nbsp;</span><span style="color:#ED7D31;"><a href="http://tda.tralon.co.za/" target="_blank"><span style="color:#ED7D31;">TDA</span></a></span>
        <span style="color:#262626;">.</span>
      </p>

    </div>

  </body>
  </html>

<?php
  $mail = ob_get_clean();

  return $mail;
}

function main_general_mail($data = array())
{
  global $social_media;
  ob_start();

  ?>

    <!DOCTYPE html>
    <html lang="en" dir="ltr">

    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
      <link rel="shortcut icon" href="<?= PROJECT_LOGO ?>">
      <link rel="canonical" href="<?= $_SERVER['REQUEST_URI'] ?>">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>

      <div style="background: white; padding: 25px;">

        <p style="text-align: center; margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;" align="center">
          <span style="font-size: 14.0pt; line-height: 107%;">Dear<?=((!empty($data['name'])) ? ' ' . ucfirst($data['name']) : '') ?>,</span>
        </p>
        <p style="text-align: center; margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;" align="center">&nbsp;</p>

        <p style='text-align: center; margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'>&nbsp;</p>
        <?php if (isset($data['message_text_1'])) : ?>
          <p style='text-align: center; margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Arial",sans-serif;color:#222222'> <?= $data['message_text_1'] ?> &nbsp;</span></p>
        <?php endif; ?>

        <?php if (isset($data['message_text_2'])) : ?>
          <p style='text-align: center; margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Arial",sans-serif;color:#222222'> <?= $data['message_text_2'] ?> &nbsp;</span></p>
        <?php endif; ?>

        <?php if (!empty($data['message'])): ?>
          <p style='margin-right:-19.25pt;margin-left:-19.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:normal;text-align:center;'>
            <center>
              <table>
                <tbody>
                  <tr>
                    <td>
                      <?= $data['message'] ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </center>
          </p>
        <?php endif; ?>

        <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;'>
        <center>
          <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;border-top:none;border-left:none;border-bottom:dotted #AEAAAA 1.0pt;padding:0cm 4.0pt 1.0pt 0cm;'>
          <?= PAGE_SETTINGS['setting_email_footer'] ?>
        </div>
        </center>

        <p style="text-align: center; margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;" align="center">&nbsp;</p>

        <article style="background: #e2dfdf; padding: 25px; border-radius: 25px; border: 1px solid #ddd;">
          <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>

          <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;'>
            <span style="color:#44546A;">Follow me on social media:</span>
          </p>

          <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;'>
          <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;'>
            <?php foreach ($social_media as $key => $social): ?>
                <span><a href="<?= $social['link'] ?>"><span style="color:#44546A;"> <img height="24" width="24" src="<?= $social['lnk2'] ?>" style="height: 24px; width: 24px;" alt=""> &nbsp; <?= ucfirst($key) ?> </span> </a></span> &emsp;
              <?php endforeach; ?>
          </p>

          <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>

          <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
            <span style="font-size:12px;line-height:107%;color:#44546A;">This message was sent to &nbsp;
              <a href="mailto:<?= $data['email'] ?>" target="_blank" rel="noopener"><span style="color:#44546A;"> <?= $data['email'] ?> &nbsp;</span></a>.
            </span>
          </p>

        </article>

        <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>

        <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
          <strong><span style="color:#262626;"><a href="<?= SERVER_HOST ?>" target="_blank"><span style="color:#262626;"><?= PROJECT_TITLE ?></span></a></span></strong>
          <span style="color:#262626;">&nbsp; &nbsp;| &nbsp; Powered by&nbsp;</span><span style="color:#ED7D31;"><a href="http://tda.tralon.co.za/" target="_blank"><span style="color:#ED7D31;">TDA</span></a></span>
          <span style="color:#262626;">.</span>
        </p>

      </div>

    </body>
    </html>
  <?php
  $mail = ob_get_clean();

  return $mail;
}

