  {% if view_doc == 1 %}
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Invoice {{ order_data.order_id }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      @import url("https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css");

      @import url("https://fonts.googleapis.com/css?family=Tangerine|Inconsolata|Droid+Sans");

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
        /* font: inherit; */
        font-size: 100%;
        /* vertical-align: baseline; */
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
        content: "";
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
    {% endif %}

    {% set i = 1 %}
    {% set sub_total = 0 %}
    {% set grand_total = 0 %}
    {% set item_count = 0 %}
    {% set tax = 0 %}

    {# dump(user_data) #}

    <div id="invoice_container" class="container invoice_pg" style="padding: 15px; padding-bottom: 35px; border-radius: 15px;">
      <div class="row">
        <div class="col-12">
          <div style="padding-bottom: 12px; padding-top: 5px; border-bottom: 5px solid #D1ECF1; width: 100%;">
            <h3 style="position: relative; ">
              <img src="data:{{ project_logo }}" style="top: 0; width: 3rem; height: 3rem;" alt="">
              <span style="position: absolute; padding-left: 9px; top: 2px; font-size: 2.2rem; color:#767676;"><b style="padding-top: 15px;">{{ project_title }}</b></span>
              <small class="float-right" style="font-weight: 600; font-size: .9rem; color:#767676;">{{ copy_to_user }}</small>
            </h3>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <br><br>
          <div style="border-radius: 15px; padding-top: 12px;">
            <table class="table table-sm table-striped/ table-borderless" style="border: none !important;">
              <tbody>
                <tr>
                  <td style="width: 50%; padding-right: 9px;">
                    <br><br>
                    <h1 class="text-info"><span style="font-size: 5rem;">INVOICE</span></h1>

                    <!-- Purchase Summary -->
                    <div class="row">
                      <div class="col-12">
                        <div class="" style="border-radius: 9px; border-top: none !important; padding-top: 5px">
                          <table class="table table-sm table-striped table-info" style="color: #767676; padding-bottom: 0;">
                            <thead>
                              <tr class="table-info">
                                <th style="font-size: .8rem; font-weight: bolder;" scope="col">Invoice #</th>
                                <th style="font-size: .8rem; font-weight: bolder;" scope="col">Date</th>
                                <th style="font-size: .8rem; font-weight: bolder;" scope="col">Total</th>
                                <!-- <th scope="col">Handle</th> -->
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th style="font-size: .8rem" scope="row">{{ order_data.order_id }}</th>
                                <td style="font-size: .8rem"> {{ order_date }} </td>
                                <td style="font-size: .8rem"> {{ currency_price }} </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <br>
                    <p style="color: #767676;">
                      This this invoice is to confirm that {{ user_data.name }} {{user_data.last_name}} has purchased the following item(s) from {{ merchant_data.merchant_display_name }} on {{ order_date }}.
                    </p>

                  </td>

                  <td style="padding: 0 9px; color: #767676; border-radius: 15px;" class="table-active/ alert/ alert-info">
                    <div style="padding-top: 5px; border-bottom: 1px solid #17A2B8;">
                      <div style="position: relative; padding-bottom: 7px;">
                        <img src="data:{{ merchant_logo }}" style="top: 0; width: 3rem; height: 3rem; border-radius: 30%; padding: 2px; border: 1px solid #ddd;" alt="">
                        <span style="position: absolute; padding-left: 15px; top: 16px; font-size: 1.3rem; color:#767676"><b style="padding-top: 15px;">{{ merchant_data.merchant_display_name }}</b>@{{ merchant_data.merchant_name }}</span>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12" style="padding-bottom: 9px;">
                        <h6 class="bold" style="padding-top: 9px; padding-bottom: 5px;">MERCHANT</h6>
                        <div style="width: 100%; border-bottom: 1px solid #17A2B8;">

                          <span> {{ merchant_address.line_1 }} </span> &nbsp;<br>
                          <span> {{ merchant_address.city_town }} </span> &nbsp; <br>
                          <span> {{ merchant_address.state }} </span> &nbsp; <br>
                          <span> {{ merchant_address.country }} </span> &nbsp; <br>
                          <div style="padding: 5px;"></div>
                          <span><b style="font-weight: 500;"> {{ merchant_contact }} </b></span> &nbsp; <br>
                          <br>
                          <!-- <p> <small><i>This address is subject to changes based on the merchant processed the order purchase</i></small> </p> -->
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12" style="padding-bottom: 9px;">
                        <h6 class="bold" style="padding-bottom: 5px;">CUSTOMER</h6>
                        <div style="width: 100%;">
                          <p>
                            Handle: &nbsp; <i>@{{ user_data.username }} </i>
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

      <div class="row">
        <div class="col-12">
          <br>
          <div style="border-radius: 15px; border: 1px solid #eaeaea;">
            <br>
            <table class="table table-striped table-borderless" style=" color: #767676; font-size: 1.2rem">
              <thead class="thead-dark/" style="font-size: .9em">
                <th scope="col" style="font-weight: bolder; width: 5%; white-space: nowrap;">#</th>
                <th style="font-weight: bolder !important;">product</th>
                <th style="font-weight: bolder !important;">size</th>
                <th style="font-weight: bolder !important;">quantity</th>
                <th style="font-weight: bolder !important;">price</th>
                <th style="font-weight: bolder !important;">total</th>
              </thead>
              <tbody style="font-size: .9em;">
                {% set merchant_id = order_data.merchant_id %}

                {% for val in cart_data %}

                {% if val.merchant_id == merchant_id %}


                {% set product_id = val.product_id %} {% set price_id = val.price_id %} {% set variation_qty = val.size_qty %}
                {% set variation_qty  = val.size_qty  %}

                {% set product        = val.product %}

                {% if variation_qty|length > 0 %}
                {% set count = 0 %}

                {% for var_qty in variation_qty %}
                {% set size       = var_qty.size %}
                {% set quantity   = var_qty.quantity %}


                <tr style="color: #6b6b6b;">
                  <td> {{ i }} </td>
                  <td>
                    <span>
                      {{ product.product_name }}
                    </span>
                  </td>
                  <td> {{ size }} </td>
                  <td>
                    <span class="text-center"> {{ quantity }} </span>
                  </td>
                  <td> {{ product.currency_symbol }} {{ product.price }} </td>
                  <td> {{ product.currency_symbol }} {{ quantity * product.price }} </td>
                </tr>
                {% set i = i+1 %}
                {% set item_count = item_count + quantity %}
                {% set sub_total = sub_total + quantity * product.price %}
                {% set tax = sub_total - (sub_total / (1 + TAXRATE)) %}
                {% set grand_total = sub_total %}
                {% set count = count + 1 %}
                {% endfor %}

                {% endif %}

                {% endif %}

                {% endfor %}

              </tbody>
            </table>
          </div>
          <div class="" style="padding: 5px;"></div>

        </div>
      </div>

      <div class="col-12" style="font-size: 1.5rem;">
        <span style="font-weight: bold;"># Items &nbsp; <b class="badge badge-info badge-pill"> {{ item_count }} </b></span> &emsp;
        <span style="font-weight: bold;">Total &nbsp; <b class="badge badge-info badge-pill"> {{ currency_price }} </b> </span>

        <div class="col-12" style="padding: 5px;"></div>
      </div>
      <br>
      <div class="row">
        <div class="col-12">
          <div class="alert-info" style="width: 100%; padding: 0 15px; border: 1px solid #eaeaea; border-radius: 15px;">

            <div style="border: 15px; padding-top: 15px;">
              <table class="table table-sm table-striped" style="color:#767676;">
                <tbody>
                  <tr>
                    <td scope="row" style="width: 20%; font-weight: bolder;">Payment Method</td>
                    <td> {{ payment_method }}</td>
                  </tr>
                  <tr>
                    <td scope="row" style="width: 20%; font-weight: bolder;">Tax (15%)</td>
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
    {% if view_doc == 1 %}

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>

  </html>
  {% endif %}