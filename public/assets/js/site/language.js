// load a locale
numeral.language('pt-br', {
    delimiters: {
        thousands: '.',
        decimal: ','
    },
    abbreviations: {
        thousand: 'k',
        million: 'm',
        billion: 'b',
        trillion: 't'
    },
    ordinal : function (number) {
        return 'º';
    },
    currency: {
        symbol: 'R$ '
    }
});
