AFRAME.registerComponent('snake-component', {
  schema: {
    lunghezza: {type: 'number', default:1},
    limite : {type:'number', default:3}
    
  },
  init: function () {
    var entity = this.el;
    var scene = this.el.sceneEl;  
    this.listeners = {
        collide: this.collide.bind(this)
    };
    this.attachEventListeners();
  },
  update: function () {
    // Do something when component's data is updated.
  },
  remove: function () {
    // Do something the component or its entity is detached.
  },
  tick: function (time, timeDelta) {
    // Do something on every scene tick or frame.
  },
  attachEventListeners: function () {
    this.el.addEventListener('collide', this.listeners.collide, false);
  },
  collide : function(event){
        //console.log('Player has collided with body #' + event.detail.body.id);
        //event.detail.target.el;  // Original entity (playerEl).
        //event.detail.body.el;    // Other entity, which playerEl touched.
        //event.detail.contact;    // Stats about the collision (CANNON.ContactEquation).
        //event.detail.contact.ni; // Normal (direction) of the collision (CANNON.Vec3).
        
        if (event.detail.body.el.id == 'mela' && this.data.lunghezza<this.data.limite){
            // console.log('collisione con mela');
            // event.detail.body.el.removeAttribute('dynamic-body');
            // Aggiungi un cubo allo snake all'ultimo elemento            
            var self = this.el;
            var elNew = document.createElement('a-cylinder');
            elNew.setAttribute('dynamic-body');
            //elNew.setAttribute('constraint', {target:"#snake", type:"lock", collideConnected:"false", distance:2 });
            elNew.setAttribute('loaded-tail', '');
            self.appendChild(elNew);
            //console.log(self.object3D);
            //console.log(self.object3D.children.length);
            this.data.lunghezza +=1;
        }
        
  }
  
});



AFRAME.registerComponent('loaded-tail', {
  init: function () {
    
    console.log('I am ready!');
    var sceneEl = document.querySelector('a-scene');
    var self = sceneEl.querySelector('#snake');
    // GET position dell'ultimo cubo
    var lastSnakeEl = self.object3D.children[self.object3D.children.length-1];
    var posLastSnakeEl = lastSnakeEl.el.getAttribute('position'); //{x: -1, y: 0.5, z: -3}
    //var engineComp =   self.getAttribute('engine');(
    var temp = self.getAttribute('engine').direction;
    posLastSnakeEl.x -= temp.x * (0);
    posLastSnakeEl.y -= (self.object3D.children.length-1);
    posLastSnakeEl.z -= temp.z * (-self.object3D.children.length-1);
    console.log(posLastSnakeEl)
    this.el.setAttribute('position', posLastSnakeEl);
    this.el.object3D.rotation.y += Math.PI/2;
  }
});