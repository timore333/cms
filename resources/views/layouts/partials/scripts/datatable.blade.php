<script type="text/javascript" src="{{asset('libs/js-xlsx/xlsx.core.min.js')}}"></script>
<script type="text/javascript" src="{{asset('libs/jsPDF/jspdf.min.js')}}"></script>
<script type="text/javascript" src="{{asset('libs/jsPDF-AutoTable/jspdf.plugin.autotable.min.js')}}"></script>


<!--  To save the generated export files on client side, include in your html code:  -->
<script type="text/javascript" src="libs/FileSaver/FileSaver.min.js"></script>
<!-- To save the generated export files on client side, include in your html code: -->
<script type="text/javascript" src="libs/js-xlsx/xlsx.core.min.js"></script>

<!--To export the table as a PDF file the following includes are required if using jsPDF and jsPDF-AutoTable as pdf producer:-->
<script type="text/javascript" src="libs/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>

<!--  As an alternative pdf producer you can use pdfmake. Instead of jsPDF include then -->

<script type="text/javascript" src="libs/pdfmake/pdfmake.min.js"></script>
<script type="text/javascript" src="libs/pdfmake/vfs_fonts.js"></script>
<!-- For output of arabic characters include mirza_fonts.js instead of vfs_fonts.js -->

<!-- To export the table in PNG format, you need to include: -->

<!-- For IE support include es6-promise before html2canvas -->
<script type="text/javascript" src="libs/es6-promise/es6-promise.auto.min.js"></script>
<script type="text/javascript" src="libs/html2canvas/html2canvas.min.js"></script>

<!-- Regardless of the desired format, finally include: -->

<script type="text/javascript" src="tableExport.min.js"></script>