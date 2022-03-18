<?php
$pdf = array();

// $pdf =;

$html='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <title>Plumsail Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
      /* Base CSS styles DO NOT CHANGE OR REMOVE */
      body {
        margin: 0;
        padding: 0;
        font:62.5%/1.5 Helvetica, Arial, Verdana, sans-serif;  
      }

      ul, ul li, p, div, ol {
        margin:0;
        padding:0;
        list-style:none;
      }

      #invoice {
         margin: 0 12pt;
         width:960px;
        padding: 10px 20px;
         margin: 1em auto;
        clear:both;
        position:relative;
        overflow:hidden;
         background:#fff 
      }


      #invoice.cancelled {
        background: #fff url(/images/cancelled.gif) top left
      }

      /*Invoice Simple TemplateCreated by Ed Molyneux*/
      /*=========================== TYPOGRAPHY =========================*/
      #invoice{
        font-family: Helvetica, Arial, Verdana, sans-serif !important 
      }

      #invoice h2 {
        margin: 10px 0;
        font-size: 14pt;
      }

      #invoice-amount td, th {
        font-size: 9pt;
      }

      #invoice-header #company-address {
        text-align: right;
        font-size: 11pt;
        line-height: 14pt;
      }

      #invoice #client-details, #invoice-info  p, #invoice #invoice-other, #invoice #payment-details {
        font-size: 9pt;
         line-height: 12pt;
      }

      #invoice-info h2, #invoice-info h3 {
        margin: 0;
         font-weight: normal;
      }

      #invoice-info h2{
        text-transform:uppercase
      }

      #invoice-info h3 {
        font-size:12pt;
      }

      #comments {
        font-weight:bold;
        margin-top:15px;
        font-size:10pt
      }

      /*=========================== LAYOUT =========================*/
      #invoice{
        padding:0 1cm 1cm 1cm;
       }

      #invoice-header .logo {
        float:left;
      }

      #invoice-header{
        margin-top:0.3cm;
        border-bottom:4px solid #000;
        padding-bottom:10px;
        overflow:hidden
      }

      #invoice-info{
        margin: 0.7cm 0 20px 0;
        width:250px;
        float:right;
        text-align:right
      }

      #client-details {
        margin:0.7cm 0 20px 2.5cm;
        float:left;
        width:250px
      }

       /* Positioned to appear in a standard envelope window when printed */
       #invoice-other {
        text-align: right;
         float: right;
        width:250px;
       }

      #invoice #payment-details{
        float:left;
        width:250px;
      }

      #invoice-amount {
        margin: 1em 0;
        clear: both;
       }

      #comments{
        clear:both;
        padding-top:0.5cm
      }

      /*=========================== TABLES =========================*/
      #invoice table#invoice-amount {
         border-collapse:collapse;
         width:100%;
        clear:both;
      }

      #invoice-amount th {
        text-align: left;
        white-space: nowrap;
        padding: 1px 2px 0 5px;
         font-weight: bold;
        background: #FFF;
        border-bottom: solid 1px #444;
       }

      #invoice-amount td.item_r{
        text-align: right;
      }

      #invoice-amount td.total{
        text-align: right;
        font-weight: bold
      }

      #invoice-amount .index_th{
        width:5%
      }

      #invoice-amount .details_th{
        width:54%
      }

      #invoice-amount .details_notax_th{
        width:62%
      }

      #invoice-amount .quantity_th{
        width:13%
      }

      #invoice-amount .subtotal_th{
        width:15%;
         text-align:right
      }

      #invoice-amount .unitprice_th{
        width:10%;
         text-align:right
      }
      img{
          width : 100px;
      }
    </style>
  </head>
  <body>
    <div id="invoice">
      
      <div id="invoice-header">
        <img src="data:image/png;base64,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" alt="Mainlogo_large" class="logo screen" />
                
        <div class="vcard" id="company-address">
          <div class="fn org"><strong>Sample LLC</strong></div>
          <div class="adr">
            <div class="street-address">25-56 Emery str
            </div>
            <!-- street-address -->
            <div class="locality">New York</div>
            <div id="company-postcode"><span class="region">USA</span> <span class="postal-code">190020</span></div>
          </div>          
          <div class="email">sales@sample.com</div>
        </div>        
      </div>
      
      <!-- #invoice-header -->
      <div id="invoice-info">
        <h2>Invoice <strong>INV {{InvoiceNum}}</strong></h2>
        <h3>{{InvoiceDate}}</h3>
        <p id="payment-terms">Payment Terms: 30 days</p>        
      </div>
     
      <!-- #invoice-info -->
      <div class="vcard" id="client-details">
        <div class="fn">{{ClientName}}</div>
        <div class="org">{{ClientCompany}}</div>
        <div class="adr">
          <div class="street-address">{{ClientAddress}}</div>
          <!-- street-address -->
          <div class="locality">{{ClientCity}}</div>
          <div id="client-postcode"><span class="region">{{ClientRegion}}</span> <span class="postal-code">{{ClientZip}}</span></div>
        </div>     
      </div>
      
      <!-- #client-details vcard -->
      <table id="invoice-amount">
        <thead>
          <tr id="header_row">
            <th class="index_th">#</th>
            <th class="left details_th">Title</th>
            <th class="quantity_th">Quantity</th>
            <th class="unitprice_th">Unit Price ($)</th>
            <th class="subtotal_th">Subtotal ($)</th>
          </tr>
        </thead>
        <tfoot>
        <tr id="total_tr">
          <td colspan="2">&nbsp;</td>
          <td colspan="2" class="total" id="total_currency"><span class="currency">$ </span> Total</td>
          <td class="total">${{Total}}</td>
        </tr>
        </tfoot>
        <tbody>
          {{#each Items}}
          {{#with FieldValues}}
          <tr class="item">
            <td class="item_l">{{#index}}</td>
            <td class="item_l">{{Title}} </td>
            <td class="item_r">{{Quantity}}</td>
            <td class="item_r">{{UnitPrice}}</td>
            <td class="item_r">{{SubTotal}}</td>
          </tr>
          {{/with}}
          {{/each}}
        </tbody>
      </table>
      
      <!-- invoice-amount -->
      <div id="invoice-other">
        <h2>Other Information</h2>
        <img src="data:image/jpg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAFAAhwMBIgACEQEDEQH/xAAbAAEAAwEBAQEAAAAAAAAAAAAAAwQFAQIGB//EADYQAAICAgADBQQIBgMAAAAAAAECAAMEEQUSIRMxQVFhInGBkRQVIzJSobGyBkJTYpLBcoKi/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/EABQRAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhEDEQA/AP3GIiAiIgJxiFGyQB5mdmHfa/FeL1YlevoON9ref6rg6VfcGBPvTXvDciIgIiICIiAiIgIiICIiAiIgJ4uuqoray6xK61GyztoD4ylZm25DtTw5UcqeV7361ofLp94+g+JHdIMnGqxFS60Nm5rty09se9z+EdygAEkgdwPfAizOM15G8fA7ewAbvuprOq09GOhs66EHp3+W7P8AD4qs4euVSAq5HtqoGuRR0VdeGlABHnuVuIBcDhvYuTbZkMWvOutvTbdPXQQDw5gJp8OobGwqabCDYF3YR3Fz1Y/MmBZlLi+enDcCzIdS7DpXWO92Pcol2fKZeU3EeKG6nlcUWnHwlbqr3ge3YR+FOvy+Ya/8P41mNhuMm/tsuyw2ZB5t8rkD2fQAco1NSVeH4tWFQMetuZh7bsx9p2J6sfUnctQEREBERAREQEREBM1mfiblKmKYSkq9i9DcfEKfBfM+Ph5yXiC23tVipzrXbs22L4KNeyD4E717ty3Wi1oqVqFRRpVUaAEDlVaVVrXUqoijSqo0APICV1xnPEHyrmBCoEpQfyjvYn1J18FHmZbkWVcMfGtuYbFaFteeh3QMXOGRlcVS2nHN1dLFF2QF5xo7Y+WyD08axJMO7iOCl6ZWJl5jdq79srV6Kk7AVS2wNa6fr3nTwKTj4ldbkF9bc+bHqx+ZMsQMPi3GN4LDhTG65wu7Kl5+xViBzEDvPXYXx15AzOxeCIBmZgwU+k1VLRQmutegD37HMdEbO+pBG9T6pK0rBFahQTs8o1sz3AweFrj8NqavhvCsyx3622NWK2sbzYuRv4dB4S9z8Vt6LRi44/E9jWEf9QB+6aEQM/6Dl2aN/E7/AFWlEQH5gn84+p8c/fuzn9+baPyDamhEDP8AqbD3tfpK/wDDLtX9Gj6nxh1S7NQ+mbb/ALaaEQM76vyUO6eKZQ8ltWt1/bzfnOizidA+1poyl8TQezb/ABYkf+poRAhxsivJrL1k9DplYEFT5EHunZJqdgIiICUs/wC1uxcX+pZzsP7U6/u5B8ZdlHHPbcTyrf5aQtK+h1zt8+ZP8YF6IiAiIgIiICIiAiIgIiICIiAiIgcJAGz0Ep8HBOBXafvXlrjv+8lgPgCB8JJxGq2/h+TTjsEusqZEY9wYggGT1oERUUaCgACB6iIgIiICIiAiIgIiICIiAiIgf//Z"/>
      </div>
      
      <!-- invoice-other -->
      <div id="payment-details">
        <h2>Payment Details</h2>
        <div id="bank_name">Bank Name</div>
        <div id="sort-code"><strong>Bank/Sort Code:</strong> 32-75-97</div>
        <div id="account-number"><strong>Account Number:</strong> 28270761</div>
        <div id="iban"><strong>IBAN:</strong> 973547</div>
        <div id="bic"><strong>BIC:</strong> 220197</div>
        <div id="payment-reference"><strong>Payment Reference:</strong> INV {{InvoiceNum}}</div>
      </div>
      
      <!-- payment-details -->
      <div id="comments">Payment should be made by bank transfer or cheque made payable to John Smith.</div>
      <!-- comments -->

    </div>
  </body>
</html>

';

session_start();

require "vendor/autoload.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
// $dompdf->loadHtml(file_get_contents('test.html'));
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("playerofcode.pdf",array("Attachment" => 0));


// print_r($_SESSION['datalist']);
// exit;

