<!doctype HTML>
<html>
    <script src="https://aframe.io/releases/0.6.1/aframe.min.js"></script>
    <script src="https://unpkg.com/aframe-physics-system@1.4.0/dist/aframe-physics-system.min.js"></script>
    <script src="//cdn.rawgit.com/donmccurdy/aframe-extras/v3.13.1/dist/aframe-extras.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/aframe-components/snake.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/aframe-components/engine.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/aframe-components/keyboard-direction.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/aframe-components/snake-component.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/aframe-components/mela-component.js') }}"></script>
    <script src="https://rawgit.com/feiss/aframe-environment-component/master/dist/aframe-environment-component.min.js"></script>
    <body style='margin : 0px; overflow: hidden;'>
       <a-scene physics stats>
            <!-- ASSET -->
            <!--<a-assets>
                <a-asset-item id="mymodel" src="{{ asset('/js/aframe-components/aframe/damagedHelmet/damagedHelmet.gltf') }}"></a-asset-item>
            </a-assets>-->
            <a-camera camera="userHeight: 2.6" wasd-controls-enabled="false"></a-camera>
            <a-box id="head" position="0 1 -4" static-body wasd-controls></a-box>
            <a-box id="tail-1" 
                   position="-1 1 -4" 
                   constraint="target: #head; type: pointToPoint; pivot: -1 0 0" 
                   dynamic-body>    
            </a-box>
            <a-box id="tail-2" 
                   position="-2 1 -4" 
                   constraint="target: #tail-2; type: pointToPoint; pivot: -1 0 0" 
                   dynamic-body>    
            </a-box>
            
            
            <a-plane position="0 0 -4" rotation="-90 0 0" width="10" height="10" color="#7BC8A4" static-body ></a-plane>
            <!--<a-snake depth="1" height="1" width="1" material="color: red; shader: flat;" keyboard-controls></a-snake>-->
            <!-- Env -->
            <a-entity environment="preset: forest"></a-entity>
<!--            <a-sound src="src: url({{ asset('/js/aframe-components/sound/forest.mp3') }})" autoplay="true" position="0 2 5" loop="true"></a-sound>-->
      </a-scene>  

    </body>
</html>