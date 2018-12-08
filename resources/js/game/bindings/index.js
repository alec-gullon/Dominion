import refreshHomeBindings from './home.js';
import refreshJoinBindings from './join.js';
import refreshGameBindings from './game.js';

export default function refreshBindings() {
    refreshHomeBindings();
    refreshJoinBindings();
    refreshGameBindings();
}