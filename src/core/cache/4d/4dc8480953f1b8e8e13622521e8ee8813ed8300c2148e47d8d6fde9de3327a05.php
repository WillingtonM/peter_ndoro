<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* order_invoice.php */
class __TwigTemplate_a88900f643af8479826626e2e144b3377731bc1c6575654c93c668a063b8b539 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "  <!DOCTYPE html>
  <html lang=\"en\">

  <head>
    <meta charset=\"utf-8\">
    <title>Invoice <?= \$data['order_data']['order_id'] ?></title>
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <style>
      @import url(\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\");

      @import url(\"https://fonts.googleapis.com/css?family=Tangerine|Inconsolata|Droid+Sans\");

      html,
      body,
      div,
      span,
      applet,
      object,
      iframe,
      h1,
      h2,
      h3,
      h4,
      h5,
      h6,
      p,
      blockquote,
      pre,
      a,
      abbr,
      acronym,
      address,
      big,
      cite,
      code,
      del,
      dfn,
      em,
      img,
      ins,
      kbd,
      q,
      s,
      samp,
      small,
      strike,
      strong,
      sub,
      sup,
      tt,
      var,
      b,
      u,
      i,
      center,
      dl,
      dt,
      dd,
      ol,
      ul,
      li,
      fieldset,
      form,
      label,
      legend,
      table,
      caption,
      tbody,
      tfoot,
      thead,
      tr,
      th,
      td,
      article,
      aside,
      canvas,
      details,
      embed,
      figure,
      figcaption,
      footer,
      header,
      hgroup,
      menu,
      nav,
      output,
      ruby,
      section,
      summary,
      time,
      mark,
      audio,
      video {
        margin: 0;
        padding: 0;
        border: 0;
        font: inherit;
        font-size: 100%;
        vertical-align: baseline;
      }

      ol,
      ul {
        list-style: none;
      }

      /* table {
        border-collapse: collapse;
        border-spacing: 0;
      } */

      caption,
      th,
      td {
        text-align: left;
        font-weight: normal;
        vertical-align: middle;
      }

      q,
      blockquote {
        quotes: none;
      }

      q:before,
      q:after,
      blockquote:before,
      blockquote:after {
        content: \"\";
        content: none;
      }

      a img {
        border: none;
      }

      article,
      aside,
      details,
      figcaption,
      figure,
      footer,
      header,
      hgroup,
      main,
      menu,
      nav,
      section,
      summary {
        display: block;
      }

      .clearfix {
        display: block;
        clear: both;
      }

      .hidden {
        display: none;
      }

      b,
      strong,
      .bold {
        font-weight: bold;
      }

      #invoice_container {
        font: normal 13px/1.4em 'Open Sans', Sans-serif;
        margin: 0 auto;
        color: #5B6165;
      }

      #memo {
        padding-top: 50px;
        margin: 0 110px 0 60px;
        border-bottom: 1px solid #ddd;
        height: 115px;
      }

      #memo .logo {
        float: left;
        margin-right: 20px;
      }

      #memo .logo img {
        width: 100px;
      }

      #memo .company-info {
        float: right;
        text-align: right;
      }

      #memo .company-info>div:first-child {
        line-height: 1em;
        font-weight: bold;
        font-size: 22px;
        color: #B32C39;
      }

      #memo .company-info span {
        font-size: 11px;
        display: inline-block;
        min-width: 20px;
      }

      #memo:after {
        content: '';
        display: block;
        clear: both;
      }

      #invoice-title-number {
        font-weight: bold;
        margin: 30px 0;
      }

      #invoice-title-number span {
        line-height: 0.88em;
        display: inline-block;
        min-width: 20px;
      }

      #invoice-title-number #title {
        text-transform: uppercase;
        padding: 0px 2px 0px 60px;
        font-size: 50px;
        background: #F4846F;
        color: white;
      }

      #invoice-title-number #number {
        margin-left: 10px;
        font-size: 35px;
        position: relative;
        top: -5px;
      }

      #client-info {
        float: left;
        margin-left: 60px;
        min-width: 220px;
      }

      #client-info>div {
        margin-bottom: 3px;
        min-width: 20px;
      }

      #client-info span {
        display: block;
        min-width: 20px;
      }

      #client-info>span {
        text-transform: uppercase;
      }

      table {
        table-layout: fixed;
      }

      table th,
      table td {
        vertical-align: top;
        word-break: keep-all;
        word-wrap: break-word;
      }

      #items {
        margin: 35px 30px 0 30px;
      }

      #items .first-cell,
      #items table th:first-child,
      #items table td:first-child {
        width: 40px !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
        text-align: right;
      }

      #items table {
        border-collapse: separate;
        width: 100%;
      }

      #items table th {
        font-weight: bold;
        padding: 5px 8px;
        text-align: right;
        background: #B32C39;
        color: white;
        text-transform: uppercase;
      }

      #items table th:nth-child(2) {
        width: 30%;
        text-align: left;
      }

      #items table th:last-child {
        text-align: right;
      }

      #items table td {
        padding: 9px 8px;
        text-align: right;
        border-bottom: 1px solid #ddd;
      }

      #items table td:nth-child(2) {
        text-align: left;
      }

      #sums {
        margin: 25px 30px 0 0;
      }

      #sums table {
        float: right;
      }

      #sums table tr th,
      #sums table tr td {
        min-width: 100px;
        padding: 9px 8px;
        text-align: right;
      }

      #sums table tr th {
        background-color: #B32C39;
        color: white;
        font-weight: bold;
        text-align: left;
        padding-right: 35px;
      }

      #sums table tr td.last {
        min-width: 0 !important;
        max-width: 0 !important;
        width: 0 !important;
        padding: 0 !important;
        border: none !important;
      }

      #sums table tr.amount-total th {
        text-transform: uppercase;
      }

      #sums table tr.amount-total th,
      #sums table tr.amount-total td {
        font-size: 15px;
        font-weight: bold;
      }

      #sums table tr:last-child th {
        text-transform: uppercase;
      }

      #sums table tr:last-child th,
      #sums table tr:last-child td {
        font-size: 15px;
        font-weight: bold;
      }

      #invoice-info {
        float: left;
        margin: 50px 40px 0 60px;
      }

      #invoice-info>div>span {
        display: inline-block;
        min-width: 20px;
        min-height: 18px;
        margin-bottom: 3px;
      }

      #invoice-info>div>span:first-child {
        color: black;
      }

      #invoice-info>div>span:last-child {
        color: #aaa;
      }

      #invoice-info:after {
        content: '';
        display: block;
        clear: both;
      }

      #terms {
        float: left;
        margin-top: 50px;
      }

      #terms .notes {
        min-height: 30px;
        min-width: 50px;
        color: #B32C39;
      }

      #terms .payment-info div {
        margin-bottom: 3px;
        min-width: 20px;
      }

      .thank-you {
        margin: 10px 0 30px 0;
        display: inline-block;
        min-width: 20px;
        text-transform: uppercase;
        font-weight: bold;
        line-height: 0.88em;
        /* float: right; */
        padding: 0px 30px 0px 2px;
        font-size: 50px;
        background: #F4846F;
        color: white;
      }

      .ib_bottom_row_commands {
        margin-left: 30px !important;
      }
    </style>
  </head>

  <body>
    ";
        // line 432
        $context["foo"] = "hello foo bar";
        // line 433
        echo "    <div id=\"invoice_container\" class=\"container invoice_pg\" style=\"background-color: #fff !important;\">
      <div class=\"row\">
        <div class=\"col-12\">
          <div style=\"padding-bottom: 12px; padding-top: 5px; border-bottom: 5px solid #e4634e; width: 100%;\">
            <h3 style=\"position: relative; \">
              <img src=\"data:<?= mime_content_type(PROJECT_LOGO) . ';base64,' . base64_encode(file_get_contents(PROJECT_LOGO)) ?>\" style=\"top: 0; width: 3rem; height: 3rem;\" alt=\"\">
              <span style=\"position: absolute; padding-left: 9px; top: 16px; font-size: 2.2rem;\"><b style=\"padding-top: 15px;\"><?= PROJECT_TITLE ?></b></span>
            </h3>
          </div>
        </div>
      </div>
      ";
        // line 444
        echo "hello";
        echo "
      ";
        // line 445
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["order_data"] ?? null), "order_id", [], "any", false, false, false, 445), "html", null, true);
        echo "

      ";
        // line 447
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["dt"]) {
            // line 448
            echo "        ";
            echo twig_escape_filter($this->env, $context["dt"], "html", null, true);
            echo "
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dt'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 450
        echo "
      <div class=\"row\">
        <div class=\"col-12\">
          <br><br>
          <div style=\"border-radius: 15px; border: 1px solid #eaeaea; padding-top: 12px;\">
            <table class=\"table table-sm table-striped/ table-borderless\" style=\"border: none !important;\">
              <tbody>
                <tr>
                  <td style=\"width: 50%; padding: 0 9px;\">
                    <br><br>
                    <h1><span style=\"color: #e4634e; font-size: 5rem;\">INVOICE</span></h1>

                    <br>
                    <!-- Purchase Summary -->
                    <div class=\"row\">
                      <div class=\"col-12\">
                        <table class=\"table table-sm table-striped\">
                          <thead>
                            <tr class=\"table-active\">
                              <th style=\"font-size: .8rem\" scope=\"col\">Invoice#</th>
                              <th style=\"font-size: .8rem\" scope=\"col\">Date</th>
                              <th style=\"font-size: .8rem\" scope=\"col\">Total</th>
                              <!-- <th scope=\"col\">Handle</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th style=\"font-size: .8rem\" scope=\"row\">";
        // line 477
        echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["data"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["order_data"] ?? null) : null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["order_id"] ?? null) : null), "html", null, true);
        echo " hello </th>
                              <td style=\"font-size: .8rem\"> ";
        // line 478
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "order_date", [], "any", false, false, false, 478), "html", null, true);
        echo " </td>
                              <td style=\"font-size: .8rem\"><?= money_currency(\$data['order_currency']['currency_symbol'], \$data['order_data']['order_amount']) ?></td>
                              <!-- <td>@<?= \$data['user_data']['username'] ?></td> -->
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <br>
                    <p>
                      This this invoice is to confirm that <b><?= \$data['user_data']['name'] . ' ' . \$data['user_data']['last_name'] ?></b> has purchased the following item(s) from <b><?= \$data['merchant_data']['merchant_display_name'] ?></b> on <b> <?= \$data['order_date'] ?> </b>
                    </p>

                  </td>

                  <td style=\"border-left: 1px solid #eee; padding: 0 9px;\">
                    <div style=\"padding-top: 5px; border-bottom: 1px solid #e4634e;\">
                      <h5 style=\"position: relative; padding-bottom: 7px;\">
                        <?php \$mrchnt_img = merchant_img(\$data['merchant_data']['merchant_path'], \$data['merchant_data']['merchant_logo'], 1); ?>
                        <img src=\"data:<?= mime_content_type(\$mrchnt_img) . ';base64,' . base64_encode(file_get_contents(\$mrchnt_img)) ?>\" style=\"top: 0; width: 3rem; height: 3rem; border-radius: 50%; padding: 2px; border: 1px solid #777;\" alt=\"\">
                        <span style=\"position: absolute; padding-left: 15px; top: 17px; font-size: 1.7rem;\"><b style=\"padding-top: 15px;\"><?= print_username_profile(\$data['merchant_data']['merchant_display_name'], \$data['merchant_data']['merchant_name']) ?></b></span>
                      </h5>
                    </div>

                    <div class=\"row\">
                      <div class=\"col-12\" style=\"padding-bottom: 9px;\">
                        <h6 class=\"bold\" style=\"padding-top: 9px; padding-bottom: 5px;\">MERCHANT</h6>
                        <div style=\"width: 100%; border-bottom: 1px solid #e4634e;\">

                          <span><?= \$data['merchant_address']['line_1'] ?></span> &nbsp;<br>
                          <span><?= \$data['merchant_address']['city_town'] ?></span> &nbsp; <br>
                          <span><?= \$data['merchant_address']['state'] ?></span> &nbsp; <br>
                          <span><?= \$data['merchant_address']['country'] ?></span> &nbsp; <br>
                          <?php \$contact = (!empty(\$data['merchant_data']['merchant_telephone'])) ? 'tell: ' . \$data['merchant_data']['merchant_telephone'] : 'cell: ' . \$data['merchant_data']['merchant_mobile'] ?>
                          <span><b><?= (\$contact) ?></b></span> &nbsp; <br>
                          <br>
                          <!-- <p> <small><i>This address is subject to changes based on the merchant processed the order purchase</i></small> </p> -->
                        </div>
                      </div>
                    </div>

                    <div class=\"row\">
                      <div class=\"col-12\" style=\"padding-bottom: 9px;\">
                        <h6 class=\"bold\" style=\"padding-bottom: 5px;\">CUSTOMER</h6>
                        <div style=\"width: 100%; border-bottom: 1px solid #e4634e;\">
                          <p>
                            Handle: &nbsp; <i>@<?= \$data['user_data']['username'] ?></i>
                          </p>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-12\">
          <br>
          <div class=\"\" style=\"border-radius: 15px; border: 1px solid #eaeaea;\">
            <br>
            <table id=\"cart_table_<?= \$merchant_id ?>\" class=\"table table-striped table-sm table-info/ table-borderless\">
              <thead class=\"thead-dark/\" style=\"background-color: #ddd;  font-weight: normal !important; font-size: .9em\">
                <th scope=\"col\">#</th>
                <!-- <th style=\"width: 32px !important;\"></th> -->
                <th>product</th>
                <th>size</th>
                <th>quantity</th>
                <th>price</th>
                <th>total</th>
              </thead>
              <tbody style=\"font-size: .9em;\">

                  ";
        // line 555
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["cart_items"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
            // line 556
            echo "                    <?php \$available = 0; ?>
                    <?php if ((int)\$cart_items[\$cart_product]['merchant_id'] === (int)\$merchant_id) : ?>
                      <?php \$product_id     = \$val['product_id']; ?>
                      <?php \$price_id       = \$val['price_id']; ?>
                      <?php \$variation_qty  = \$val['size_qty']; ?>
                      <?php \$variation_qty  = json_decode(\$variation_qty, true); ?>
                      <?php \$product        = get_product_price_currency_by_id(\$product_id, \$price_id); ?>
                      <?php \$sizes          = json_decode(\$product['size_qty'], true); ?>

                      <?php if (isset(\$variation_qty) && !empty(\$variation_qty) && is_array(\$variation_qty)) : ?>
                        <?php \$count = 0; ?>

                        <?php foreach (\$variation_qty as \$size_key => \$quantity) : ?>
                          <?php \$available  = 0; ?>
                          <?php \$size       = \$variation_qty[\$size_key]['size']; ?>
                          <?php \$quantity   = \$variation_qty[\$size_key]['quantity']; ?>
                          <?php if (!empty(\$sizes)) : ?>
                            <?php foreach (\$sizes as \$db_size_key => \$size_arr) : ?>
                              <?php if (\$size_arr['size'] == \$size) : ?>
                                <?php \$available = \$sizes[\$db_size_key]['quantity']; ?>
                              <?php endif; ?>

                            <?php endforeach; ?>
                          <?php endif; ?>

                          <tr id=\"cart_item<?= \$product_id ?>\" class=\"bg-info/\" style=\"color: #6b6b6b;\">
                            <td class=\"text-center/\" align=\"center/\"><?= \$i; ?></td>
                            <!-- <td>
                            <a class=\"text-primary btn/ float-right pointer\" type=\"\" onclick=\"requestModal(post_modal[2], 'productModal', {'product_id':<?= \$product['product_id'] ?>, 'merchant': '<?= \$merchant['merchant_name'] ?>', 'div_id':'alt_prod_cart<?= \$product['product_id'] ?>'});\" style=\"text-decoration: none; color: #6b6b6b;\">
                              <img src=\"<?= product_img(\$product['product_image'], \$merchant['merchant_path'] . DS . 'p' . \$product['product_id'], 0) ?>\" class=\"\" width=\"30\" height=\"30\" style=\"border: 1px solid #efef; border-radius: 7px;\">
                            </a>
                          </td> -->
                            <td>
                              <a class=\"text-secondary\" style=\"padding-top: 5px;\">
                                <?= \$product['product_name']; ?>
                              </a>
                            </td>
                            <td><?= \$size; ?></td>
                            <td>
                              <span class=\"text-center\"><?= \$quantity; ?></span>
                            </td>
                            <td><?= \$product['currency_symbol'] . ' ' . \$product['price']; ?></td>
                            <td><?= \$product['currency_symbol'] . ' ' . \$quantity * \$product['price']; ?></td>
                          </tr>
                          <?php \$i++;
                          \$item_count += \$quantity;
                          \$sub_total += (\$quantity * \$product['price']); ?>
                          <?php \$tax = \$sub_total - \$sub_total / (1 + TAXRATE);
                          \$grand_total = \$sub_total;
                          \$count++; ?>

                        <?php endforeach; ?>

                      <?php endif; ?>

                    <?php else : continue; ?>
                    <?php endif; ?>

                  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 615
        echo "

              </tbody>
            </table>
          </div>
          <div class=\"\" style=\"padding: 5px;\"></div>
          <div class=\"col-12/\">
            <span># Items &nbsp; <b class=\"badge badge-secondary badge-pill\"><?= \$item_count ?></b></span> &emsp;
            <span>Total &nbsp; <b class=\"badge badge-secondary badge-pill\"><?= money_currency(\$currency['currency_symbol'], \$grand_total); ?></b> </span>

            <div class=\"col-12\" style=\"padding: 5px;\"></div>

          </div>
        </div>
      </div>
      <br>
      <div class=\"row\">
        <div class=\"col-12\">
          <div class=\"alert-secondary\" style=\"width: 100%; padding: 0 15px; border: 1px solid #eaeaea; border-radius: 15px;\">
            
            <div style=\"border: 15px; padding-top: 15px;\">
              <table class=\"table table-sm table-striped\">
                <tbody>
                  <tr>
                    <td scope=\"row\" style=\"width: 20%;\">Payment Method</td>
                    <?php \$payment_method = \$data['order_data']['payment_method']; ?>
                    <td><?= \$payment_method_shrt[\$payment_method]['name']; ?></td>
                  </tr>
                  <tr>
                    <td scope=\"row\" style=\"width: 20%;\">Tax @ (15%)</td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>

      
    </div>

    <br><br>

    <script src=\"https://code.jquery.com/jquery-3.4.1.slim.min.js\" integrity=\"sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js\" integrity=\"sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\" integrity=\"sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6\" crossorigin=\"anonymous\"></script>

  </body>

  </html>";
    }

    public function getTemplateName()
    {
        return "order_invoice.php";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  688 => 615,  624 => 556,  620 => 555,  540 => 478,  536 => 477,  507 => 450,  498 => 448,  494 => 447,  489 => 445,  485 => 444,  472 => 433,  470 => 432,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "order_invoice.php", "C:\\wamp64\\www\\picktick\\src\\core\\templates\\order_invoice.php");
    }
}
