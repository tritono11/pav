AFRAME.registerComponent('snake-component', {
  schema: {
    lunghezza: {type: 'number'},
    
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
    window.addEventListener('collide', this.listeners.collide, false);
  },
  collide : function(event){
        console.log('Player has collided with body #' + event.detail.body.id);
        event.detail.target.el;  // Original entity (playerEl).
        event.detail.body.el;    // Other entity, which playerEl touched.
        event.detail.contact;    // Stats about the collision (CANNON.ContactEquation).
        event.detail.contact.ni; // Normal (direction) of the collision (CANNON.Vec3).
        
        if (event.detail.body.el.id == 'mela'){
            // console.log('collisione con mela');
            // event.detail.body.el.removeAttribute('dynamic-body');
            // Aggiungi un cubo allo snake all'ultimo elemento            
            var self = this.el;
            // GET position dell'ultimo cubo
            var lastSnakeEl = self.object3D.children[self.object3D.children.length-1];
            var posLastSnakeEl = lastSnakeEl.el.getAttribute('position'); //{x: -1, y: 0.5, z: -3}
            var elNew = document.createElement('a-cylinder');
            
            // La posizione del nuovo elemento è uguale all'ultima mesh - vettore direzione dell engine            
            elNew.setAttribute('position', posLastSnakeEl);
            elNew.setAttribute('constraint', {target:"#snake"});
            this.el.sceneEl.appendChild(elNew);
            //console.log(self.object3D);
            console.log(self.object3D.children.length);
            
        }
  }
  
});


