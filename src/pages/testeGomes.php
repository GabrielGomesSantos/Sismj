<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar PDF do Modal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
<div id="testElement" style="width: 100px; height: 100px; background-color: red;"></div>
<button onclick="captureTestElement()">Capture Test Element</button>

<script>
async function captureTestElement() {
    const testElement = document.getElementById('testElement');
    const canvas = await html2canvas(testElement);
    const imgData = canvas.toDataURL('image/png');
    console.log(imgData);
}
</script>
</body>
</html>
