// load math.js
import * as math from 'mathjs'

// This exports the plugin object.
export default {
    /* The install method will be called with the Vue constructor as
    the first argument, along with possible options */
    install(Vue, options) {
        // use math.js
        math.sqrt(-4) // 2i
    }
}

