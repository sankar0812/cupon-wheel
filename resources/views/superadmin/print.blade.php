<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Print Test</title>

<style>
    .print-only {
        display: none; 
    }
</style>

</head>
<body>

<div class="row print-only" style="display: flex;">
    <div class="col-md-6"><img src="{{ url('qrcodes/65f2c48518faa.png') }}" height="20" width="20" alt=""></div>
    <div class="col-md-6 " >
        <h6 style="margin: 0; padding: 0; font-size: 5px;">Tea with-sugar</h6>
        <h6 style="margin: 0; padding: 0; font-size: 5px;">Nagercoil</h6>
        <h6 style="margin: 0; padding: 0; font-size: 5px;">Ideaux</h6>
        <h6 style="margin: 0; padding: 0; font-size: 5px;">1 litre</h6>
    </div>
</div>

<button onclick="printDiv()">Print</button>

<script>
function printDiv() {
    var contentToPrint = document.querySelector('.print-only').outerHTML;
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write('<link rel="stylesheet" type="text/css" href="print.css">'); // Link to external CSS file if needed
    printWindow.document.write('</head><body onload="window.print();">');
    printWindow.document.write(contentToPrint);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
}
</script>

</body>
</html>
