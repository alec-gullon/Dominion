import $ from "jquery";
import InboundRouter from './../routers/InboundRouter.js';

export default class AjaxRouter {

    send(route, data) {
        $.post('http://localhost:8000/' + route, data, function(data) {
            new InboundRouter(data.action, data).respond();
        });
    }

}