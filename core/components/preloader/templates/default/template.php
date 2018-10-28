<style>
      #page-preloader 
        {
          position: fixed;
          left: 0;
          top: 0;
          right: 0;
          bottom: 0;
          background: #27283a; /* Old browsers */
          background: -moz-linear-gradient(top, #27283a 0%, #282b3f 50%, #3d3f5a 100%); /* FF3.6-15 */
          background: -webkit-linear-gradient(top, #27283a 0%,#282b3f 50%,#3d3f5a 100%); /* Chrome10-25,Safari5.1-6 */
          background: linear-gradient(to bottom, #27283a 0%,#282b3f 50%,#3d3f5a 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
          filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#27283a', endColorstr='#3d3f5a',GradientType=0 );
          z-index: 100500;
        }
      @-webkit-keyframes uil-ring-anim 
        {
          0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
          }
          100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
          }
        }
      @-moz-keyframes uil-ring-anim 
        {
          0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
          }
          100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
          }
        }
      @-webkit-keyframes uil-ring-anim 
        {
          0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
          }
          100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
          }
        }
      @-o-keyframes uil-ring-anim 
        {
          0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
          }
          100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
          }
        }
      @keyframes uil-ring-anim 
        {
          0% {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg);
          }
          100% {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg);
          }
        }
      .uil-ring-css 
        {
          background: none;
            position: absolute;
            width: 200px;
            height: 200px;
            top: 50%;
            left: 50%;
            margin-top: -100px;
            margin-left: -100px;
            text-align: center;
        }
      .uil-ring-css-div 
        {
          position: absolute;
          display: block;
          width: 160px;
          height: 160px;
          top: 20px;
          left: 20px;
          border-radius: 80px;
          box-shadow: 0 3px 0 0 #9066b5;
          -webkit-transform-origin: 80px 81.5px;
          transform-origin: 80px 81.5px;
          -webkit-animation: uil-ring-anim 1s linear infinite;
          animation: uil-ring-anim 1s linear infinite;
        }
  </style>
    <script>
      function closePreloader(){
        var $preloader = $('#page-preloader'),
          $spinner   = $preloader.find('.uil-ring-css');
          $spinner.fadeOut();
          $preloader.delay(350).fadeOut('slow');
        }
      $(window).on('load', function () {
        closePreloader();
      });
      setTimeout(function() { closePreloader() }, 5000);
    </script>
<div id="page-preloader">
  <div class="uil-ring-css" style="transform:scale(0.95);"><div class="uil-ring-css-div"></div></div>
</div>