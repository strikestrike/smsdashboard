<x-admin>
    @section('title')
    {{ 'Imports' }}
    @endsection

    @if (Session::has('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </p>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Imports</h3>
                </div>

                <div class="card-body">
                    <p class="text-primary">
                        <a href="{{ asset('Leads.xlsx') }}">Download Excel Template <i class="fas fa-download"></i></a>
                    </p>
                    <form action="{{ route('admin.feeds.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" id="fileUpload"  class="mb-4 border-0" onchange="UploadProcess()">
                        <br>
                        <button class="btn btn-success mb-4">Upload</button>
                    </form>
                    <div id="ExcelTable"></div>
                </div>

            </div>
        </div>
    </div>

    @section('page_scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
    <script type="text/javascript">

        function UploadProcess() {
            //Reference the FileUpload element.
            var fileUpload = document.getElementById("fileUpload");

            //Validate whether File is valid Excel file.
            var regex = /\.(xls|xlsx|csv)$/i;
            if (regex.test(fileUpload.value)) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();

                    //For Browsers other than IE.
                    if (reader.readAsBinaryString) {
                        reader.onload = function (e) {
                            GetTableFromExcel(e.target.result);
                        };
                        reader.readAsBinaryString(fileUpload.files[0]);
                    } else {
                        //For IE Browser.
                        reader.onload = function (e) {
                            var data = "";
                            var bytes = new Uint8Array(e.target.result);
                            for (var i = 0; i < bytes.byteLength; i++) {
                                data += String.fromCharCode(bytes[i]);
                            }
                            GetTableFromExcel(data);
                        };
                        reader.readAsArrayBuffer(fileUpload.files[0]);
                    }
                } else {
                    alert("This browser does not support HTML5.");
                }
            } else {
                alert("Please upload a valid Excel file.");
            }
        };

        function GetTableFromExcel(data) {
            //Read the Excel File data in binary
            var workbook = XLSX.read(data, {
                type: 'binary'
            });

            //get the name of First Sheet.
            var Sheet = workbook.SheetNames[0];

            //Read all rows from First Sheet into an JSON array.
            var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[Sheet]);

            //Create a HTML Table element.
            var myTable  = document.createElement("table");
            myTable.setAttribute("class", "table");
            myTable.border = "1";

            //Add the header row.
            var row = myTable.insertRow(-1);

            //Add the header cells.
            headerCell = document.createElement("TH");
            headerCell.setAttribute('scope', 'col');
            headerCell.innerHTML = "#";
            row.appendChild(headerCell);

            headerCell = document.createElement("TH");
            headerCell.setAttribute('scope', 'col');
            headerCell.innerHTML = "Name";
            row.appendChild(headerCell);

            headerCell = document.createElement("TH");
            headerCell.setAttribute('scope', 'col');
            headerCell.innerHTML = "Email";
            row.appendChild(headerCell);

            headerCell = document.createElement("TH");
            headerCell.setAttribute('scope', 'col');
            headerCell.innerHTML = "Phone";
            row.appendChild(headerCell);

            headerCell = document.createElement("TH");
            headerCell.setAttribute('scope', 'col');
            headerCell.innerHTML = "Origin";
            row.appendChild(headerCell);

            headerCell = document.createElement("TH");
            headerCell.setAttribute('scope', 'col');
            headerCell.innerHTML = "Tag";
            row.appendChild(headerCell);


            //Add the data rows from Excel file.
            for (var i = 0; i < excelRows.length; i++) {
                //Add the data row.
                var row = myTable.insertRow(-1);

                //Add the data cells.
                cell = row.insertCell(-1);
                cell.innerHTML = i + 1;

                cell = row.insertCell(-1);
                cell.innerHTML = excelRows[i].Name ?? '';

                cell = row.insertCell(-1);
                cell.innerHTML = excelRows[i].Email ?? '';

                cell = row.insertCell(-1);
                cell.innerHTML = excelRows[i].Phone ?? '';

                cell = row.insertCell(-1);
                cell.innerHTML = excelRows[i].Origin ?? '';

                cell = row.insertCell(-1);
                cell.innerHTML = excelRows[i].Tag ?? '';
            }


            var ExcelTable = document.getElementById("ExcelTable");
            ExcelTable.innerHTML = "";
            ExcelTable.appendChild(myTable);
        };
    </script>
    @endsection
</x-admin>
