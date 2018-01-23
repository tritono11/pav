AFRAME.registerComponent('snake-component', {
  schema: {
    lunghezza: {type: 'number', default:1},
    limite : {type:'number', default:2},
    snake : {type : 'array', default:[]},
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
    var self = this.el;
    var next = null;

    this.data.snake.forEach(function(cubeEl) {
        var temp = null;
        if (!next) {
            next = { x: cubeEl.object3D.position.x, y: cubeEl.object3D.position.y, z: cubeEl.object3D.position.z };
            var direction = document.querySelector("#snake").getAttribute('engine').direction;
            var axis = getNonZeroComponent(direction);
            var distance = 1;
            cubeEl.object3D.position[axis] += (direction[axis] * distance);
            self.object3D.position = { x: cubeEl.object3D.position.x, y: cubeEl.object3D.position.y, z: cubeEl.object3D.position.z };
          } else {
            temp = { x: cubeEl.object3D.position.x, y: cubeEl.object3D.position.y, z: cubeEl.object3D.position.z };
            cubeEl.object3D.position.set(next.x, next.y, next.z);
            // check if it collides with itself
            next = { x: temp.x, y: temp.y, z: temp.z };
          }
    });
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
            var elNew = document.createElement('a-box');
            this.data.snake.push(elNew);
            //elNew.setAttribute('dynamic-body');
            //elNew.setAttribute('constraint', {target:"#snake", type:"lock", collideConnected:"false", distance:2 });
            //elNew.setAttribute('snake-tail', '');
            //elNew.setAttribute('engine','');
            //self.sceneEl.appendChild(elNew);
            self.appendChild(elNew);
            //console.log(self.object3D);
            //console.log(self.object3D.children.length);
            this.data.lunghezza +=1;
        }
        
  }
});

function getNonZeroComponent (directionNormalizedVec3){
    if (directionNormalizedVec3.x != 0) return 'x';
      if (directionNormalizedVec3.y != 0) return 'y';
      if (directionNormalizedVec3.z != 0) return 'z';
}

AFRAME.registerComponent('snake-tail', {
  init: function () {
    var sceneEl = document.querySelector('a-scene');
    var self = sceneEl.querySelector('#snake');
    // GET position dell'ultimo cubo
    var lastSnakeEl = self.object3D.children[self.object3D.children.length-1];
    var posLastSnakeEl = lastSnakeEl.el.getAttribute('position'); //{x: -1, y: 0.5, z: -3}
    //var engineComp =   self.getAttribute('engine');(
    var temp = self.getAttribute('engine').direction;
    posLastSnakeEl.x -= temp.x * (1);
    posLastSnakeEl.y -= temp.y * (1);
    posLastSnakeEl.z -= temp.z * (1);
    console.log(posLastSnakeEl)
    this.el.setAttribute('position', posLastSnakeEl);
    this.el.object3D.rotation.x = temp.x;
    this.el.object3D.rotation.y = temp.y;
    this.el.object3D.rotation.z = temp.z;
  },
  tick: function (time, timeDelta) {
    // Do something on every scene tick or frame.
    //var directionVec3 = this.data.direction;
    //var currentPosition = this.el.object3D.position;
    //if (currentPosition.y > 6) { return; }
    //this.el.object3D.position.x = this.el.object3D.position.x + this.directionVec3.x * this.data.speed;
    //this.el.object3D.position.y = this.el.object3D.position.y + this.directionVec3.y * this.data.speed;
    //this.el.object3D.position.z = this.el.object3D.position.z + this.directionVec3.z * this.data.speed;
    //    this.el.setAttribute('position', {
    //      x: currentPosition.x + directionVec3.x*this.data.speed,
    //      y: currentPosition.y + directionVec3.y*this.data.speed,
    //      z: currentPosition.z + directionVec3.z*this.data.speed
    //    });
  },
});