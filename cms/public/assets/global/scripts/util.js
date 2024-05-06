String.prototype.truncate = function(){
    var re = this.match(/^.{0,100}[\S]*/);
    let l = re[0].length;
    var re = re[0].replace(/\s$/,'');
    if(l < this.length)
        re = re + "&hellip;";
    return re;
};

function waitSweetAlert(){
    swal({
        title: 'Cargando...',
        showCancelButton: false,
        showConfirmButton: false,
        onOpen: function () {
            swal.showLoading()
        }
    });
}

function waitBlockUI($target){
    App.blockUI({
        target: $target,
        animate: !0
    });
}

function stopBlockUI($target){
    App.unblockUI($target)
}

function cleanHTML(input) {
    var stringStripper = /(\n|\r| class=(")?Mso[a-zA-Z]+(")?)/g;
    var output = input.replace(stringStripper, ' ');
    var commentSripper = new RegExp('<!--(.*?)-->','g');
    var output = output.replace(commentSripper, '');
    var tagStripper = new RegExp('<(/)*(meta|link|span|\\?xml:|st1:|o:|font)(.*?)>','gi');
    output = output.replace(tagStripper, '');
    var badTags = ['style', 'script','applet','embed','noframes','noscript'];

    for (var i=0; i< badTags.length; i++) {
        tagStripper = new RegExp('<'+badTags[i]+'.*?'+badTags[i]+'(.*?)>', 'gi');
        output = output.replace(tagStripper, '');
    }
    var badAttributes = ['style', 'start'];
    for (var i=0; i< badAttributes.length; i++) {
        var attributeStripper = new RegExp(' ' + badAttributes[i] + '="(.*?)"','gi');
        output = output.replace(attributeStripper, '');
    }
    return output;
}

/**
 * Helper for building laravel routes in javascript
 *
 * @param {string} route
 * @param {object} parameters
 * @return string
 */
function build_route(route, parameters = {}) {
    route = decodeURIComponent(route);
    const queryParams = [];
    for (const key of Object.getOwnPropertyNames(parameters)) {
        const value = parameters[key];
        const braced_key = `@${key}@`;
        const optional_braced_key = `@${key}?@`;
        if (route.includes(braced_key)) {
            route = route.replace(braced_key, value);
        } else if (route.includes(optional_braced_key)) {
            route = route.replace(optional_braced_key, value);
        } else {
            queryParams.push(encodeURIComponent(key) + '=' + encodeURIComponent(value))
        }
    }
    const parts = route.split('/');
    const builder = [];
    for (const part of parts) {
        if (part.startsWith('@')) {
            if (part.endsWith('?@')) {
                continue;
            }
            throw new Error('Missing required parameter [' + part +'] for route [' + route + ']')
        }
        builder.push(part);
    }
    route = builder.join('/');
    if (route.includes('@')) {
        throw new Error('Missing required parameters for route [' + route + ']');
    }
    if (queryParams.length > 0) {
        return route + '?' + queryParams.join('&');
    }
    return route;
}
