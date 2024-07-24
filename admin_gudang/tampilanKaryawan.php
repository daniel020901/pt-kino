<?php  


include "../fungsi/koneksi.php";

  


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- datepicker -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <!-- datatables -->
    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-html5-3.1.0/b-print-3.1.0/r-3.0.2/datatables.min.css" rel="stylesheet">
    <title>Tampilan data</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h1 class="text-center"><b>Tampilan Data Karyawan</b></h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                            <input type="text" class="form-control" id="start_date" placeholder="Start Date" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                            <input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
                        </div>
                    </div>
                </div>
                <div class="row p-1 ">
                    <div>
                        <button id="filter" class="btn btn-outline-info btn-sm">Filter</button>
                        <button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- table -->
                        <div class="table-responsive">
                            <table class="table table-bordeless table-sm p-3  fs-6 text-start " id="records">
                                <thead>
                                    <tr>
                                        <th>NIK TAPMAN</th>
                                        <th>NIK SUNFISH</th>
                                        <th>NAMA</th>
                                        <th>KODE</th>
                                        <th>KODE PLANT</th>
                                        <th>TANGGAL</th>
                                        <th>BREAK OUT</th>
                                        <th>BREAK IN</th>
                                        <th>KETERANGAN</th>
                                        <th>ALAT</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <!-- datatables -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-html5-3.1.0/b-print-3.1.0/r-3.0.2/datatables.min.js"></script>

    <!-- moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>



    <script>
        $(function() {
            $("#start_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
            $("#end_date").datepicker({
                "dateFormat": "yy-mm-dd"
            });
        });
    </script>

    <script>
        //fetch records

        function fetch(start_date, end_date) {
            $.ajax({
                url: "records.php",
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                dataType: "json",
                success: function(data) {
                    //datatables
                    var i = "1";
                    new DataTable('#records', {
                        "data": data,
                        "layout": {
                            "topStart": {
                                "buttons": ['copy', 'csv', 'excel', 'pdf', 'print']
                            }
                        },
                        // responsive
                        "responsive": true,
                        columns: [{
                                data: 'NIK_TAPMAN',
                                render: function(data, type, row, meta) {
                                    return `${row.NIK_TAPMAN}`;
                                }
                            },
                            {
                                data: 'NIK_SUNFISH',
                                render: function(data, type, row, meta) {
                                    return `${row.NIK_SUNFISH}`;
                                }
                            },
                            {
                                data: 'NAMA',
                                render: function(data, type, row, meta) {
                                    return `${row.NAMA}`;
                                }
                            },
                            {
                                data: 'KODE'
                            },
                            {
                                data: 'KODE_PLANT'
                            },
                            {
                                data: 'TANGGAL',
                                render: function(data, type, row, meta) {
                                    return moment(row.TANGGAL).format('DD-MM-YYYY');;
                                }
                            },
                            {
                                data: 'BREAK_OUT'
                            },
                            {
                                data: 'BREAK_IN'
                            },
                            {
                                data: 'KETERANGAN'
                            },
                            {
                                data: 'ALAT'
                            }
                        ],
                        processing: true
                    });
                }
            });

        }
        fetch();

        // Filter

        $(document).on("click", "#filter", function(e) {
            e.preventDefault();

            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();

            if (start_date == "" || end_date == "") {
                alert("both date required");
            } else {
                $('#records').DataTable().destroy();
                fetch(start_date, end_date);
            }
        });

        //reset
        $(document).on("click", "#reset", function(e) {
            e.preventDefault();

            $("#start_date").val(''); //empty value
            $("#end_date").val(''); //

            $('#records').DataTable().destroy();
            fetch();

        })
    </script>
</body>

</html>