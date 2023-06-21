<br><br><br><br>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="<?= PROJECT_LOGO ?>">
    <link rel="canonical" href="<?= $_SERVER['REQUEST_URI'] ?>">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.iconmonstr.com/1.3.0/css/iconmonstr-iconic-font.min.css">
</head>

<body>

    <div style="background: white; padding: 25px;">

        <p style="text-align: center; margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;" align="center">
            <span style="font-size: 14.0pt; line-height: 107%;">Hello<?= ((!empty($data['name'])) ? ' ' . $data['name'] : '') ?>,</span>
        </p>
        <p style="text-align: center; margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;" align="center">&nbsp;</p>

        <p style="text-align: center; margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;" align="center"><span style="color: #44546A; font-size: 18px;">I have published a new article, please read, comment and share !</span> </p>

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

            <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#212529;'>
                    <?php if (isset($data['image']) && !empty($data['image'])) : ?>
                        <img style="border: 2px solid #ddd; padding 3px; border-radius: 25px;" height="350" src="<?= $data['image'] ?>" alt="Article image"></span>
            <?php endif; ?>
            </p>

            <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Times New Roman",serif;'>&nbsp;</span></p>
            <?php if (!empty($data['message'])) : ?>
                <p style='margin-right:-19.25pt;margin-left:-19.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:normal;text-align:center;'>
                    <!-- article content -->
                    <center>
                        <?= $data['message'] ?>
                    </center>
                </p>
            <?php endif; ?>

            <?php if (isset($data["url_info"]) && !empty($data["url_info"])) : ?>


                <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'>
                    <span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#C55A11;'>
                        <a href="<?= ((isset($data["url_info"]["url_link"])) ? $data["url_info"]["url_link"] : "") ?>">
                            <span style="color:#C55A11;"><?= ((isset($data["url_info"]["url_title"])) ? $data["url_info"]["url_title"] : 'Link') ?> &hellip;</span>
                        </a>
                    </span>
                </p>
            <?php endif; ?>

            <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>

            <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>

            <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;'>
                <span style="color:#44546A;">Follow me on Social media:</span>
            </p>

            <p style='margin-right:-11.25pt;margin-left:-11.25pt;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:0cm;line-height:normal;text-align:center;'><span style='font-size:16px;font-family:"Segoe UI",sans-serif;color:#555555;'>&nbsp;</span></p>
            <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;'>
                <?php foreach ($social_media as $key => $social) : ?>
                    <span><a href="<?= $social['link'] ?>"><span style="color:#44546A;"> <img height="24px" src="<?= $social['lnk2'] ?>" alt="">  &nbsp; <?=$key?> </span> </a></span> &emsp;
                <?php endforeach; ?>
            </p>

            <div style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;border-top:none;border-left:none;border-bottom:dotted #AEAAAA 1.0pt;padding:0cm 4.0pt 1.0pt 0cm;'>
                <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;border:none;padding:0cm;'><span style="color:#44546A;">&nbsp;</span></p>
                <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;border:none;padding:0cm;'><span style="color:#44546A;">Best regards,</span></p>
                <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;text-align:center;border:none;padding:0cm;'><span style="color:#44546A;"><?= PROJECT_TITLE ?></span></p>
                <p style='margin-right:0cm;margin-left:0cm;font-size:15px;font-family:"Calibri",sans-serif;margin-top:0cm;margin-bottom:8.0pt;line-height:107%;border:none;padding:0cm;'><span style="color:#44546A;">&nbsp;</span></p>
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
            <span style="color:#262626;">Please do not reply to this message. Emails sent to this address will not be attended.</span>
        </p>
        <p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'>
            <strong><span style="color:#262626;"><a href="<?= SERVER_HOST ?>" target="_blank"><span style="color:#262626;"><?= PROJECT_TITLE ?></span></a></span></strong>
            <span style="color:#262626;">&nbsp; &nbsp;| &nbsp; Powered by&nbsp;</span><span style="color:#ED7D31;"><a href="http://tda.tralon.co.za/" target="_blank"><span style="color:#ED7D31;">Tralon Digital Agency</span></a></span>
            <span style="color:#262626;">.</span>
        </p>

    </div>

</body>
<footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</footer>

</html>