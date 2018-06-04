$( document ).ready(function() {

    // $(window).load(function() {


   var video = document.getElementById('video');
   var canvas = document.getElementById('canvas');
   var context = canvas.getContext('2d');
   var photo = document.getElementById('photo');
   var vendorUrl = window.URL || window.webkitURL;


   navigator.getMedia = navigator.getUserMedia ||
                        navigator.webkitGetUserMedia ||
                        navigator.mozGetUserMedia ||
                        navigator.msGetUserMedia;

   navigator.getMedia({
       video: true,
       audio: false
   }, function (stream) {
       video.src = vendorUrl.createObjectURL(stream);
   }, function (error) {
   //
   });

   $('#enable-cam').on('click', function () {
       video.play();
       $(this).hide();
       $('#capture, #video').css('display', 'block');
   });

   document.getElementById('capture').addEventListener('click', function () {
        context.drawImage(video, 0, 0, 300, 230);
        photo.setAttribute('src', canvas.toDataURL('image/png'));

        $('#photo').css('background-image', 'url(' + canvas.toDataURL('image/png') +')');
        $('#photo').attr('data-image', canvas.toDataURL('image/png'));

       // console.log(canvas.toDataURL('image/png'));
   });

    // });

});