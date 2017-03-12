<!doctype html>
<html amp lang="en">
<head>
  <meta charset="utf-8">
  <title><?php print $ampproject['title']; ?></title>
  <link rel="canonical" href="<?php print $ampproject['canonical']; ?>" />
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,300,700">
  <?php // Custom CSS ?>
  <?php if (!empty($ampproject['style'])): ?>
    <style amp-custom><?php print $ampproject['style'] ?></style>
  <?php endif; ?>

  <script async custom-element="amp-analytics"
          src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>



  <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
  <script async src="https://cdn.ampproject.org/v0.js"></script>

  <?php // Additional scripts. ?>
  <?php foreach (ampproject_scripts() as $script) : ?>
    <?php print $script; ?>
  <?php endforeach; ?>
</head>
<body>
<amp-analytics type="googleanalytics" id="analytics1">
  <script type="application/json">
    {
      "vars": {
        "account": "UA-59566017-1"
      },
      "triggers": {
        "trackPageview": {
          "on": "visible",
          "request": "pageview"
        }
      }
    }
  </script>
</amp-analytics>
 <div class="page-amp">
    <?php print $content; ?>
 </div>

</body>
</html>
