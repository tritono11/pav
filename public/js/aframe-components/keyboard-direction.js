/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

const MAX_DELTA = 0.2,
    PROXY_FLAG = '__keyboard-controls-proxy';

const KeyboardEvent = window.KeyboardEvent;
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
        if (AFRAME.utils.shouldCaptureKeyEvent(event)) {
            this.localKeys[event.code] = true;
            this.emit(event);
        }
  },
  emit: function (event) {
    // TODO - keydown only initially?
    // TODO - where the f is the spacebar

    // Emit original event.
    if (PROXY_FLAG in event) {
      // TODO - Method never triggered.
      this.el.emit(event.type, event);
    }

    // Emit convenience event, identifying key.
    this.el.emit(event.type + ':' + event.code, new KeyboardEvent(event.type, event));
    if (this.data.debug) console.log(event.type + ':' + event.code);
  },
});