<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Consulta via PHP OO e PDO com DataTable</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css'>
    <link rel='stylesheet' type='text/css' href='css/bootcss.css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap" rel="stylesheet">

    <script src='https://code.jquery.com/jquery-3.3.1.js'></script>
    <script src='https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js'></script>

    <script>
        $(document).ready(function() {
            $('#lista-usuario').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "appConfig/read-data.php",
                    "type": "POST"
                }
            });
        });
    </script>
</head>

<body>
    <h1>Consulta via PHP OO e PDO com DataTable</h1>

    <table id="lista-usuario" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Salário</th>
                <th>Idade</th>
            </tr>
        </thead>
    </table>



</body>

</html>