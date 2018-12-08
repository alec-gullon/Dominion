import setupWebSocketConnection from './websocket.js';
import cookies from 'browser-cookies';

// define a global cookies object to keep track of cookies
window.cookies = cookies;

// setup the websocket connection and scaffold code to handle outgoing and incoming messages
setupWebSocketConnection();