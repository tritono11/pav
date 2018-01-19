AFRAME.registerComponent('engine', {
  schema: {
    event       : {type: 'string', default: 'x'},
    message     : {type : 'string', default: 'ciao'},
    direction   : {type: 'vec3', default : {x: 1, y: 0, z: 0}},
    speed       : {type: 'number', default : 0.1}
  },
  init: function () {
    var self = this;
    // .init() is a good place to set up initial state and variables.
    // Store a reference to the handler so we can later remove it.
    this.eventHandlerFn = function () { console.log(self.data.message); };
    
    this.directionVec3 = new THREE.Vector3(this.data.direction.x, this.data.direction.y, this.data.direction.z);
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
    var directionVec3 = this.data.direction;
    var currentPosition = this.el.object3D.position;
    //if (currentPosition.y > 6) { return; }
    this.el.object3D.position.x = this.el.object3D.position.x + this.directionVec3.x * this.data.speed;
    this.el.object3D.position.y = this.el.object3D.position.y + this.directionVec3.y * this.data.speed;
    this.el.object3D.position.z = this.el.object3D.position.z + this.directionVec3.z * this.data.speed;
//    this.el.setAttribute('position', {
//      x: currentPosition.x + directionVec3.x*this.data.speed,
//      y: currentPosition.y + directionVec3.y*this.data.speed,
//      z: currentPosition.z + directionVec3.z*this.data.speed
//    });
  },
  onKeyDown: function (event) {
    if (event.code =="KeyD"){
        var axis = new THREE.Vector3( 0, 1, 0 );
        var angle = -Math.PI / 2;
        this.directionVec3.applyAxisAngle( axis, angle );
        this.el.object3D.rotation.y -= Math.PI/2;
    }
    if (event.code =="KeyA"){
        var axis = new THREE.Vector3( 0, 1, 0 );
        var angle = Math.PI / 2;
        this.directionVec3.applyAxisAngle( axis, angle );
        this.el.object3D.rotation.y += Math.PI/2;
    }
    if (event.code =="KeyW"){
        if (this.data.speed < 10.0){
            this.data.speed += 0.01;
        }              
    }
    if (event.code =="KeyS"){
        if (this.data.speed > 0.0){
            this.data.speed -= 0.01;
        }
    }
  },
});

