<?php
defined("System-access") or header('location: /error');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <link href="<?= base_url; ?>view/web-sass/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= base_url; ?>resources/font-awesome/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Pagar.me -->
    <script src="https://assets.pagar.me/pagarme-js/3.0/pagarme.min.js"></script>
    <script src="<?= base_url; ?>view/js/script.js" type="text/javascript"></script>
    <script src="<?= base_url; ?>view/js/front.js" type="text/javascript"></script>
    
    <!--KEYBOARD-->
    <!-- jQuery & jQuery UI + theme (required) -->
  	<link href="https://code.jquery.com/ui/1.10.3/themes/ui-darkness/jquery-ui.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
  
  	<!-- keyboard widget css & script (required) -->
  	<link href="<?= base_url; ?>view/js/lib/keyboard/css/keyboard.css" rel="stylesheet">
  	<script src="<?= base_url; ?>view/js/lib/keyboard/js/jquery.keyboard.js"></script>
  
  	<!-- keyboard extensions (optional) -->
  	<script src="<?= base_url; ?>view/js/lib/keyboard/js/jquery.mousewheel.js"></script>
  	<script src="<?= base_url; ?>view/js/lib/keyboard/js/jquery.keyboard.extension-typing.js"></script>
  	<script src="<?= base_url; ?>view/js/lib/keyboard/js/jquery.keyboard.extension-autocomplete.js"></script>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109196755-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-109196755-1');
    </script>

    
    <!-- Book Loader -->
    <style>
        /*Book Loader 
        Created by Gustavo Rosario*/
        .loader {
          font-family: sans-serif;
          font-weight: bold;
          text-align: center;
          margin: 25% 45%;
        }
        .loader *{
          margin: 0px;
          border-color: #501AAC !important;
        }
        .loader .book{
          position:relative;
          width: 90px;
          height: 60px;
          border: solid 3px;
          background: white;
          perspective: 800px;
          transform-style: preserve-3d;
          transition: transform 1s;
        }
        .book figure.page{
          position: absolute;
          top: -3px;
          right: 0px;
          width: 44%;
          height: 100%;
          border: solid 3px;
          border-left: unset;
          background: white;
          transform-origin: 0% 0%; 
        }
        .book figure.page:first-child{
          animation: flip 0.6s linear infinite;
        }
        
        .book figure.page:nth-child(2){
          animation: flip 0.8s linear infinite;
        }
        .book figure.page:last-child{
          animation: flip 1s linear infinite;
        }
        
        @keyframes flip {
            0% {
              -moz-transform: perspective(800px) rotateX(5deg) rotateY(0deg);
              transform: perspective(800px) rotateX(5deg) rotateY(0deg);
            }
            50% {
              -moz-transform: perspective(90px) rotateY(180deg);
              transform: perspective(90px) rotateY(180deg);
            }
            100% {
              -moz-transform: perspective(90px) rotateY(180deg);
              transform: perspective(90px) rotateY(180deg);
            }
        }
    </style>
    <title>TALAKA - <?= $pag_title; ?></title>
</head>
<body>