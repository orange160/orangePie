/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Events from './services/events';
const eventManager = new Events();
window.$events = eventManager;

import Vue from 'vue';
Vue.prototype.$events = eventManager;

// Load Vues and components
import vues from "./vues/vues"
import components from "./components"
vues();
components();

