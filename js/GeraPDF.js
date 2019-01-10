function genPDF() {

    var doc = new jsPDF();

    var specialElementHandlers = {
        '.hidediv' : function(element,render) {return true;}
    };

    doc.text(20,20,'Relatório da Corrida');

    doc.fromHTML($('#relatorio').get(0), 20, 20, { 
        'width': 100, 
        'elementHandlers': specialElementHandlers
    });

    doc.save('Test.pdf');

}