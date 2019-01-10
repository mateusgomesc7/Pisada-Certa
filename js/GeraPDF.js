function genPDF() {

    var doc = new jsPDF();
    doc.setLanguage("pt-BR");

    var specialElementHandlers = {
        '.hidediv' : function(element,render) {return true;}
    };

    doc.fromHTML($('#salvaRelatorio').get(0), 20, 20, { 
        'elementHandlers': specialElementHandlers
    });

    doc.save('Test.pdf');

}