AFRAME.registerComponent('engine', {
  schema: {
    event       : {type:'string', default: 'x'},
    message     : {type:'string', default: 'ciao'},
    direction   : {type:'vec3', default : {x: 1, y: 0, z: 0}},
    speed       : {type:'number', default : 0.0},
    mode        : {type:'number', default : 1}, // 0 - discreto | 1 - continuo
    
  },
  init: function () {
    var self = this;
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
    //if (currentPosition.y > 6) { return; }
    this.el.object3D.position.x = this.el.object3D.position.x + this.directionVec3.x * this.data.speed;
    this.el.object3D.position.y = this.el.object3D.position.y + this.directionVec3.y * this.data.speed;
    this.el.object3D.position.z = this.el.object3D.position.z + this.directionVec3.z * this.data.speed;
  },
  onKeyDown: function (event) {
    if (event.code =="KeyD"){
        if (this.data.mode == 0){
            var axis = new THREE.Vector3( 0, 1, 0 );
            var deg = -90;
            var angle = deg * (Math.PI / 180);
            this.directionVec3.applyAxisAngle( axis, angle );
            this.directionVec3 = this.setNonUnitComponent(this.directionVec3);
            this.data.direction = this.directionVec3;
            this.el.object3D.rotation.y -= Math.PI/2;
        }
        if (this.data.mode == 1){
            var axis = new THREE.Vector3( 0, 1, 0 );
            var angle = -(Math.PI / 360);
            this.directionVec3.applyAxisAngle( axis, angle );
            this.data.direction = this.directionVec3;
            this.el.object3D.rotation.y -= Math.PI/360;
        }
    }
    if (event.code =="KeyA"){
        if (this.data.mode == 0){
            var axis = new THREE.Vector3( 0, 1, 0 );
            var deg = 90;
            var angle = deg * (Math.PI / 180);
            this.directionVec3.applyAxisAngle( axis, angle );
            this.directionVec3 = setNonUnitComponent(this.directionVec3);
            this.data.direction = this.directionVec3;
            this.el.object3D.rotation.y += Math.PI/2;
        }
        if (this.data.mode == 1){
            var axis = new THREE.Vector3( 0, 1, 0 );
            var angle = (Math.PI / 360);
            this.directionVec3.applyAxisAngle( axis, angle );
            this.data.direction = this.directionVec3;
            console.log(this.data.direction);
            this.el.object3D.rotation.y += Math.PI/360;
        }
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
  setNonUnitComponent : function(directionNormalizedVec3){
    if (Math.abs(directionNormalizedVec3.x) != 1) directionNormalizedVec3.x = 0;
    if (Math.abs(directionNormalizedVec3.y) != 1) directionNormalizedVec3.y = 0;
    if (Math.abs(directionNormalizedVec3.z) != 1) directionNormalizedVec3.z = 0;
    return directionNormalizedVec3;
  },
  setSpeed : function(value){
    var y = 1 * value;  // linear function
    this.data.speed = y;
  },
  setDirection : function(vec3){    
    if (vec3 instanceof THREE.Vector3){
        this.directionVec3.x = vec3.x;
        this.directionVec3.y = vec3.y;
        this.directionVec3.z = vec3.z;
        this.data.direction = this.directionVec3;
    }
  }
  
  
});

