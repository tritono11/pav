AFRAME.registerComponent('mela-component', {
  schema: {
    morte: {type: 'number', default:0},
//    limite : {type:'number', default:2}
    
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
        if (event.detail.body.el.id == 'snake') {
            this.el.removeEventListener('collide', this.listeners.collide);
            
        }
  }
  
});



