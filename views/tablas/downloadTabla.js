function Export(tabla,nombrePdf) {
    html2canvas(document.getElementById(tabla), {
    onrendered: function (canvas) {
        var data = canvas.toDataURL();
        var docDefinition = {
            content: [{
                image: data,
                width: 500
            }]
        };
        pdfMake.createPdf(docDefinition).download(nombrePdf);
    }
});
}
