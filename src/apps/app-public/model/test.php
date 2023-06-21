<?php

$article_id     = 5;
$article_pubdate = date('Y-m-d H:i:s');
$article_title   = 'The best has arrived to the crown of its own';
$article_author  = "Gracelin Baskaran";

ob_start();

?>

<p style='margin-top:0cm;margin-right:0cm;margin-bottom:8.0pt;margin-left:0cm;line-height:107%;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;'><span style='font-size:16px;line-height:107%;font-family:"Segoe UI",sans-serif;color:#595959;'>Following Minister Tito Mboweni&rsquo;s maiden budget speech, economists and analysts are split on whether South Africa will once again avoid a credit rating downgrade to sub investment grade by Moody&rsquo;s when it issues its rating review on the 29th of March. Those that believe that Moody&rsquo;s will downgrade the country&rsquo;s remaining investment grade rating cite the deterioration in the fiscal position. I believe Moody&rsquo;s will neither change the stable outlook nor downgrade the credit rating on the 9th of March.</span></p>

<?php

$article_post   = ob_get_clean();

$article_type   = 'article';
$article_slg    = $slugify->slugify($article_title);

$url            = '/article?article=' . $article_slg . '&slgid=' . $article_id . '&type=' . $article_type;
// $url_title      = "New Article";
$message        = short_paragrapth($article_post, 2500);
$message        = $article_post;

$subject        = PROJECT_TITLE . ' | ' . html_entity_decode($article_title, ENT_QUOTES, "UTF-8");
$from           = MAIL_FROM;

// $artcl_date     = DateTime::createFromFormat('Y-m-d H:i:s', $article_pubdate);
$artcl_date     = DateTime::createFromFormat('Y-m-d', $article_pubdate);


$mail_data      = array(
    "name"        => '',
    "email"       => '',
    "url_info"    => array(
        "url_title" => 'Read more ...',
        "url_link"  => host_url($url),
        "url_reset" => ''
    ),
    "message"     => $message,
    "title"       => html_entity_decode($article_title, ENT_QUOTES, "UTF-8"),
    "author"      => $article_author,
    "date"        => (string) $article_pubdate,
    "image"       => 'img/articles/article/IMGIM2020042222170355.jpg',
);

$full_name      = "Willinfron Mhlanga ";
$url_reset      = '/action?&distroy=true&mail=user@mail.com';


$mail_data['name']  = $full_name;
$mail_data['email'] = 'user@mail.com';
$mail_data['url_info']['url_reset'] = host_url($url_reset);

$data = $mail_data;