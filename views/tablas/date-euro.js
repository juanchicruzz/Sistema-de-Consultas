

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-euro-pre": function ( a ) {
        var x;

        if ( a.trim() !== '' ) {
            var frDatea = a.trim().split(' ');
            var frTimea = (undefined != frDatea[1]) ? frDatea[1].split(':') : [0o0,0o0,0o0];
            var frDatea2 = frDatea[0].split('/');
            x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + ((undefined != frTimea[2]) ? frTimea[2] : 0)) * 1;
        }
        else {
            x = Infinity;
        }

        return x;
    },

    "date-euro-asc": function ( a, b ) {
        return a - b;
    },

    "date-euro-desc": function ( a, b ) {
        return b - a;
    }
} );