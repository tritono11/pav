var extendDeep = AFRAME.utils.extendDeep;
// The mesh mixin provides common material properties for creating mesh-based primitives.
// This makes the material component a default component and maps all the base material properties.
var meshMixin = AFRAME.primitives.getMeshMixin();
AFRAME.registerPrimitive('a-snake', extendDeep({}, meshMixin, {
  // Preset default components. These components and component properties will be attached to the entity out-of-the-box.
  defaultComponents: {
    geometry: {primitive: 'box'}
  },
  // Defined mappings from HTML attributes to component properties (using dots as delimiters).
  // If we set `depth="5"` in HTML, then the primitive will automatically set `geometry="depth: 5"`.
  mappings: {
    depth: 'geometry.depth',
    height: 'geometry.height',
    width: 'geometry.width'
  }
}));

// Snake component
AFRAME.registerComponent('engine', {
  schema: {
    event       : {type: 'string', default: 'x'},
    message     : {type : 'string', default: 'ciao'},
    direction   : {type: 'number', default : 1},
    axis        : {type : 'string', default : 'x'},
    speed       : {type: 'number', default : 10.0}
    
  },
  init: function () {
    var self = this;
    // .init() is a good place to set up initial state and variables.
    // Store a reference to the handler so we can later remove it.
    this.eventHandlerFn = function () { console.log(self.data.message); };
    console.log('Engine ready! - direction : ' + this.data.direction + ' - axis : ' + this.data.axis );
    this.directionVec3 = null;
    if (this.data.axis = 'x'){
        this.directionVec3 = new THREE.Vector3(1 * this.data.direction, 0, 0);
    }
    if (this.data.axis = 'y'){
        this.directionVec3 = new THREE.Vector3(0, 1 * this.data.direction, 0);
    }
    if (this.data.axis = 'z'){
        this.directionVec3 = new THREE.Vector3(0, 0, 1 * this.data.direction);
    }
    // Registra evento
    this.listeners = {
      keydown: this.onKeyDown.bind(this),
//      keyup: this.onKeyUp.bind(this),
//      blur: this.onBlur.bind(this)
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
    if (currentPosition.y > 6) { return; }
    // Scala i valori
    var factor = this.data.speed * 6;
    ['x', 'y', 'z'].forEach(function (axis) {
      directionVec3[axis] *= factor * (timeDelta / 1000);
    });
    
    this.el.setAttribute('position', {
      x: currentPosition.x + directionVec3.x,
      y: currentPosition.y + directionVec3.y,
      z: currentPosition.z + directionVec3.z
    });
  },
  onKeyDown: function (event) {
      if (event.code =="KeyD"){
          this.data.axis = 'z';
          this.directionVec3 = new THREE.Vector3(-1 * this.data.direction, 0, 0);
      }
  },
});

