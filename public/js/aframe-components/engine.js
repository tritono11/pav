AFRAME.registerComponent('engine', {
  schema: {
    event       : {type: 'string', default: 'x'},
    message     : {type : 'string', default: 'ciao'},
    direction   : {type: 'number', default : 1},
    axis        : {type : 'string', default : 'x'},
    speed       : {type: 'number', default : 100.0}
    
  },
  init: function () {
    var self = this;
    // .init() is a good place to set up initial state and variables.
    // Store a reference to the handler so we can later remove it.
    this.eventHandlerFn = function () { console.log(self.data.message); };
    console.log('Engine ready! - direction : ' + this.data.direction + ' - axis : ' + this.data.axis );
    this.directionVec3 = null;
    if (this.data.axis == 'x'){
        this.directionVec3 = new THREE.Vector3(1 * this.data.direction, 0, 0);
    }
    if (this.data.axis == 'y'){
        this.directionVec3 = new THREE.Vector3(0, 1 * this.data.direction, 0);
    }
    if (this.data.axis == 'z'){
        this.directionVec3 = new THREE.Vector3(0, 0, 1 * this.data.direction);
    }
    // Registra evento
    this.listeners = {
      keydown: this.onKeyDown.bind(this),
    };
    window.addEventListener('keydown', this.listeners.keydown, false);
    
  },
  update: function (oldData) {
    var data = this.data;  // Component property values.
    var el = this.el;  // Reference to the component's entity.
    
    // `event` updated. Remove the previous event listener if it exists.
    if (oldData.event && data.event !== oldData.event) {
      el.removeEventListener(oldData.event, this.eventHandlerFn);
    }
    
    if (data.event) {
      // This will log the `message` when the entity emits the `event`.
      el.addEventListener(data.event, this.eventHandlerFn);
    } else {
      // `event` not specified, just log the message.
      console.log(data.message);
    }
    
  },
  remove: function () {
    // Do something the component or its entity is detached.
  },
  tick: function (time, timeDelta) {
    // Do something on every scene tick or frame.
    var directionVec3 = this.directionVec3;
    var currentPosition = this.el.object3D.position;
    //if (currentPosition.y > 6) { return; }
    // Scala i valori
    var factor = this.data.speed * (timeDelta / 1000);
//    ['x', 'y', 'z'].forEach(function (axis) {
//      directionVec3[axis] *= factor * (timeDelta / 1000);
//    });
    
    this.el.setAttribute('position', {
      x: currentPosition.x + directionVec3.x/factor,
      y: currentPosition.y + directionVec3.y/factor,
      z: currentPosition.z + directionVec3.z/factor
    });
  },
  onKeyDown: function (event) {
    if (event.code =="KeyD"){
        //var yAxis = new THREE.Vector3( 0, 1, 0 ); // ruota attorno adll asse Y
        //var angle = Math.PI / 2; // ruota di 90°
        //this.directionVec3.applyAxisAngle( yAxis, angle );
        var rotationMatrix = new THREE.Matrix4(); 
        var angle = - Math.PI / 2;
        var axis = new THREE.Vector3( 0, 1, 0 ).normalize();
        rotationMatrix.makeRotationAxis( axis, angle ).multiplyVector3( this.directionVec3 );
    }
    if (event.code =="KeyA"){
        var rotationMatrix = new THREE.Matrix4(); 
        var angle = Math.PI / 2;
        var axis = new THREE.Vector3( 0, 1, 0 ).normalize();
        rotationMatrix.makeRotationAxis( axis, angle ).multiplyVector3( this.directionVec3 );
    }
    if (event.code =="KeyW"){
        if (this.data.speed < 10.0){
            this.data.speed -= 1;
        }              
        console.log(this.data.speed);
    }
    if (event.code =="KeyS"){
        if (this.data.speed > 0.0){
            this.data.speed += 1;
        }
        console.log(this.data.speed);
    }
  },
});

