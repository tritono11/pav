/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


AFRAME.registerComponent('keyboard-direction', {
  schema: {
    enabled:           { default: true },
    debug:             { default: false }
  },
  init: function () {

    this.localKeys = {};
    this.listeners = {
      keydown: this.onKeyDown.bind(this)
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
    window.addEventListener('keydown', this.listeners.keydown, false);
  },
  onKeyDown: function (event) {
      if (event.code =="KeyD"){
          console.log(event);
          this.emit(event);
      }
//    if (AFRAME.utils.shouldCaptureKeyEvent(event)) {
//      this.localKeys[event.code] = true;
//      
//    }
  },
});