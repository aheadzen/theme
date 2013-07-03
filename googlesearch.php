<?php
/*
Template Name: Google Search
*/
?>
<?php get_header(); ?>
<div id="content1" class="home">
<div id="cse" style="width: 100%;">Loading</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  function parseQueryFromUrl () {
    var queryParamName = "q";
    var search = window.location.search.substr(1);
    var parts = search.split('&');
    for (var i = 0; i < parts.length; i++) {
      var keyvaluepair = parts[i].split('=');
      if (decodeURIComponent(keyvaluepair[0]) == queryParamName) {
        return decodeURIComponent(keyvaluepair[1].replace(/\+/g, ' '));
      }
    }
    return '';
  }

  google.load('search', '1', {style : google.loader.themes.SHINY});
  google.setOnLoadCallback(function() {
    var customSearchControl = new google.search.CustomSearchControl(
      'partner-pub-0141059166763342:ew9kt6oawhx');

    customSearchControl.setResultSetSize(google.search.Search.LARGE_RESULTSET);
    var options = new google.search.DrawOptions();
    options.setAutoComplete(true);
    customSearchControl.setAutoCompletionId('partner-pub-0141059166763342:ew9kt6oawhx+qptype:1');
    options.enableSearchResultsOnly(); 
    customSearchControl.draw('cse', options);
    var queryFromUrl = parseQueryFromUrl();
    if (queryFromUrl) {
      customSearchControl.execute(queryFromUrl);
    }
  }, true);
</script>

<style type="text/css">
  .gsc-control-cse {
    font-family: Arial, sans-serif;
    border-color: #ffffff;
    background-color: #ffffff;
  }
  .gsc-tabHeader.gsc-tabhInactive {
    border-color: #B2BDC6;
    background-color: #B2BDC6;
  }
  .gsc-tabHeader.gsc-tabhActive {
    border-color: #8A99A6;
    background-color: #8A99A6;
  }
  .gsc-tabsArea {
    border-color: #8A99A6;
  }
  .gsc-webResult.gsc-result,
  .gsc-results .gsc-imageResult {
    border-color: #FFFFFF;
    background-color: #FFFFFF;
  }
  .gsc-webResult.gsc-result:hover,
  .gsc-imageResult:hover {
    border-color: #D2D6DC;
    background-color: #EDEDED;
  }
  .gs-webResult.gs-result a.gs-title:link,
  .gs-webResult.gs-result a.gs-title:link b,
  .gs-imageResult a.gs-title:link,
  .gs-imageResult a.gs-title:link b {
    color: #0077CC;
  }
  .gs-webResult.gs-result a.gs-title:visited,
  .gs-webResult.gs-result a.gs-title:visited b,
  .gs-imageResult a.gs-title:visited,
  .gs-imageResult a.gs-title:visited b {
    color: #0568CD;
  }
  .gs-webResult.gs-result a.gs-title:hover,
  .gs-webResult.gs-result a.gs-title:hover b,
  .gs-imageResult a.gs-title:hover,
  .gs-imageResult a.gs-title:hover b {
    color: #0568CD;
  }
  .gs-webResult.gs-result a.gs-title:active,
  .gs-webResult.gs-result a.gs-title:active b,
  .gs-imageResult a.gs-title:active,
  .gs-imageResult a.gs-title:active b {
    color: #0568CD;
  }
  .gsc-cursor-page {
    color: #0077CC;
  }
  a.gsc-trailing-more-results:link {
    color: #0077CC;
  }
  .gs-webResult .gs-snippet,
  .gs-imageResult .gs-snippet,
  .gs-fileFormatType {
    color: #555555;
  }
  .gs-webResult div.gs-visibleUrl,
  .gs-imageResult div.gs-visibleUrl {
    color: #570E00;
  }
  .gs-webResult div.gs-visibleUrl-short {
    color: #570E00;
  }
  .gs-webResult div.gs-visibleUrl-short {
    display: none;
  }
  .gs-webResult div.gs-visibleUrl-long {
    display: block;
  }
  .gsc-cursor-box {
    border-color: #FFFFFF;
  }
  .gsc-results .gsc-cursor-box .gsc-cursor-page {
    border-color: #B2BDC6;
    background-color: #FFFFFF;
    color: #0077CC;
  }
  .gsc-results .gsc-cursor-box .gsc-cursor-current-page {
    border-color: #8A99A6;
    background-color: #8A99A6;
    color: #0568CD;
  }
  .gs-promotion {
    border-color: #E6DB55;
    background-color: #FFFFE0;
  }
  .gs-promotion a.gs-title:link,
  .gs-promotion a.gs-title:link *,
  .gs-promotion .gs-snippet a:link {
    color: #0066CC;
  }
  .gs-promotion a.gs-title:visited,
  .gs-promotion a.gs-title:visited *,
  .gs-promotion .gs-snippet a:visited {
    color: #0066CC;
  }
  .gs-promotion a.gs-title:hover,
  .gs-promotion a.gs-title:hover *,
  .gs-promotion .gs-snippet a:hover {
    color: #0066CC;
  }
  .gs-promotion a.gs-title:active,
  .gs-promotion a.gs-title:active *,
  .gs-promotion .gs-snippet a:active {
    color: #0066CC;
  }
  .gs-promotion .gs-snippet,
  .gs-promotion .gs-title .gs-promotion-title-right,
  .gs-promotion .gs-title .gs-promotion-title-right *  {
    color: #000000;
  }
  .gs-promotion .gs-visibleUrl,
  .gs-promotion .gs-visibleUrl-short {
    color: #0066CC;
  }
</style>  <?php include(CHILD_TEMPLATEPATH."/searchform.php");?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>



