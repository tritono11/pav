<!doctype HTML>
<html>
<script src="https://aframe.io/releases/0.6.1/aframe.min.js"></script>
<script src="https://cdn.rawgit.com/jeromeetienne/AR.js/1.5.0/aframe/build/aframe-ar.js"> </script>
<script src="https://unpkg.com/aframe-physics-system@1.4.0/dist/aframe-physics-system.min.js"></script>
<script src="//cdn.rawgit.com/donmccurdy/aframe-extras/v3.13.1/dist/aframe-extras.min.js"></script>
  <body style='margin : 0px; overflow: hidden;'>
    <a-scene stats embedded arjs>
  	<a-marker preset="hiro">
            <!-- OMINO -->
            <a-entity geometry="primitive: box; width: 0.2; height: 0.2; depth: 0.2" position="0 2 +0.5"></a-entity>
            
            <a-entity geometry="primitive: box; width: 0.4; height: 0.1; depth: 0.5" position="0 2 0.1"></a-entity>
            
            <a-entity geometry="primitive: box; width: 0.1; height: 0.1; depth: 0.4" position="0.25 2 0.1"></a-entity>
            <a-entity geometry="primitive: box; width: 0.1; height: 0.1; depth: 0.4" position="-0.25 2 0.1"></a-entity>
            <a-entity geometry="primitive: box; width: 0.2; height: 0.1; depth: 0.6" position="0.1 2 -0.5"></a-entity>
            <a-entity geometry="primitive: box; width: 0.2; height: 0.1; depth: 0.6" position="-0.1 2 -0.5"></a-entity>
            <a-entity geometry="primitive: plane; height: 1.2; width: 1.2" material="side: double" rotation="90 0 0"></a-entity>
            
            <a-entity geometry="primitive: box; width: 2; height: 0.1; depth: 0.1" position="0 2 -0.87"></a-entity>
            <!-- END OMINO -->
<!--            <a-box position="-1 4 -3" rotation="0 45 0" color="#4CC3D9" dynamic-body></a-box>-->
<!--            <a-ocean color="aqua" depth="100" width="100" rotation="0 45 0"></a-ocean>-->
<!--            <a-entity geometry="primitive:sphere; radius:1.5"
                      material="color:tomato; metalness:07"
                      physics="boundingradius:1.5; mass:1"
                      position="0 5 0"></a-entity>-->
  	</a-marker>
  	<a-entity camera></a-entity>
    </a-scene>
  </body>
</html>