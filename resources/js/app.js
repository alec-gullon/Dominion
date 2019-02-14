import AjaxConnection from './ajax/AjaxConnection.js';
import cookies from 'browser-cookies';
import OutboundRouter from './routers/OutboundRouter.js';

// define a global cookies object to keep track of cookies
window.cookies = cookies;

// setup an AJAX connection to the back end
window.dominion.connection = new AjaxConnection();

new OutboundRouter(window.dominion.route).message();