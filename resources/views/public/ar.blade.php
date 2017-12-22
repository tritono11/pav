<!doctype HTML>
<html>
<script src="https://aframe.io/releases/0.6.1/aframe.min.js"></script>
<script src="https://cdn.rawgit.com/jeromeetienne/AR.js/1.5.0/aframe/build/aframe-ar.js"> </script>
  <body style='margin : 0px; overflow: hidden;'>
    <a-scene stats embedded arjs>
  	<a-marker preset="hiro">
            <a-cylinder color="#FFB6C1" height="2" radius="0.3"></a-cylinder>
            <a-cone color="#F08080" scale="1 0.5 1"  radius-bottom="0.5" radius-top="0.2" position='0 1.5 0'></a-cone>
  	</a-marker>
  	<a-entity camera></a-entity>
    </a-scene>
  </body>
</html>