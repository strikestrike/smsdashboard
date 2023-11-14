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
                    <div id="upload-container" class="text-center">
                        <button id="browseFile" class="btn btn-primary">Brows File</button>
                    </div>
                    <div  style="display: none" class="progress mt-3" style="height: 25px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                    </div>
                    <div id="ExcelTable"></div>
                </div>

            </div>
        </div>
    </div>

    @section('page_scripts')
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>--}}
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>--}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script type="text/javascript">

        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '{{ route('admin.feeds.upload') }}',
            query:{_token:'{{ csrf_token() }}'} ,// CSRF token
            fileType: ['xls', 'xlsx', 'csv'],
            chunkSize: 50*1024*1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept' : 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function (file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function (file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
            response = JSON.parse(response)
            console.log(response.path);
            alert("Operations successfully queued and will be imported soon.");
        });

        resumable.on('fileError', function (file, response) { // trigger when there is any error
            alert('file uploading error.')
        });


        let progress = $('.progress');
        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }

       /* function UploadProcess() {
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
        };*/
    </script>
    @endsection
</x-admin>
