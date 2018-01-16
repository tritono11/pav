<!doctype HTML>
<html>
    <script src="https://aframe.io/releases/0.6.1/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-physics-system@1.4.0/dist/aframe-physics-system.min.js"></script>
    <script src="//cdn.rawgit.com/donmccurdy/aframe-extras/v3.13.1/dist/aframe-extras.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/aframe-components/snake.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/aframe-components/keyboard-direction.js') }}"></script>
    <body style='margin : 0px; overflow: hidden;'>
       <a-scene physics stats>
        <a-camera wasd-controls-enabled="false"></a-camera>
        <a-box position="-1 7 -3" rotation="0 45 0" color="#4CC3D9" dynamic-body ></a-box>
        <a-box id="bersaglio"
               position="-1 1 -3" 
               rotation="0 45 0" 
               color="#40C3D9" 
               engine="direction : -1; axis:y; event: anEvent; message: Hello, Metaverse!"
               static-body look-controls >
                   
        </a-box>
        <a-plane position="0 0 -4" rotation="-90 0 0" width="4" height="4" color="#7BC8A4" static-body ></a-plane>
        <a-snake depth="1" height="1" width="1" material="color: red; shader: flat;" >
            
        </a-snake>
        <!-- Env -->
        <a-entity light="type: ambient"></a-entity>
        <a-sky color="#FFF"></a-sky>
        <a-ocean color="aqua" depth="100" width="100"></a-ocean>
      </a-scene>  

    </body>
</html>